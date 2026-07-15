<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rooms', [RoomController::class, 'publicIndex'])->name('rooms.public');

Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
    Route::post('/switch-user', [LoginController::class, 'switchUser'])->name('login.switch_user');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/show', [DashboardController::class, 'show'])->name('dashboard.show');
    Route::get('/dashboard/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/update', [DashboardController::class, 'update'])->name('dashboard.update');

    Route::resource('/user', UserController::class)->middleware('role:ADMIN');
    Route::resource('/room', RoomController::class)->middleware('role:ADMIN');
    
    Route::get('/admin/bookings', [BookingController::class, 'index'])->name('admin.booking.index')->middleware('role:ADMIN');
    Route::patch('/admin/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('admin.booking.updateStatus')->middleware('role:ADMIN');

    Route::get('/admin/payments', [PaymentController::class, 'index'])->name('admin.payment.index')->middleware('role:ADMIN');
    Route::patch('/admin/payments/{payment}/status', [PaymentController::class, 'updateStatus'])->name('admin.payment.updateStatus')->middleware('role:ADMIN');

    Route::middleware('role:GUEST')->group(function () {
        Route::get('/room/{room}/book', [BookingController::class, 'create'])->name('booking.create');
        Route::post('/room/{room}/book', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/my-bookings', [BookingController::class, 'history'])->name('booking.history');
        Route::get('/booking/{booking}/pay', [PaymentController::class, 'create'])->name('payment.create');
        Route::post('/booking/{booking}/pay', [PaymentController::class, 'store'])->name('payment.store');
    });

    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/setting/{setting}/update', [SettingController::class, 'update'])->name('setting.update');
});
