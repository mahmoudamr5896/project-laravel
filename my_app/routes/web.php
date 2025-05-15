<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Postscontroller; 
// use App\Http\Controllers\Userscontroller;
// use App\Http\Controllers\HomeController;
// Route::get('/', action:[HomeController::class ,'index']);
// //function () {
// //     return view('welcome');
// // });
// // Auth::routes(['verify' => true]);

// // users 
// Route::post('/store',action:[Userscontroller::class ,'store'])->name('users.store');




// use Illuminate\Foundation\Auth\EmailVerificationRequest;
// use Illuminate\Http\Request;
// use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\Auth\ForgotPasswordController;
// use App\Http\Controllers\Auth\ResetPasswordController;

// Route::get('/home', [HomeController::class, 'index'])->name('home');

// // Route::get('/email/verify', function () {
// //     return view('auth.verify-email');
// // })->middleware('auth')->name('verification.notice');

// // Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
// //     $request->fulfill();
// //     return redirect('/posts');
// // })->middleware(['auth', 'signed'])->name('verification.verify');

// // Route::post('/email/resend', function (Request $request) {
// //     $request->user()->sendEmailVerificationNotification();
// //     return back()->with('message', 'Verification link sent!');
// // })->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('register', [RegisterController::class, 'register']);


// use Illuminate\Support\Facades\Auth;

// Route::post('/logout', function () {
//     Auth::logout();
//     return redirect('/login');
// })->name('logout');
// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// // Handle login form submission
// Route::post('/login', [LoginController::class, 'login']);

// // Route::middleware(['auth', 'verified'])->group(function () {});
// Route::get('/posts',action:[Postscontroller::class ,'index'])->name('posts.index');;
// Route::get('/user/{id}',action:[Postscontroller::class ,'show'])->name('posts.show');
// Route::post('/store',action:[Postscontroller::class ,'store'])->name('posts.store');
// // Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

//     // Route::get('/posts', [HomeController::class, 'index'])->name('home');
//     Route::get('/posts/{post}/edit', [Postscontroller::class, 'edit'])->name('posts.edit');

//     Route::put('/posts/{post}', [Postscontroller::class, 'update'])->name('posts.update');
//     Route::delete('/posts/{post}', [Postscontroller::class, 'destroy'])->name('posts.destroy');
// // Route::get('/create',action:[Postscontroller::class ,'create'])->name('posts.create');

// use App\Http\Controllers\CommentController;

// Route::get('/posts/{post}/comments', [CommentController::class, 'showPostComments'])->name('posts.comments');
// Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
// Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
// Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
// Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
// use App\Http\Controllers\ProfileController;

// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
//     Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
// });
// use App\Http\Controllers\StoryController;

// Route::resource('stories', StoryController::class);
// Route::middleware('auth')->resource('posts', Postscontroller::class);

// Route::middleware('auth')->post('/posts', [Postscontroller::class, 'store']);

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Userscontroller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Postscontroller;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoryController;

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'index']);

// التسجيل والدخول
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// الصفحة بعد الدخول
Route::get('/home', [HomeController::class, 'index'])->name('home');

// تسجيل المستخدمين
Route::post('/store', [Userscontroller::class, 'store'])->name('users.store');

// البروفايل
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// القصص
Route::middleware('auth')->resource('stories', StoryController::class);

// البوستات
Route::middleware('auth')->resource('posts', Postscontroller::class);

// التعليقات
Route::get('/posts/{post}/comments', [CommentController::class, 'showPostComments'])->name('posts.comments');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
