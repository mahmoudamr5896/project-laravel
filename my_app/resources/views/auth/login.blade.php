@extends('layouts.auth')

@section('content')
<style>
    body {
        background-color: #f0f2f5;
        font-family: 'Segoe UI', sans-serif;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .left-section {
        flex: 1;
        padding: 50px;
    }

    .left-section h1 {
        color: #1877f2;
        font-size: 56px;
        margin-bottom: 20px;
    }

    .left-section p {
        font-size: 24px;
        color: #1c1e21;
    }

    .right-section {
        flex: 1;
        max-width: 400px;
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .form-control {
        margin-bottom: 15px;
    }

    .btn-login {
        width: 100%;
        background-color: #1877f2;
        color: white;
        font-weight: bold;
        border: none;
        padding: 10px;
        font-size: 18px;
        border-radius: 6px;
        margin-bottom: 10px;
    }

    .btn-create {
        width: 100%;
        background-color: #42b72a;
        color: white;
        font-weight: bold;
        border: none;
        padding: 10px;
        font-size: 16px;
        border-radius: 6px;
    }

    .forgot-link {
        display: block;
        text-align: center;
        margin-bottom: 15px;
        color: #1877f2;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }

        .left-section {
            text-align: center;
        }

        .right-section {
            margin-top: 20px;
        }
    }
</style>

<div class="container">
    <!-- Left Section -->
    <div class="left-section">
        <h1>facebook</h1>
        <p>Connect with friends and the world around you on Facebook.</p>
    </div>

    <!-- Right Section: Login Form -->
    <div class="right-section">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="email" name="email" class="form-control form-control-lg" placeholder="Email or phone number" required>
            <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>

            <button type="submit" class="btn-login">Login</button>

            <a href="#" class="forgot-link">Forgot password?</a>

            <hr>

            <a href="{{ route('register') }}">
                <button type="button" class="btn-create">Create new account</button>
            </a>
        </form>
    </div>
</div>
@endsection
