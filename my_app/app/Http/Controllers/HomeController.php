<?php

namespace App\Http\Controllers;
use App\Http\Middleware;
use App\Models\post;
use App\Models\Story;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'verified']);
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get all stories with associated user
        $stories = Story::with('user')->latest()->get();
    
        // Get the authenticated user
        $user = Auth::user();
    
        // Retrieve all posts with their associated comments and the user who created them
        $posts = Post::with('comments', 'user')->get();
    
        // إذا لم يكن المستخدم مسجلاً دخوله
        if (!$user) {
            return view('auth.login');
        }
    
        // إذا كان المستخدم موجوداً، اجلب منشوراته
        $userPosts = Post::where('user_id', $user->id)->with('comments', 'user')->get();
    
        // عرض الصفحة الرئيسية
        return view('home', compact('user', 'posts', 'stories', 'userPosts'));
    }
    
    
    
    public function show()
    {

    }
}
