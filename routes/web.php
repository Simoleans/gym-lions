<?php

use App\Http\Controllers\{
    ProfileController,
    UsersController,
    AttendanceController
};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //users resources
    Route::resource('users', UsersController::class);
    Route::post('/users/{user}/renew-subscription', [UsersController::class, 'renewSubscription'])->name('users.renew-subscription');
});

//attendance create
Route::get('/asistencias/escanear', [AttendanceController::class, 'create'])->name('attendance.create');
Route::post('/asistencias/escanear', [AttendanceController::class, 'store'])->name('attendance.store');
require __DIR__.'/auth.php';
