<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{

    //show all listings
    public function index() {    
        return view('listings.index', [ //return index file in a folder called listings


            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
             //above, we are sorting by the latest instead of a random order in all()
        ]);
    }

    //show single listing
    public function show(Listing $listing ) { /*show will take in a listing, 
        so we'll pass in Listing and the variable name of Listing i.e $listing*/
        return view('listings.show', [ //return show file in a folder called listings
            'listing' => $listing
        ]);
    }
}
