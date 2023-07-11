<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\oldListing;
use App\Models\Listing;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//all listings
Route::get('/', [ListingController::class, 'index']);

//show create form
Route::get('/listings/create', [ListingController::class, 'create']);

//store create form
Route::post('/listings', [ListingController::class, 'store']);


//single listing
Route::get('/{listing}', [ListingController::class, 'show']);

//common Resources Routes
// index => show all listing
// show => show single listing
// create => show form to create new listing
// store => show new listing
// edit => show form to edit listing
// update => update listing
// destroy => delete Listing

//Route::get('/listing/{id}', function ($id) {
//    return "Hello {$id}";
//});

//
//Route::get('/hello', function () {
//    return response('<h1>Hello World</h1>', 200)
//        ->header('Content-Type','text/plain')
//        ->header('foo','bar');
//});
//
//Route::get('/posts/{id}', function($id) {
//    ddd($id);
//    return response('Post ' .$id);
//})->where('id','[0-9]+');
//
//Route::get('/search', function(Request $request) {
//    return $request->name;
//});
