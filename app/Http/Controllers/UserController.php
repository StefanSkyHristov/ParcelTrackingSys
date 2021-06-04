<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(User $user)
    {
        $inputs = request()->validate([
            'username' => ['required', 'string', 'max:255', 'alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'avatar' => ['file']
        ]);

        if(request('avatar'))
        {
            $inputs['avatar'] = request('avatar')->store('images');
        }

        $user->update($inputs);
        Session::flash('updated_message', 'User details updated Successfully.');
        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();
        Session::flash('deleted_message', 'User profile has been deleted successfully.');

        return back();
    }
}
