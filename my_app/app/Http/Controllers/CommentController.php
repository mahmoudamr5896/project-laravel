<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'post_id' => 'required|exists:posts,id',
        ]);
    
        // Create the comment
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->id(); // assuming you want the logged-in user to be the commenter
        $comment->save();
    
        // Redirect back to the home page with a success message
        return redirect()->route('home')->with('success', 'Comment added successfully!');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function showPostComments($postId)
{
    // نجيب البوست مع تعليقاته والمستخدمين المرتبطين بالتعليقات
    $post = Post::with('comments.user')->findOrFail($postId);

    return view('comments.index', compact('post'));
}
    public function destroy(Comment $comment)
    {
        // تحقق إن المستخدم هو صاحب التعليق
        // if ($comment->user_id != Auth::id()) {
        //     return redirect()->back()->with('error', 'Unauthorized');
        // }
    
        $comment->delete();
    
        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }
}
