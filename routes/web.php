<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PasswordResetController;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/login', [AuthController::class, 'showLogin']);
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup.submit');

    Route::get('/forgot-password', [
        PasswordResetController::class, 'showForgotForm'
    ])->name('password.request');

    Route::post('/forgot-password', [
        PasswordResetController::class, 'sendResetLink'
    ])->name('password.email');

    Route::get('/reset-password/{token}', [
        PasswordResetController::class, 'showResetForm'
    ])->name('password.reset');

    Route::post('/reset-password', [
        PasswordResetController::class, 'resetPassword'
    ])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [
        DashboardController::class, 'index'
    ])->name('dashboard');

    Route::resource('inquiries', InquiryController::class);
        // ->except(['show']);

    Route::post('/logout', [
        AuthController::class, 'logout'
    ])->name('logout');
});

use App\Http\Controllers\InquiryReportController;

Route::middleware('auth')->group(function () {
    Route::get('/inquiry-report', [
        InquiryReportController::class,
        'index'
    ])->name('reports.index');

    Route::get('/inquiry-report/pdf', [
        InquiryReportController::class,
        'pdf'
    ])->name('reports.pdf');
});
