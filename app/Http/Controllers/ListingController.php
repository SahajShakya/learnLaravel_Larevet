<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use MongoDB\Driver\Session;

class ListingController extends Controller
{
    //Show all listings
    public function  index() {
//        dd(request('tag'));
        return view('listings.index', [
              'listings' => Listing::latest()->filter(request(['tag','search']))->paginate(6)
//            'listings' => Listing::latest()->filter(request(['tag','search']))->simplePaginate(6)
            ///in query select * from 'listing' order by 'created at' desc  (Listing::latest())
        ]);
    }
    //show single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    public function create() {
        return view('listings.create');
    }

    public function store(Request $request) {
//        dd($request->all());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        Listing::create($formFields);
//        Session::flash('message', 'Listing created');
        return redirect('/')->with('message', 'Listing created successfully');
    }

        public function edit(Listing $listing) {
            return view('listings.edit',['listing'=> $listing]);
        }

    public function update(Request $request, Listing $listing) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $listing->update($formFields);
//        Session::flash('message', 'Listing created');
        return redirect('/')->with('message', 'Listing update successfully');
//        return back()->with('message', 'Listing update successfully');
    }

    //Delete
    public function delete(Listing $listing) {
        $listing->delete();
        return redirect('/')->with('message', 'Listing Deleted successfully');
    }
}
