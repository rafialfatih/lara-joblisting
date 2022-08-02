<?php

namespace App\Http\Controllers\Listing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Listing\StoreListingRequest;
use App\Http\Requests\Listing\UpdateListingRequest;
use App\Models\Listing;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    public function index()
    {
        return view("listings.index", [
            "listings" => Listing::latest()->filter(request(['tag', 'search']))->paginate(4)
        ]);
    }

    public function show(Listing $listing)
    {
        return view("listings.show", [
            "listing" => $listing,
        ]);
    }

    public function create()
    {
        return view("listings.create");
    }

    public function store(StoreListingRequest $request)
    {
        $formFields = $request->validated();

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully');
    }

    public function edit(Listing $listing)
    {
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        return view("listings.edit", [
            "listing" => $listing,
        ]);
    }

    public function update(UpdateListingRequest $request, Listing $listing)
    {
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $formFields = $request->validated();

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            if (!empty($listing->logo)) {
                Storage::disk('public')->delete($listing->logo);
            }
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully');
    }

    public function destroy(Listing $listing)
    {
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        if (Storage::disk('public')->delete($listing->logo)) {
            $listing->delete();
        }

        return redirect('/')->with('message', 'Listing deleted successfully');
    }
}
