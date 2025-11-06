<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VenueController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\UserController;

// Public routes
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // ... route lainnya


    // Venues management
    Route::get('/venues', [VenueController::class, 'index'])->name('admin.venues.index');
    Route::get('/venues/create', [VenueController::class, 'create'])->name('admin.venues.create');
    Route::post('/venues', [VenueController::class, 'store'])->name('admin.venues.store');
    Route::get('/venues/{venue}/edit', [VenueController::class, 'edit'])->name('admin.venues.edit');
    Route::put('/venues/{venue}', [VenueController::class, 'update'])->name('admin.venues.update');
    Route::delete('/venues/{venue}', [VenueController::class, 'destroy'])->name('admin.venues.destroy');
    
    // Bookings management
    Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
    Route::put('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('admin.bookings.status');
    
    // Users management
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::put('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('admin.users.toggle-status');

    // venue 
    Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Venue Routes
    Route::resource('venues', VenueController::class);

    });

    

    // bookings 
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('bookings/{booking}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
    Route::post('bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::post('bookings/{booking}/complete', [BookingController::class, 'complete'])->name('bookings.complete');
});



});