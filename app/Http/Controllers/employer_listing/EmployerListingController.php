<?php

namespace App\Http\Controllers\employer_listing;

use App\Models\User;
use App\Models\listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\employer_listing\EmployerListingController;

class EmployerListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listings = listing::all();
        return view('employer.job_listings.show', [
            'listings' => $listings,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $data = [
        //     'listings' => listing::all(),
        //     'listing' => $listing,
        // ];

        return view('employer.job_listings.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'company_name' => ['required'],
            'job_category' => ['required'],
            'salary' => ['required'],
            'vacancies_available' => ['required'],
            'email' => ['required'],
            'picture' => ['image', 'mimes:png,jpg,jpeg,webp'],
            'contact_no' => ['required'],
            'description' => ['required'],
            'address' => ['required'],
        ]);

        if ($request->picture) {
            $name = microtime(true) . $request->picture->hashName();
            $request->picture->move(public_path('template/img/company_photos'), $name);
        } else {
            $name = null;
        }

        $data = [
            'company_name' => $request->company_name,
            'job_category' => $request->job_category,
            'salary' => $request->salary,
            'vacancies_available' => $request->vacancies_available,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'description' => $request->description,
            'address' => $request->address,
            'picture' => $name,
        ];

        if (listing::create($data)) {
            return back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(listing $listing)
    {
        return view('employer.job_listings.index', [
            'listing' => $listing,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
