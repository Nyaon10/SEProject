<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DeliveryRentalController;
use App\Http\Controllers\DeliverySoldController;
use App\Http\Controllers\ReviewRentalController;
use App\Http\Controllers\ReviewSoldController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;

Route::get('/check-db', function () {
    return [
        'default_connection' => config('database.default'),
        'driver' => config('database.connections.mysql.driver'),
        'database' => config('database.connections.mysql.database'),
    ];
});
// Customers
Route::resource('customers', CustomerController::class);
Route::view('/login', 'auth/login')->name('login');
Route::view('/register', 'auth/register')->name('register');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    $customer = Customer::where('Email_Pelanggan', $credentials['email'])->first();

    if ($customer && Hash::check($credentials['password'], $customer->Password_Pelanggan)) {
        session(['customer' => $customer]);
        return redirect()->intended('/dashboard'); // Redirect after successful login
    }

    return redirect()->back()->with('error', 'Invalid email or password');
})->name('auth.login');

Route::get('/dashboard', function () {
    if (!session()->has('customer')) {
        return redirect()->route('login')->with('error', 'Please log in first.');
    }
    return view('customer.dashboard');
})->name('dashboard');

Route::post('/logout', function () {
    Session::forget('customer');
    return redirect('/login');
})->name('logout');

// Staff
Route::resource('staff', StaffController::class);

// Categories
Route::resource('categories', CategoryController::class);

// Products
Route::resource('products', ProductController::class);

// Orders
Route::resource('orders', OrderController::class);

// Order Details
Route::resource('order-details', OrderDetailController::class);

// Payments
Route::resource('payments', PaymentController::class);

// Delivery Rental
Route::resource('delivery-rental', DeliveryRentalController::class);

// Delivery Sold
Route::resource('delivery-sold', DeliverySoldController::class);

// Review Rental
Route::resource('review-rental', ReviewRentalController::class);

// Review Sold
Route::resource('review-sold', ReviewSoldController::class);