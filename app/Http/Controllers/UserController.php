<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  
    public function index()
    {
        $users = User::paginate(20);
        return view('users.index', compact('users'));
    }

   
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role_list' => 'array'
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->all());
        $user->roles()->attach($request->role_list);
        flash()->success("User created successfully.");

        return redirect()->route('user.index');
    }

 
    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

 
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'filled',
            'email' => 'filled|unique:users,email,' . $id,
            'role_list' => 'array'
        ]);
        $user = User::find($id);
        $user->update($request->all());
        $user->roles()->sync($request->role_list);
        flash()->success("User Updated successfully.");
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        flash()->success("User Deleted successfully.");
        return back();
    }
}