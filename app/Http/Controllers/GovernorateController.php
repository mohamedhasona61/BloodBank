<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Governorate;


class GovernorateController extends Controller
{
  
    public function index()
    {
        $records= Governorate::all();
        return view('governorate.index', compact('records'));
    }


    public function create()
    {
        return view('governorate.create');
    }

    public function store(Request $request)
    {
        $rules=[
            'name'=>'required'

        ];
        $messages=[
            'name.required'=>'Name is required'

        ];
        $this->validate($request,$rules,$messages);

        $records= new Governorate ;
        $records->name= $request->input('name');
        $records->save();

        // $records=Governorate::create($request->all());
        flash()->success("Success");

        return redirect(route('governorate.index'));


    }

  
    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $model =Governorate::findOrFail($id);
        return view('governorate.edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $record=Governorate::findOrFail($id);
        $record->update($request->all());
        flash()->success("Editied");
        return redirect(route('governorate.index'));
   
    }


    public function destroy($id)
    {
        $record=Governorate::findOrFail($id);
        $record->delete();
        flash()->success("Deleted");
        return back();

    }
}
