<?php

namespace App\Http\Controllers\employer_listing;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class EmployerListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $listings = $user->listings;

        return view('employer.job_listings.show', compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employer.job_listings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'job_category' => 'required',
            'salary' => 'required',
            'vacancies_available' => 'required',
            'email' => 'required|email',
            'contact_no' => 'required',
            'description' => 'required',
            'address' => 'required',
            'picture' => 'nullable|image|mimes:png,jpg,jpeg,webp',
        ]);

        // Handle picture upload
        $picturePath = $this->handlePictureUpload($request);

        $listing = Listing::create([
            'company_name' => $request->company_name,
            'job_category' => $request->job_category,
            'salary' => $request->salary,
            'vacancies_available' => $request->vacancies_available,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'description' => $request->description,
            'address' => $request->address,
            'picture' => $picturePath,
            'user_id' => Auth::id(),
        ]);

        return $listing
            ? back()->with('success', 'Job listing created successfully!')
            : back()->with('failure', 'Failed to create job listing!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return view('employer.job_listings.index', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return view('employer.job_listings.edit', compact('listing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $request->validate([
            'company_name' => 'required',
            'job_category' => 'required',
            'salary' => 'required',
            'vacancies_available' => 'required',
            'email' => 'required|email',
            'contact_no' => 'required',
            'picture' => 'nullable|image|mimes:png,jpg,jpeg,webp',
        ]);

        // Handle picture upload if new picture is provided
        $picturePath = $this->handlePictureUpload($request, $listing);

        $listing->update([
            'company_name' => $request->company_name,
            'job_category' => $request->job_category,
            'salary' => $request->salary,
            'vacancies_available' => $request->vacancies_available,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'picture' => $picturePath ?? $listing->picture,  // Only update if new picture is uploaded
        ]);

        return back()->with('success', 'Job listing updated successfully!');
    }

    /**
     * Add description and address to the listing.
     */
    public function add_desc(Request $request, Listing $listing)
    {
        $request->validate([
            'description' => 'required',
            'address' => 'required',
        ]);

        $listing->update([
            'description' => $request->description,
            'address' => $request->address,
        ]);

        return back()->with('success', 'Description and address updated successfully!');
    }

    /**
     * Update employer password.
     */
    public function password(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if (Hash::check($request->current_password, $user->password)) {
            $user->update(['password' => Hash::make($request->password)]);

            return back()->with('success', 'Password updated successfully!');
        }

        return back()->withErrors(['current_password' => 'Current password does not match.']);
    }

    /**
     * Handle profile picture upload.
     */
    public function picture(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'picture' => 'required|image|mimes:png,jpg,jpeg,webp|max:10240',
        ]);

        // Delete the old picture if it exists
        $old_picture_path = public_path('template/img/employerphotos/' . $user->picture);
        if ($user->picture && File::exists($old_picture_path)) {
            unlink($old_picture_path);
        }

        // Handle new picture upload
        $new_picture_name = "ACI-MAGICIANS_" . microtime(true) . "." . $request->picture->getClientOriginalExtension();
        $request->picture->move(public_path('template/img/employerphotos/'), $new_picture_name);

        $user->update(['picture' => $new_picture_name]);

        return back()->with('success', 'Profile picture updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        if ($listing->delete()) {
            return redirect()->route('showlisting')->with('success', 'Job listing deleted successfully!');
        }

        return redirect()->route('showlisting')->with('failure', 'Failed to delete job listing!');
    }

    /**
     * Handle picture upload logic.
     */
    private function handlePictureUpload(Request $request, Listing $listing = null)
    {
        if ($request->hasFile('picture')) {
            // Delete old picture if it exists for the listing
            if ($listing && $listing->picture && File::exists(public_path('template/img/company_photos/' . $listing->picture))) {
                unlink(public_path('template/img/company_photos/' . $listing->picture));
            }

            // Upload new picture to the public folder
            $name = microtime(true) . $request->picture->hashName();
            $request->picture->move(public_path('template/img/company_photos'), $name);

            return $name;
        }

        return null;
    }
}
