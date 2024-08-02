<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class Userscontroller extends Controller
{
    //
    public function create(){
        return view('users.register');
   }

   public function store(Request $request)
   {
       $validatedData = $request->validate([
           'name' => 'required',
           'email' => 'required',
           'password' => 'required',
       ]);
    //    dd($validatedData);
       $user = User::create($validatedData);
       return redirect()->route('posts.index');
   }
}
