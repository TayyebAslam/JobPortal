<?php

namespace App\Http\Controllers\employer;

use App\Models\Resume;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\employer_listing\EmployerListingController;

// use App\Http\Controllers\employer\EmployerController;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function profile()
    {
        return view('employer.profile', [
            'user' => Auth::user(),
        ]);

    }

    public function applications()
    {
        // Get the authenticated employer user
        $employer = Auth::user();

        // Retrieve all listings associated with the employer
        $listings = $employer->listings;

        // Retrieve resumes for each listing
        $resumes = collect();

        foreach ($listings as $listing) {
            $resumes = $resumes->merge($listing->resumes);
        }

        return view('employer.application', ['resumes' => $resumes]);
    }

// In your EmployerController.php

public function acceptResume(Request $request, $id)
{
    $this->updateResumeStatus($id, 'accepted');
    return redirect()->back()->with('success', 'Resume accepted successfully');
}

public function rejectResume(Request $request, $id)
{
    $this->updateResumeStatus($id, 'rejected');
    return redirect()->back()->with('success', 'Resume rejected successfully');
}

private function updateResumeStatus($id, $status)
{
    $resume = Resume::find($id);
    if ($resume) {
        // Update the status in the database
        $resume->status = $status;
        $resume->save();
    }
}

}
