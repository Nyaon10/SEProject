@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: white;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .register-container {
        max-width: 500px;
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

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="number"] {
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

    input:focus {
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

    .error-message {
        color: red;
        text-align: center;
        margin-bottom: 15px;
        width: 100%;
    }

    .login-link-outside {
        max-width: 500px;
        margin: 5px auto 0;
        text-align: right;
        padding-right: 10px;
    }

    .login-link-outside a {
        color: #479bb6;
        text-decoration: none;
        font-weight: bold;
    }

    .login-link-outside a:hover {
        text-decoration: underline;
    }
</style>

<div class="register-container">
    <h2>Register</h2>

    @if ($errors->any())
        <div class="error-message">
            <ul style="list-style: none; padding: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('customers.store') }}">
        @csrf
        <input type="text" name="Nama_Pelanggan" placeholder="Nama" required>
        <input type="number" name="NIK_Pelanggan" placeholder="NIK" required>
        <input type="text" name="Alamat_Pelanggan" placeholder="Alamat" required>
        <input type="email" name="Email_Pelanggan" placeholder="Email" required>
        <input type="password" name="Password_Pelanggan" placeholder="Password" required>
        <input type="password" name="Password_Pelanggan_confirmation" placeholder="Confirm Password" required>
        <input type="text" name="No_Hp_Pelanggan" placeholder="No HP" required>
        <input type="text" name="Akun_Instagram" placeholder="Instagram (optional)">

        <div class="form-footer">
            <button type="submit">Register</button>
        </div>
    </form>
</div>

<div class="login-link-outside">
    <a href="{{ route('login') }}">Already have an account? Login</a>
</div>
@endsection
