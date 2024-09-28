<?php

namespace App\Http\Controllers\Listing;

use App\Http\Controllers\Controller;
use App\Http\Enums\ListingStatus;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CreateDraftListingController extends Controller
{
    //
    public function __invoke(Request $request)
    {
        // check if the session has active editing listing
        if(session('currently_editing_listing')) {
            return redirect()->route('listing.create.basic_details', session('currently_editing_listing'));
        } 

        // create new listing
        $listing = Listing::create([
            'status' => ListingStatus::DRAFT,
            'user_id' => Auth::id()
        ]);

        Session::put('currently_editing_listing', $listing->id);

        return redirect()->route('listing.create.basic_details', $listing);
    }
}
