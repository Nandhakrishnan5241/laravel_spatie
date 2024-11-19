<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionContoller extends Controller
{
    public function index()
    {
        $permissions = Permission::get();
        return view('permissions.index', compact("permissions"));
    }
    public function create()
    {
        return view('permissions.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'string',
            'unique:permissions,name,except,id'
        ]);
        Permission::create([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status', 'Permission Created Successfully');
    }
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact("permission"));
    }
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required',
            'string',
            'unique:permissions,name,except,id'.$permission->id
        ]);
        $permission->update([
            'name' => $request->name
        ]);

        return redirect('permissions')->with('status', 'Permission Updated Successfully');
    }
    public function destroy($permissionId) {
        $permission = Permission::find($permissionId);
        $permission->delete();
        return redirect('permissions')->with('status', 'Permission Deleted Successfully');

    }
}
