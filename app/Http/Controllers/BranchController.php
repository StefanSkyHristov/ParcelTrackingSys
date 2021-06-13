<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BranchController extends Controller
{
    public function create()
    {
        return view('branch.create');
    }

    public function index()
    {
        $branches = Branch::paginate(10);
        return view('branch.index', compact('branches'));
    }

    public function edit(Branch $branch)
    {
        return view('branch.edit', compact('branch'));
    }

    public function update(Branch $branch)
    {
        $inputs = request()->validate([
            'name' => 'string|min:6|max:100',
            'address' => 'required',
            'email' => 'email',
            'contact' => 'min:10|max:16',
            'country' => 'string|min:6|max:50',
            'city' => 'string|min:6|max:50'
        ]);

        $branch->update($inputs);
        Session::flash('updated_message', 'Branch details updated successfully.');

        return back();
    }

    public function destroy(Branch $branch)
    {
        $parcels = $branch->parcels;
        foreach($parcels as $parcel)
        {
            $parcel->branch_id = 0;
            $parcel->save();
        }

        $branch->delete();
        Session::flash('deleted_message', 'Branch has been deleted successfully');

        return back();
    }

    public function store()
    {
        $inputs = request()->validate([
            'name'=>'required|min:6|max:100',
            'address'=>'required|unique:branches',
            'email'=>'required|email',
            'contact'=>'required|min:10|max:16',
            'country'=>'required|min:6|max:50',
            'city'=>'required|min:6|max:50'
        ]);

        Branch::create($inputs);
        Session::flash('created_message', 'Branch has been added Successfully.');
        return back();
    }
}
