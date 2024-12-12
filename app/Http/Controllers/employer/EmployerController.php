<?php

namespace App\Http\Controllers\employer;

use App\Models\Resume;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\employer_listing\EmployerListingController;

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

    /**
     * Display the applications (resumes) for each job listing.
     */
    public function applications()
    {
        // Get the authenticated employer user
        $employer = Auth::user();

        // Retrieve all listings associated with the employer
        $listings = $employer->listings;

        // Retrieve resumes for each listing
        $resumes = $listings->flatMap(function ($listing) {
            return $listing->resumes;
        });

        return view('employer.application', ['resumes' => $resumes]);
    }

    /**
     * Accept a resume.
     */
    public function acceptResume($id)
    {
        return $this->updateResumeStatus($id, 'accepted');
    }

    /**
     * Reject a resume.
     */
    public function rejectResume($id)
    {
        return $this->updateResumeStatus($id, 'rejected');
    }

    /**
     * Update the resume status (accepted/rejected).
     */
    private function updateResumeStatus($id, $status)
    {
        // Find the resume by ID
        $resume = Resume::find($id);

        if (!$resume) {
            return redirect()->back()->with('error', 'Resume not found');
        }

        // Update the status in the database
        $resume->status = $status;
        $resume->save();

        return redirect()->back()->with('success', 'Resume ' . ucfirst($status) . ' successfully');
    }
}
