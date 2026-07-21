<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminController;
//halaman pertama
Route::get('/', function () {
//abis login langsung ke dashboard
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return view('landing');

});

Auth::routes();

//  abis login
Route::get('/home', function () {
    return redirect()->route('dashboard');
});

// Route yang wjb login
Route::middleware('auth')->group(function () {

    // Dashboard user
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // CRUD Event
    Route::resource('events', EventController::class);

    // Gabung Event
    Route::post('/events/{event}/join', [EventController::class, 'join'])
        ->name('events.join');
});

// route khusus Admin
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // Ubah Role
    Route::patch('/admin/user/{user}/role', [AdminController::class, 'changeRole'])
        ->name('admin.changeRole');

    // Ban / Unban User
    Route::patch('/admin/user/{user}/ban', [AdminController::class, 'toggleBan'])
        ->name('admin.toggleBan');

});