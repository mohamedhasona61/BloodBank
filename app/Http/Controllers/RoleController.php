<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
  
    public function index()
    {
        $roles= Role::paginate(20);
        return view('Roles.index', compact('roles'));
    }

  
    public function create()
    {
        
        return view('Roles.index');
    }

    public function store(Request $request)
    {
        $rules=[
            'name' => 'required|unique:roles,name',
            'permissions_list ' => 'required|array'
        ];
        $messages=[
            'name' => 'Name is required',
            'permissions_list ' => 'permissions list is required'
        ];
      
        $this->validate($request,$rules, $messages);
           $roles =Role::create($request->all());
            flash()->success("Success");
            return redirect();
    
    }

 
    public function show($id)
    {
        
    }


     
    public function edit($id)
    {
        $roles = Role::find($id);
        return view('Roles.edit', compact('roles'));
    }

    public function update(Request $request, $id)
    {
        $rules=[
            'name' => 'required|unique:roles,name'.$id,
            'permissions_list ' => 'required|array'
        ];
        $messages=[
            'name' => 'Name is required',
            'permissions_list ' => 'permissions list is required'
        ];
        $this->validate($request,$rules, $messages);
        Role::find($id)->update($request->all());
        flash()->success("Success");
        return view('Roles.index');
    }

 
    public function destroy($id)
    {
        Role::find($id)->delete();
        toast('Category deleted successfully.', 'success');
        return back();
    }
}
