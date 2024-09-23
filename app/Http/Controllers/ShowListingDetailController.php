<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShowListingDetailController extends Controller
{
    //
    public function __invoke()
    {
        return Inertia::render('Listing/Show');
    }
}
