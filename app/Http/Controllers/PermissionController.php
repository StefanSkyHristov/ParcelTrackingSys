<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    public function store()
    {
        request()->validate([
            'permission' => ['required', 'string', 'max:50']
        ]);

        Permission::create([
            'name' => Str::ucfirst(request('permission')),
            'slug' => Str::of(Str::lower(request('permission')))->slug('-')
        ]);

        Session::flash('created_message', 'Permission added successfully.');
        return back();
    }

    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        Session::flash('deleted_message', 'Permission deleted successfully.');

        return back();
    }
}
