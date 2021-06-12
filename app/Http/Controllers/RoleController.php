<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\PseudoTypes\True_;

class RoleController extends Controller
{
    public function store()
    {
        request()->validate([
            'role' => ['required','max:50']
        ]);

        Role::create([
            'name' => Str::ucfirst(request('role')),
            'slug' => Str::of(Str::lower(request('role')))->slug('-')
        ]);

        Session::flash('created_message', 'Role created successfully.');
        return back();
    }

    public function show()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function destroy(Role $role)
    {
        $role->delete();
        Session::flash('deleted_message', 'Role has been deleted successfully.');

        return back();
    }

    // public function attach(Role $role, Permission $permission)
    // {
    //     $role->permissions()->attach($permission);
    //     return back();
    // }

    // public function detach(Role $role)
    // {
    //     $role->permissions()->detach(request('permission'));
    //     return back();
    // }

    public function update(Role $role)
    {
        $permissions = request('permissions');
        $permissionsToDetach = request('detachPermissions');

        $rolePermissionIds = $role->permissions;

        if($rolePermissionIds->isEmpty())
        {
            foreach($permissions as $permission)
            {
                $role->permissions()->attach($permission);
                Session::flash('status_updated', 'Role permissions updated successfully.');
            }
        }
        else
        {
           if(request()->has('permissions'))
           {
               foreach($permissions as $permission)
               {
                   $role->permissions()->attach($permission);
                   Session::flash('status_updated', 'Role permissions updated successfully.');
               }
           }
           if(request()->has('detachPermissions'))
           {
               foreach($permissionsToDetach as $permissionToDetach)
               {
                   $role->permissions()->detach($permissionToDetach);
                   Session::flash('status_updated', 'Role permissions updated successfully.');
               }
           }
        }
         return back();
    }
}
