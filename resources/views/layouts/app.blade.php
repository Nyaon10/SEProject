<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Customer Portal')</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }
        nav {
            margin-bottom: 20px;
        }
        nav a {
            margin-right: 10px;
        }
        form input, form button {
            display: block;
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }
        .logout-btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <nav>
        @if(session('customer'))
            Welcome, {{ session('customer')->Nama_Pelanggan }} |
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button class="logout-btn" type="submit">Logout</button>
            </form>
        @elseif (!request()->is('login') && !request()->is('register'))
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endif
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>
