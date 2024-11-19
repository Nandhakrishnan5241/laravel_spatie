<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        return view('roles.index', compact("roles"));
    }
    public function create()
    {
        return view('roles.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'string',
            'unique:roles,name,except,id'
        ]);
        Role::create([
            'name' => $request->name
        ]);

        return redirect('roles')->with('status', 'Roles Created Successfully');
    }
    public function edit(Role $role)
    {
        return view('roles.edit', compact("role"));
    }
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'string',
            'unique:roles,name,except,id'.$role->id
        ]);
        $role->update([
            'name' => $request->name
        ]);

        return redirect('roles')->with('status', 'Role Updated Successfully');
    }
    public function destroy($roleId) {
        $role = Role::find($roleId);
        $role->delete();
        return redirect('roles')->with('status', 'role Deleted Successfully');
    }

    public function addPermissionToRole($roleId){
        $permissions     = Permission::get();
        $role            = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
                ->where('role_has_permissions.role_id',$role->id)
                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                ->all();

        return view('roles.add-permission',compact('role','permissions','rolePermissions'));
    }

    public function givePermissionToRole(Request $request, $roleId){
        $request->validate([
            'permissions' => 'required'
        ]);
        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permissions);

        return redirect()->back()->with('status','Permissions added to the role');
    }
}
