<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\FeeController;
use App\Http\Controllers\Student\TransactionController;
use App\Http\Controllers\Student\PaymentController;

Route::get('/student-login', function () {
    return view('/student/student-login');
});

Route::middleware(['auth.custom'])->group(function () {
    Route::get('/personal-info', [StudentController::class, 'personalInfo']);
});

Route::get('/academic-info', function () {
    return view('/student/academic-info');
})->middleware('auth.custom');

Route::get('/transaction-history', [TransactionController::class, 'showTransactionHistory'])->middleware('auth.custom');

Route::get('/fee-details', [FeeController::class, 'show'])->middleware('auth.custom');

// Route for the 'Pay Now' functionality
// Route for the Pay Now page
Route::get('/pay-now', [PaymentController::class, 'showPayNowPage']);
Route::post('/pay-now', [PaymentController::class, 'showPayNowPage'])->name('pay-now');
Route::post('/pay-now/submit', [PaymentController::class, 'submitPayment'])->name('pay-now.submit');


Route::post('/authenticate', [StudentController::class, 'authenticate'])->name('student.authenticate');

// Student Dashboard route (GET request)
Route::middleware(['auth.custom'])->get('/student-dashboard', function () {
    return view('/student/student-dashboard');  // Display the student dashboard
})->name('student.dashboard');

Route::get('/logout', [StudentController::class, 'logout'])->name('logout');