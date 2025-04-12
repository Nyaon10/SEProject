@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: white;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-container {
        max-width: 400px;
        margin: 60px auto 0;
        padding: 40px;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    h2 {
        text-align: center;
        color: #2b3e8c;
        margin-bottom: 25px;
        width: 100%;
    }

    form {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: 2px solid #479bb6;
        border-radius: 6px;
        outline: none;
        font-size: 16px;
        transition: border-color 0.3s;
        box-sizing: border-box;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #2b3e8c;
    }

    .form-footer {
        width: 100%;
        display: flex;
        justify-content: flex-start;
        margin-top: 10px;
    }

    .form-footer button {
        padding: 10px 24px;
        background-color: #2b3e8c;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 15px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .form-footer button:hover {
        background-color: #479bb6;
    }

    .register-link-outside {
        max-width: 400px;
        margin: 5px auto 0;
        text-align: right;
        padding-right: 10px;
    }

    .register-link-outside a {
        color: #479bb6;
        text-decoration: none;
        font-weight: bold;
    }

    .register-link-outside a:hover {
        text-decoration: underline;
    }

    .error-message {
        color: red;
        text-align: center;
        margin-bottom: 15px;
        width: 100%;
    }
</style>

<div class="login-container">
    <h2>Login</h2>
    
    @if(session('error'))
        <div class="error-message">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('auth.login') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <div class="form-footer">
            <button type="submit">Login</button>
        </div>
    </form>
</div>

<div class="register-link-outside">
    <a href="{{ route('register') }}">Register</a>
</div>
@endsection
