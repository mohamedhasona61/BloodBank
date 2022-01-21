<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Governorate;

class CitiesController extends Controller
{

    public function index()
    {
        $cities= City::paginate(20);
        return view('cities.index', compact('cities'));
    }

  
    public function create()
    {
        $governorates =Governorate::all();
        return view('cities.create' ,compact('governorates'));
    }

  
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:cities,name',
            'governorate_id' => 'required'
        ]);
        City::create($request->all());
        flash()->success("Success");
        return view('cities.index');

    }

  
    public function show($id)
    {
        
    }

  
    public function edit($id)
    {
        $cities = City::find($id);
        $governorates = Governorate::all();
        return view('cities.edit', compact('cities', 'governorates'));
    }

  
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'filled|unique:cities,name,' . $id,
            'governorate_id' => 'filled'
        ]);
        City::find($id)->update([
            'name' => $request->name,
            'governorate_id' => $request->governorate_id
        ]);
        flash()->success("Editied");
        return redirect()->route('city.index');
    }

  
    public function destroy($id)
    {
        City::find($id)->delete();
        flash()->success("Deleted");        
        return back();
    }
}