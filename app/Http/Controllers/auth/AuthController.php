<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login_view()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->type === 'employer') {
                return redirect()->route('employerdashboard');
            } elseif ($user->type === 'job_seeker') {
                return redirect()->route('job_seekerdashboard');
            } else {
                return redirect()->route('dashboard');
            }
        } else {
            return back()->with(['failure' => 'Invalid login credentials']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register_view()
    {
        return view('auth.register');
    }

    /**
     * Display the specified resource.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email','unique:users,email'],
            'password' => ['required', 'confirmed'],
            'type' => 'required|in:employer,job_seeker',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password before saving
            'type' => $request->type,
        ];

        if (User::create($data)) {
            return redirect()->route('login')->with(['success' => 'Successfully registered!']);
        } else {
            return back()->with(['failure' => 'Failed to register!']);
        }
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
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with(['success' => 'Successfully logged out']);
    }
}
