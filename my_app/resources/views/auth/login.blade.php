
@extends('layouts.auth')

@section('content')
<style>
    body {
        background-color: #f2ede9;
        font-family: 'Segoe UI', sans-serif;
    }

    .login-container {
        max-width: 500px;
        margin: 50px auto;
        background: linear-gradient(150deg, #f5c28b, #d774a4, #6b3f7c);
        padding: 80px 70px;
        border-radius: 25px;
        color: white;
        position: relative;
    }

    .login-container h2 {
        font-size: 26px;
        margin-bottom: 30px;
    }

    .form-control {
        background: transparent;
        border: none;
        border-bottom: 1px solid white;
        border-radius: 0;
        color: white;
        margin-bottom: 25px;
    }

    .form-control:focus {
        background: transparent;
        color: white;
        box-shadow: none;
    }

    .btn-login {
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
        display: flex;
        justify-content: space-between;
    }

    .login-links a {
        color: white;
        text-decoration: underline;
        font-size: 14px;
    }
</style>

<div class="login-container">
    <h2>Welcome Back</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <input type="email" name="email" class="form-control" placeholder="Email" required>
        <input type="password" name="password" class="form-control" placeholder="Password" required>

        <button type="submit" class="btn-login">→</button>
    </form>

    <div class="login-links">
        <a href="{{ route('register') }}">Sign up</a>
        <a href="">Forgot Password</a>
    </div>
</div>
@endsection
