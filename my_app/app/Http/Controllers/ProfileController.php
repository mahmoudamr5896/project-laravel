<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\post;
use App\Models\Story;
class ProfileController extends Controller
{
    public function show()
    {
                $user = Auth::user();

                // Fetch the authenticated user
            $posts = Post::with('user')->latest()->get();
            $stories = Story::with('user')->latest()->get();

            return view('profile.show', compact('user', 'posts', 'stories'));
            }
            public function edit()
        {
            $user = Auth::user();
            return view('profile.edit', compact('user'));
    }

public function update(Request $request)
{
    $user = Auth::user();
    
    // Validate the incoming data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
    ]);

    // Update user information
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->save();

    return redirect()->route('profile.show')->with('status', 'Profile updated successfully!');
}

}
