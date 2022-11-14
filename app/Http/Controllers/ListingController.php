<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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


     //show create form
     public function create() {
        return view('listings.create');
    }

    //Store Listing Data
    public function store(Request $request) {
       $formFields = $request->validate([
        'title' => 'required',
        'company' => ['required', Rule::unique('listings', 'company')], //make company name unique
        'location' => 'required',
        'website' => 'required',
        'email' => ['required', 'email'],  //has to be formatted as an email
        'tags' => 'required',
        'description' => 'required',
       ]);

       Listing::create($formFields);


       return redirect('/')->with('message', 'Listing created succesfully!');
    }

}
