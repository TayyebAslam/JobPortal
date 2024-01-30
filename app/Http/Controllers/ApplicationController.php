<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function applications(Resume $resume)
    {

        $userId = Auth::id();

        // Retrieve only the applications associated with the authenticated user's ID
        $resume = Resume::where('user_id', $userId)->get();

        return view('employer.application',[
            'resume' => $resume,
        ]);


    }
}
