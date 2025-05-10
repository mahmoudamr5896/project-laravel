<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Postscontroller; 
use App\Http\Controllers\Userscontroller;
use App\Http\Controllers\HomeController;
Route::get('/', action:[HomeController::class ,'index']);
//function () {
//     return view('welcome');
// });
// Auth::routes(['verify' => true]);

// users 
Route::post('/store',action:[Userscontroller::class ,'store'])->name('users.store');




use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/posts');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Handle login form submission
Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/posts',action:[Postscontroller::class ,'index'])->name('posts.index');;
Route::get('/user/{id}',action:[Postscontroller::class ,'show'])->name('posts.show');
Route::get('/create',action:[Postscontroller::class ,'create'])->name('posts.create');
Route::post('/store',action:[Postscontroller::class ,'store'])->name('posts.store');
    // Route::get('/posts', [HomeController::class, 'index'])->name('home');
    Route::get('/posts/{post}/edit', [Postscontroller::class, 'edit'])->name('posts.edit');

    Route::put('/posts/{post}', [Postscontroller::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [Postscontroller::class, 'destroy'])->name('posts.destroy');
});
