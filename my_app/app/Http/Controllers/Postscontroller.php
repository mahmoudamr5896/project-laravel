<?php

namespace App\Http\Controllers;
// use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Models\post;
use Illuminate\Support\Facades\Auth;

class Postscontroller extends Controller
{
    // public function index()
    // {
    //     $posts = Post::all();
    //     return view('posts.index', compact('posts'));
    // }
    public function index()
{
    // Get the currently authenticated user
    $user = Auth::user();

    // Retrieve posts created by the authenticated user
    $posts = Post::where('posted_by', $user->name)->get();

    // Pass the posts to the view
    return view('posts.index', compact('posts'));
}

    public function create()
    {
        $user = Auth::user();
        return view('posts.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string', // Add this line
        ]);
    
        Post::create([
            'title' => $request->title,
            'description' => $request->description, // Add this line
            'posted_by' => Auth::user()->name,
        ]);
    
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function show($id){
        // dd($id)   ; 
        $user = post::find($id);
             return view('posts.show',[
              'posts'=> $user
             ]
             );
        }
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
   

  
}
