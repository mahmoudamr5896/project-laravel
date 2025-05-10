@extends('layouts.auth')

@section('content')
<style>
    body {
        background-color: #f2ede9;
        font-family: 'Segoe UI', sans-serif;
    }

    .register-container {
        max-width: 400px;
        margin: 50px auto;
        background: linear-gradient(150deg, #f5c28b, #d774a4, #6b3f7c);
        padding: 40px 30px;
        border-radius: 25px;
        color: white;
        position: relative;
    }

    .register-container h2 {
        font-size: 24px;
        margin-bottom: 30px;
    }

    .form-control {
        background: transparent;
        border: none;
        border-bottom: 1px solid white;
        border-radius: 0;
        color: white;
        margin-bottom: 20px;
    }

    .form-control:focus {
        background: transparent;
        color: white;
        box-shadow: none;
    }

    .btn-register {
        background-color: white;
        color: #6b3f7c;
        border-radius: 50%;
        padding: 10px 15px;
        font-size: 18px;
        border: none;
        float: right;
    }

    .login-links {
        margin-top: 30px;
        text-align: center;
    }

    .login-links a {
        color: white;
        text-decoration: underline;
        font-size: 14px;
    }
</style>

<div class="register-container">
    <h2>Create Account</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="text" name="name" class="form-control" placeholder="Full Name" required>
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>

        <button type="submit" class="btn-register">→</button>
    </form>

    <div class="login-links">
        <a href="{{ route('login') }}">Already have an account? Login</a>
    </div>
</div>
@endsection
