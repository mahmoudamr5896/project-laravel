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
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|email|unique:users,email',
        'password'   => 'required|string|min:6|confirmed', // added 'confirmed' rule
        'birth_day'  => 'required|numeric',
        'birth_month'=> 'required|numeric',
        'birth_year' => 'required|numeric',
        'gender'     => 'required|in:male,female,custom',
    ]);
    
   
    
   
       $user = User::create([
           'first_name'    => $request->first_name,
           'last_name'     => $request->last_name,
           'email'         => $request->email,
           'password'      => bcrypt($request->password),
           'birth_date'    => "{$request->birth_year}-{$request->birth_month}-{$request->birth_day}",
           'gender'        => $request->gender,
           'profile_image' => 'defaults/profile.png',
           'cover_image'   => 'defaults/cover.jpg',
           'friends'       => json_encode([]),
       ]);
   
       Auth::login($user);
   
       return redirect()->route('home');
   }
   
//    public function store(Request $request)
//    {
//        $validatedData = $request->validate([
//            'first_name' => 'required|string|max:255',
//            'last_name' => 'required|string|max:255',
//            'email' => 'required|email|unique:users,email',
//            'password' => 'required|string|min:6',
//            'gender' => 'required|string',
//            'birth_day' => 'required|integer',
//            'birth_month' => 'required|integer',
//            'birth_year' => 'required|integer',
//        ]);
   
//        $birth_date = Carbon\Carbon::create(
//            $validatedData['birth_year'],
//            $validatedData['birth_month'],
//            $validatedData['birth_day']
//        )->format('Y-m-d');
   
//        $user = User::create([
//            'first_name' => $validatedData['first_name'],
//            'last_name' => $validatedData['last_name'],
//            'email' => $validatedData['email'],
//            'password' => Hash::make($validatedData['password']),
//            'gender' => $validatedData['gender'],
//            'birth_date' => $birth_date,
//            'profile_img' => 'default-profile.png',   // Placeholder or upload logic
//            'cover_img' => 'default-cover.png',
//            'news_img' => 'default-news.png',
//            'friends' => [],
//        ]);
   
//        Auth::login($user); // Optional auto-login
   
//        return redirect()->route('posts.index');
//    }
   
}
