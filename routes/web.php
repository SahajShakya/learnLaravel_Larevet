<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
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
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

//store create form
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show Edit form
Route::get('/listings/{listing}/edit',[ListingController::class, 'edit'])->middleware('auth');

// Show Edit form Update

Route::put('/listings/{listing}',[ListingController::class, 'update'])->middleware('auth');
// Delete
Route::delete('/listings/{listing}',[ListingController::class, 'delete'])->middleware('auth');
//MangeListing
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');
//Create form Register
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
//Create form login
Route::post('/users', [UserController::class, 'store']);
//Logout
Route::post('/logout',[UserController::class, 'logout'])->middleware('auth');
//login page
Route::get('/login', [UserController::class, 'login'])->name('login');
//Login user
Route::post('/users/auth',[UserController::class, 'authenticate'])->middleware('guest');
//single listing
Route::get('/{listing}', [ListingController::class, 'show'])->middleware('guest');


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
