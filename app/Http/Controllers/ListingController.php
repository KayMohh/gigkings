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
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
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

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);




        return redirect('/')->with('message', 'Listing Created Successfully!');
    }

    public function edit(Listing $listing)
    {
        // dd($listing);
        return view('listings.edit', ['listing' => $listing]);
    }
    // //Update
    public function update(Request $request, Listing $listing)
    {
        // dd($request->all());
        $formFields = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'email' => ['required', 'email'],

        ]);
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);




        return back()->with('message', 'Listing Updated Successfully!');
    }

    //Delete Listing

    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect('/')->with('message', 'Listing Deleted Successfully');
    }

    // public function manage()
    // {
    //     return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    // }

    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
