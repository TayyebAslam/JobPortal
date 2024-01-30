<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class CreateListingController extends Controller
{
    public function createlist()
    {
        return view('admin.createlisting', [
            'admin' => Auth::user(),
        ]);
    }

    public function editlist($id)
    {
        $listing = Listing::find($id);

        if ($listing) {
            return view('admin.employeredit', ['listing' => $listing]);
        } else {
            return back()->with(['failure' => 'Listing not found!']);
        }
    }
}
