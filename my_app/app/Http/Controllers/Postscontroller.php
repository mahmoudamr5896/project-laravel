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
    
        // Retrieve posts created by the authenticated user with comments
        $posts = Post::with('comments')
                    ->where('posted_by', $user->name)
                    ->get();
    
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
        $validated = $request->validate([
            'text_content' => 'nullable|string',
            'media_url' => 'nullable|url',
            'post_type' => 'required|in:text,image,video',
            'visibility' => 'required|in:public,friends,private',
        ]);
    
        // Ensure at least text or media exists
        if (empty($validated['text_content']) && empty($validated['media_url'])) {
            return response()->json(['error' => 'Post cannot be empty. Add text or media.'], 422);
        }
    
        $post = Post::create([
            'user_id' => Auth::id(),
            'text_content' => $validated['text_content'],
            'media_url' => $validated['media_url'],
            'post_type' => $validated['post_type'],
            'visibility' => $validated['visibility'],
        ]);
    
        return redirect()->route('home')->with('success', 'Comment added successfully!');
    }
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
}

    public function show($id)
{
    // نجيب البوست مع تعليقاته ومع كل مستخدم للتعليقات
    $post = Post::with('comments.user')->findOrFail($id);

    // Return the post with its comments to the view
    return view('posts.show', compact('post'));
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
