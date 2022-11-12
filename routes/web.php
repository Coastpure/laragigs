<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// NAMING CONVENTIONS
// Common Resource Routes: 
// index - show all listings 
// show - show single listing 
// create - show form to create new listing 
// store - store new listings 
// edit - show form to edit listings
// destroy - delete listing



//all listings
Route::get('/', [ListingController::class, 'index']); 
/* we want that slash to go to the listing controller and the index method, 
so we can pass in [ListingController::class, 'index'] , the method is 'index' */ 
//in the controller, we will put it as  return view('listings.index',)


//show Create form
Route::get('/listings/create', [ListingController::class, 'create']); 


//single listing
Route::get('/listings/{listing}', [ListingController::class, 'show']); 
//show is the index method here, in the controler it will be put as return view('listings.show')
//{listing} is the id of the listing, thus when you click on it it will show you details of the listing with that id