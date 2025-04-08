<?php

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

// Customers
Route::resource('customers', CustomerController::class);

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