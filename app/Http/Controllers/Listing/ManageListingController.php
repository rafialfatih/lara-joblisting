<?php

namespace App\Http\Controllers\Listing;

use App\Http\Controllers\Controller;

class ManageListingController extends Controller
{
    public function index()
    {
        return view("listings.manage", [
            "listings" => auth()->user()->listings()->latest()->get()
        ]);
    }
}
