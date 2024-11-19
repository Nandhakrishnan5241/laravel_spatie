<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        $users = User::get();
        return view("users.index",compact('users'));
    }
    public function create(Request $request){
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    public function edit(User $user){
        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user',"roles",'userRoles'));
    }

    public function destroy($roleId) {
        $user = User::find($roleId);
        $user->delete();
        return redirect('users')->with('status', 'User Deleted Successfully');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:5|max:20',
            'roles' => 'required'
        ]);
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        $user->syncRoles($request->roles);

        return redirect("/users")->with('status','User Created Successfully With Roles');
    }

    public function update(Request $request, User $user){
        $request->validate([
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|max:255|unique:users,email',
            'password' => 'nullable|string|min:5|max:20',
            'roles' => 'required'
        ]);

        $data = [
            "name" => $request->name,
            "email" => $request->email
        ];
        if(!empty($request->password)){
            $data += [
                'password' => $request->password
            ];
        }
        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect("/users")->with('status','User Updated Successfully With Roles');
    }
}
