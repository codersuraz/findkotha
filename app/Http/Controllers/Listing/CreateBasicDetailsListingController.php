<?php

namespace App\Http\Controllers\listing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CreateBasicDetailsListingController extends Controller
{
    //
    public function __invoke(Request $request)
    {
        return Inertia::render('Listing/BasicDetails');
    }
}
