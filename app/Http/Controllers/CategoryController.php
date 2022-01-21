<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
  
    public function index()
    {
        $categories= Category::paginate(20);
        return view('categories.index', compact('categories'));
    }

  
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name'
        ]);
        Category::create($request->all());
        flash()->success("Success");
        return redirect()->route('categories.index');
    }

 
    public function show($id)
    {
        
    }


     
    public function edit($id)
    {
        
        $categories = Category::find($id);
        
        return view('categories.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'filled|unique:categories,name,' . $id,
        ]);
        Category::find($id)->update(['name' => $request->name]);

        flash()->success("Success");

        return redirect()->route('categories.index');
    }

 
    public function destroy($id)
    {
        Category::find($id)->delete();
        flash()->success("Category deleted successfully");
        return back();
    }
}
