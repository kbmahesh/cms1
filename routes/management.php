<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Management\ManagementController;
use App\Http\Controllers\Management\AddFeeController;
use App\Http\Controllers\Auth\ManagementAuthController;

Route::get('/management-login', function () {
    return view('/management/management-login');
});

// Route::get('/management-dashboard', function () {
//     return view('/management/management-dashboard');
// });

Route::post('/management/login', [ManagementAuthController::class, 'login'])->name('management.login');
Route::post('/management/logout', [ManagementAuthController::class, 'logout'])->name('management.logout');

Route::middleware(['management.auth'])->group(function () {
    Route::get('/management-dashboard', function () {
        return view('management.management-dashboard'); // No leading '/'
    })->name('management.dashboard'); //Add a route name here
});

Route::middleware(['management.auth'])->group(function () {
    Route::get('/register', [ManagementController::class, 'showRegistrationForm'])->name('register');
});

Route::middleware(['management.auth'])->group(function () {
    Route::get('/get-branches', [ManagementController::class, 'getBranches']);
});

Route::middleware(['management.auth'])->group(function () {
    Route::post('/students/store', [ManagementController::class, 'store'])->name('students.store');
});

Route::middleware(['management.auth'])->group(function () {
    Route::get('/view-students', [ManagementController::class, 'viewStudents'])->name('view-students');
});

Route::middleware(['management.auth'])->group(function () {
    Route::get('/students/filter', [ManagementController::class, 'filter'])->name('students.filter');
});

Route::middleware(['management.auth'])->group(function () {
    Route::get('/students/{student_id}/view', [ManagementController::class, 'show'])->name('students.view');
});

Route::middleware(['management.auth'])->group(function () {
    Route::get('/students/edit/{id}', [ManagementController::class, 'edit'])->name('students.edit');
});

Route::middleware(['management.auth'])->group(function () {
    Route::put('/students/update/{id}', [ManagementController::class, 'update'])->name('students.update');
});

Route::middleware(['management.auth'])->group(function () {
    Route::get('/fees', [ManagementController::class, 'viewFees'])->name('students.fees');
});

Route::middleware(['management.auth'])->group(function () {
    Route::get('/students/fees', [ManagementController::class, 'viewFees'])->name('view.fees');
});

Route::middleware(['management.auth'])->group(function () {
    Route::get('/fees/{student_id}', [ManagementController::class, 'showFeeDetails'])->name('fees.details');
});

Route::middleware(['management.auth'])->group(function () {
    Route::get('/add', [AddFeeController::class, 'create'])->name('fees.create');
});

Route::middleware(['management.auth'])->group(function () {
    Route::post('/submitFee', [AddFeeController::class, 'submitFee'])->name('submit.fee');
});

Route::middleware(['management.auth'])->group(function () {
    Route::get('/fetchStudent/{id}', [AddFeeController::class, 'fetchStudent']);
});

Route::middleware(['management.auth'])->group(function () {
    Route::get('/fetchStudents', [AddFeeController::class, 'fetchStudents']);
});

Route::middleware(['management.auth'])->group(function () {
    Route::post('/submit-batch-fee', [AddFeeController::class, 'submitBatchFee']);
});

Route::middleware(['management.auth'])->group(function () {
    Route::get('/pending', [AddFeeController::class, 'pendingReceipts'])->name('transactions.pending');
});

Route::middleware(['management.auth'])->group(function () {
    Route::get('/transactions/view/{transaction_id}', [AddFeeController::class, 'viewReceipt'])->name('transactions.view');
});

Route::middleware(['management.auth'])->group(function () {
    Route::put('/transactions/approve/{transaction_id}', [AddFeeController::class, 'approveReceipt'])->name('transactions.approve');
});



