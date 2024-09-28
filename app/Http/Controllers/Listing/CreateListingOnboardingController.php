<?php

namespace App\Http\Controllers\Listing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CreateListingOnboardingController extends Controller
{
    // Display Onboarding SCreen When user started creating new Listing Item
    public function __invoke()
    {
        return Inertia::render('Listing/Onboarding');
    }

}
