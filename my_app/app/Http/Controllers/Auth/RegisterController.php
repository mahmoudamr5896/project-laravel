<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Show registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        Auth::login($user);

        return redirect($this->redirectPath());
    }

    // Validate registration data
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'        => ['required', 'string', 'max:255'],
            'last_name'         => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
            'gender'            => ['required', 'in:female,male,custom'],
            'birth_day'         => ['required', 'integer', 'between:1,31'],
            'birth_month'       => ['required', 'integer', 'between:1,12'],
            'birth_year'        => ['required', 'integer', 'min:1900', 'max:' . now()->year],
        ]);
    }

    // Create a new user instance
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'gender'     => $data['gender'],
            'birth_day'  => $data['birth_day'],
            'birth_month'=> $data['birth_month'],
            'birth_year' => $data['birth_year'],
        ]);
    }

    // Redirect path after registration
    public function redirectPath()
    {
        return '/posts';
    }
}


// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;

// class RegisterController extends Controller
// {
//     // Constructor
//     // public function __construct()
//     // {
//     //     $this->middleware('guest');
//     // }

//     // Show registration form
//     public function showRegistrationForm()
//     {
//         return view('auth.register');
//     }

//     // Handle registration
//     public function register(Request $request)
//     {
//         $this->validator($request->all())->validate();

//         $user = $this->create($request->all());

//         Auth::login($user);

//         return redirect($this->redirectPath());
//     }

//     // Validate registration data
//     protected function validator(array $data)
//     {
//         return Validator::make($data, [
//             // 'name' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//             'password' => ['required', 'string', 'min:8', 'confirmed'],
//         ]);
//     }

//     // Create a new user instance
//     protected function create(array $data)
//     {
//         return User::create([
//             // 'name' => $data['name'],
//             'email' => $data['email'],
//             'password' => Hash::make($data['password']),
//         ]);
//     }

//     // Redirect path after registration
//     public function redirectPath()
//     {
//         return '/posts';
//     }
    

// }
