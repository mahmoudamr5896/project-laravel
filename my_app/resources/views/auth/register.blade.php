@extends('layouts.auth')

@section('content')
<style>
    body {
        background-color: #f0f2f5;
        font-family: 'Segoe UI', sans-serif;
    }

    .register-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        min-height: 100vh;
        padding: 20px;
    }

    .fb-logo {
        font-size: 48px;
        font-weight: bold;
        color: #1877f2;
        margin-bottom: 20px;
    }

    .register-card {
        background-color: white;
        width: 100%;
        max-width: 430px;
        padding: 20px 25px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.15);
    }

    .register-card h2 {
        font-size: 24px;
        font-weight: 600;
        text-align: center;
        margin-bottom: 5px;
    }

    .register-card p {
        font-size: 14px;
        text-align: center;
        color: #606770;
        margin-bottom: 20px;
    }

    .form-control {
        margin-bottom: 12px;
    }

    .name-group {
        display: flex;
        gap: 10px;
    }

    .dob-group,
    .gender-group {
        margin-bottom: 12px;
    }

    .gender-group label {
        margin-right: 10px;
        font-weight: 500;
    }

    .form-check-inline {
        margin-right: 15px;
    }

    .btn-signup {
        width: 100%;
        background-color: #42b72a;
        color: white;
        font-weight: bold;
        padding: 10px;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        margin-top: 10px;
    }

    .login-link {
        text-align: center;
        margin-top: 15px;
    }

    .login-link a {
        color: #1877f2;
        font-size: 14px;
        text-decoration: none;
    }
</style>

<div class="register-wrapper">
    <div class="fb-logo">facebook</div>

    <div class="register-card">
        <h2>Create a new account</h2>
        <p>It's quick and easy.</p>

        <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="name-group">
        <input type="text" name="first_name" class="form-control" placeholder="First name" required>
        <input type="text" name="last_name" class="form-control" placeholder="Surname" required>
    </div>

    <div class="dob-group">
        <label>Date of birth</label>
        <div class="d-flex gap-2">
            <select name="birth_day" class="form-control" required>
                @for($i=1;$i<=31;$i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <select name="birth_month" class="form-control" required>
                @foreach(['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] as $i => $month)
                    <option value="{{ $i+1 }}">{{ $month }}</option>
                @endforeach
            </select>
            <select name="birth_year" class="form-control" required>
                @for($i = now()->year; $i >= 1900; $i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>

    <div class="gender-group">
        <label>Gender</label><br>
        <div class="form-check form-check-inline">
            <input type="radio" name="gender" value="female" class="form-check-input" required>
            <label class="form-check-label">Female</label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" name="gender" value="male" class="form-check-input" required>
            <label class="form-check-label">Male</label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" name="gender" value="custom" class="form-check-input" required>
            <label class="form-check-label">Custom</label>
        </div>
    </div>

    <input type="email" name="email" class="form-control" placeholder="Mobile number or email address" required>
    <input type="password" name="password" class="form-control" placeholder="New password" required>
    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>

    <button type="submit" class="btn-signup">Sign Up</button>
</form>


        <div class="login-link">
            <a href="{{ route('login') }}">Already have an account?</a>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</div>
@endsection
