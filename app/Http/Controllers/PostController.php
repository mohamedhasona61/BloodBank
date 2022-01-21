<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
 
    public function index()
    {
        $posts = Post::paginate(20);
        return view('posts.index', compact('posts'));
    }


    public function create()
    {
        $categories =Category::all();
        return view('posts.create', compact('categories'));
    }

 
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
            'content' => 'required',
            'category_id' => 'required'
        ]);
      
        $image = $request->file('image')->store('public/posts');
        Post::create([
            'title' => $request->title,
            'image' => $image,
            'content' => $request->content,
            'category_id' => $request->category_id
        ]);
        save();

        flash()->success("Success");
        return redirect()->route('post.index');
    }


    public function show($id)
    {
        
    }


    public function edit($id)
    {
        $posts = Post::find($id);
        $categories = Category::all();
        return view('posts.edit', compact('posts', 'categories'));
    }

 
    public function update(Request $request, $id)
    {
        
        $post = Post::find($id);

        $this->validate($request, [
            'title' => 'filled',
            'content' => 'filled',
            'category_id' => 'filled'
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id
        ]);

        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'filled|mimes:png,jpg,jpeg',
            ]);
            Storage::delete($post->image);
            $image = $request->file('image')->store('public/posts');
            $post->update([
                'image' => $image
            ]);
        }

        flash()->success("Success");
        return redirect()->route('posts.index');
    }

  
    public function destroy($id)
    {
        $post = Post::find($id);
        if (Storage::delete($post->image)) {
            $post->delete();
        }
        flash()->success("Deleted");
        return back();
    }
}
