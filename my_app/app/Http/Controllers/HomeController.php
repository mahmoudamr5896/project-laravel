<?php

namespace App\Http\Controllers;
use App\Http\Middleware;
use App\Models\post;

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
        $user = Auth::user();
        $posts = Post::all();
        //     return view('posts.index', compact('posts'));
        return view('home', compact(['user','posts']));
        // return view('home');
    }
    public function show()
    {

    }
}
