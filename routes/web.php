<?php

use App\Http\Controllers\Listing\CreateListingController;
use App\Http\Controllers\Listing\ShowListingDetailController;
use App\Http\Controllers\ProfileController;
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
})->name('home');



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['inertia.auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/listing/create', CreateListingController::class)->name('listing.create');
});

Route::get('/listing/{id}', ShowListingDetailController::class)->name('listing.show');


Route::get('/auth/google', fn() => "")->name('auth.google');
Route::get('/auth/facebook', fn() => "")->name('auth.facebook');

require __DIR__.'/auth.php';
