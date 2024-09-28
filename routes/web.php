<?php

use App\Http\Controllers\listing\CreateBasicDetailsListingController;
use App\Http\Controllers\Listing\CreateDraftListingController;
use App\Http\Controllers\Listing\CreateListingController;
use App\Http\Controllers\Listing\CreateListingOnboardingController;
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

Route::get('/search', fn() => Inertia::render('Search/Index'))->name('search');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['inertia.auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/listing/create/get-started', CreateListingOnboardingController::class)->name('listing.create.onboarding');
    Route::get('/listing/create/draft', CreateDraftListingController::class)->name('listing.create.draft');
    Route::get('/listing/create/{listing}/basic-details', CreateBasicDetailsListingController::class)->name('listing.create.basic_details');
    // Route::get('/listing/create/location', CreateLocationListingController::class)->name('listing.create.location');
    // Route::get('/listing/create/photos', CreatePhotosListingController::class)->name('listing.create.photos');
    // Route::get('/listing/create/amenities', CreateAmenitiesListingController::class)->name('listing.create.amenities');
    // Route::get('/listing/create/pricing', CreatePricingListingController::class)->name('listing.create.pricing');
    // Route::get('/listing/create/description', CreateDescriptionListingController::class)->name('listing.create.description');
    // Route::get('/listing/create/publish', CreatePublishListingController::class)->name('listing.create.publish');
});

Route::get('/listing/{id}', ShowListingDetailController::class)->name('listing.show');


Route::get('/auth/google', fn() => "")->name('auth.google');
Route::get('/auth/facebook', fn() => "")->name('auth.facebook');

require __DIR__.'/auth.php';
