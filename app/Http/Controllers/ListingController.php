<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Faker\Provider\ar_EG\Company;

class ListingController extends Controller
{
    //
    public function index()
    {
        // dd($request);
        return view('listings.index', [
            'heading' => 'Latest Listings',
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
        ]);
    }

    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //Show Create View
    public function create()
    {
        return view('listings.create');
    }

    //Store listings
    public function store(Request $request)
    {
        // dd($request->all());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'email' => ['required', 'email'],

        ]);

        Listing::create($formFields);




        return redirect('/')->with('message', 'Listing Created Successfully!');
    }
}
