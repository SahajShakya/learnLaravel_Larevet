<?php

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
Route::get('/listing', function () {
    return view('listings', [
        'heading' => 'Sent from value',
        'listings' => \App\Models\Listing::all(),
    ]);
});
//single listing

Route::get('/listing/{listing}', function (Listing $listing) {
    return view('listing', [
        'listing' => $listing
    ]);
});

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
