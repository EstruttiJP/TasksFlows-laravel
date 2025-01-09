<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('employees.index');
    Route::get('/employees/{user}', [UserController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{user}', [UserController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{user}', [UserController::class, 'destroy'])->name('employees.destroy');
});
