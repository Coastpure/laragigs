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


            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
             //above, we are sorting by the latest instead of a random order by using all()
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


    //Store and save Listing Data          listing data is submitted here
    public function store(Request $request) {
        //Validate
       $formFields = $request->validate([
        'title' => 'required',
        'company' => ['required', Rule::unique('listings', 'company')], //make company name unique
        'location' => 'required',
        'website' => 'required',
        'email' => ['required', 'email'],  //has to be formatted as an email
        'tags' => 'required',
        'description' => 'required',
       ]);

       //upload logo image
       if($request->hasFile('logo')) {
        $formFields['logo'] = $request->file('logo')->store('logos', 'public');
       }

       $formFields['user_id'] = auth()->id();

        //this is the action of this function
       Listing::create($formFields);


       //Notification message that appears when new listing is created
       return redirect('/')->with('message', 'Listing created succesfully!');

    }



       //Show Edit Form
       public function edit(Listing $listing)
       {
        return view('listings.edit', ['listing' => $listing] );
       }



        //Update listing data
       public function update(Request $request, Listing $listing) {

        //Make sure logged in user is owner 
        if ($listing->user_id != auth()->id()) {
            abort(403, "Unaothorized Action");
        }


        //Validate
       $formFields = $request->validate([
        'title' => 'required',
        'company' => ['required',],
        'location' => 'required',
        'website' => 'required',
        'email' => ['required', 'email'],  //has to be formatted as an email
        'tags' => 'required',
        'description' => 'required',
       ]);

       //logo
       if($request->hasFile('logo')) {
        $formFields['logo'] = $request->file('logo')->update('logos', 'public');
       }

        //this is the action of this function, we want it to update the listing
       $listing->update($formFields);


       //here we use back to redirect the user to their previous location
       return back()->with('message', 'Listing updated succesfully!');
    }

    //Delete Listing
    public function destroy(Listing $listing) {

        //Make sure logged in user is owner 
        if ($listing->user_id != auth()->id()) {
            abort(403, "Unaothorized Action");
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted succesfully');
    }

    //Manage Listings
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);    }
}
