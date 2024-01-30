<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\listing;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class JobSeekerController extends Controller
{
    public function index()
    {
        return view('jobseeker.jobseeker');
    }
    public function profile()
    {
        return view('jobseeker.seekerprofile', [
            'user' => Auth::user(),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email']
        ]);
        $jobseeker = User::find(Auth::id());

        if ($jobseeker->update($request->all())) {
            return back()->with(['success' => 'Successfully updated!']);
        } else {
            return back()->with(['failure' => 'Failed to update!']);
        }
    }
    public function password(Request $request)
    {
        $jobseeker = User::find(Auth::id());
        $request->validate([
            'password' => ['required', 'confirmed'],
            'current_password' => ['required'],
        ]);

        if (Hash::check($request->current_password, $jobseeker->password)) {
            $data = [
                'password' => Hash::make($request->password),
            ];

            if ($jobseeker->update($data)) {
                return back()->with(['success' => 'Password Successfully Updated!']);
            } else {
                return back()->with(['failure' => 'Failed to update password!']);
            }
        } else {
            return back()->withErrors(['current_password' => 'Current password does not match!']);
        }
    }
    public function picture(Request $request)
    {
        $jobseeker = User::find(Auth::id());
        $request->validate([
            'picture' => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:10240'],
        ]);

        $old_picture_path = 'template/img/seekerphotos/' . $jobseeker->picture;

        if ($jobseeker->picture && File::exists(public_path($old_picture_path))) {
            unlink(public_path($old_picture_path));
        }

        $new_file_name = "ACI-MAGICIANS" . microtime(true) . "." . $request->picture->getClientOriginalExtension();

        $data = [
            'picture' => $new_file_name,
        ];

        if ($request->picture->move(public_path('template/img/seekerphotos/'), $new_file_name)) {
            if ($jobseeker->update($data)) {
                return back()->with(['success' => 'Picture Successfully updated!']);
            } else {
                return back()->with(['failure' => 'Failed to update!']);
            }
        } else {
            return back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }
    public function job()
    {
        $listings = Listing::all();
        return view('jobseeker.applyjob', ['listings' => $listings]);
    }
    public function showjobs(listing $listing)
    {
        // $listings = listing::all();


        return view('jobseeker.showjobs', [
            'listing' => $listing
        ]);
    }
    public function apply($listingId)
    {
        $listing = listing::find($listingId);

        if (!$listing) {
            return back()->with(['failure' => 'Listing not found!']);
        }

        return view('jobseeker.applied', ['listing' => $listing]);
    }

    public function store_application(Request $request, $listingId)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'contact_no' => ['required'],
            'pdf' => ['required', 'file', 'mimes:pdf'],
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Find the listing by ID
        $listing = listing::find($listingId);


        // Create a new application record

        if ($request->hasFile('pdf')) {
            $name = microtime(true) . '.' . $request->pdf->getClientOriginalExtension();
            $request->pdf->move(public_path('template/img/resume'), $name);
        } else {
            $name = null;
        }

        $data = [
            'user_id' => $user->id,
            'listing_id' => $listing->id,
            'name' => $request->name,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'pdf' => $name,
            // 'pdf' => $request->file('pdf')->store('pdfs', 'public'), // Adjust the storage path as needed
            // Add other application data
        ];


        // dd($application);
        // return redirect()->route('apply', $listing)->with('success', 'Application submitted successfully!');
        if (Resume::create($data)) {
            return back()->with(['success' => 'Resume has been sent!']);
        } else {
            return back()->with(['failure' => 'so sorry!']);
        }
    }

    public function showjsapplication(){

        $resumes = Resume::all();

        // dd($resumes);

        return view('jobseeker.myapplication', [
            'resumes' => $resumes
        ]);

    }
}
