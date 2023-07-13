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
        $formFields['user_id'] = auth()->id();
        Listing::create($formFields);
//        Session::flash('message', 'Listing created');
        return redirect('/')->with('message', 'Listing created successfully');
    }

        public function edit(Listing $listing) {
            return view('listings.edit',['listing'=> $listing]);
        }

    public function update(Request $request, Listing $listing) {
        //Make sure Logged user is owner
        if($listing->user_id != auth()->id) {
            abort(403, 'Unauthorized Action');
        }
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
        if($listing->user_id != auth()->id) {
            abort(403, 'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing Deleted successfully');
    }

    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
