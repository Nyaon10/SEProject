@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: white;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .dashboard-container {
        max-width: 1000px;
        margin: 50px auto;
        padding: 40px;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .dashboard-header h2 {
        color: #2b3e8c;
    }

    .logout-button {
        padding: 10px 18px;
        background-color: #d9534f;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .logout-button:hover {
        background-color: #c9302c;
    }

    .section {
        margin-top: 30px;
    }

    .section h3 {
        color: #2b3e8c;
        margin-bottom: 15px;
    }

    .section a {
        display: inline-block;
        margin: 5px 10px 5px 0;
        padding: 12px 20px;
        background-color: #2b3e8c;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .section a:hover {
        background-color: #479bb6;
    }

</style>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h2>Welcome, {{ session('customer')->Nama_Pelanggan ?? 'Customer' }}!</h2>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="logout-button" type="submit">Logout</button>
        </form>
    </div>

    <div class="section">
        <h3>Explore Costumes</h3>
        <a href="{{ route('categories.index') }}">Browse Categories</a>
        <a href="{{ route('products.index') }}">Browse All Costumes</a>
    </div>

    <div class="section">
        <h3>Make a Reservation</h3>
        <a href="{{ route('orders.create') }}">Rent a Costume</a>
        <a href="{{ route('orders.create') }}">Buy a Costume</a> {{-- Adjust if you separate buy/rent --}}
    </div>

    <div class="section">
        <h3>Your Orders</h3>
        <a href="{{ route('orders.index') }}">View Order History</a>
    </div>
</div>
@endsection
