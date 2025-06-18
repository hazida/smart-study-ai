<?php

// Additional routes for student dashboard functionality
// Include this in your main web.php file

use App\Http\Controllers\DashboardController;

// Update the main dashboard route to handle role-based routing
Route::middleware('session.auth')->group(function () {
    // Replace the existing dashboard route with this:
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Student-specific routes
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Student\DashboardController::class, 'index'])->name('dashboard');
    });
});
