<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Admin Dashboard Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/licenses', [DashboardController::class, 'licenses'])->name('licenses');
    Route::get('/license/{id}', [DashboardController::class, 'showLicense'])->name('license.show');
    Route::post('/license/{id}/update-status', [DashboardController::class, 'updateStatus'])->name('license.update-status');
    Route::get('/api-docs', [DashboardController::class, 'apiDocs'])->name('api-docs');
});
