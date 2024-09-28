<?php

namespace App\Http\Controllers\Listing;

use App\Http\Controllers\Controller;
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
