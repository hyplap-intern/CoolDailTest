<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Import Hash facade for password hashing

class UserController extends Controller
{
    public function register(Request $request) {
        // Validate the incoming request data
        $data = $request->validate([
            'name' => 'required|string|max:255', // Validate name
            'email' => 'required|email|unique:users,email|max:255', // Validate email and check if unique
            'password' => 'required|string|confirmed|min:8', // Validate password (with confirmation)
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 8 characters long.',
        ]);

        // Hash the password before saving it to the database
        $data['password'] = Hash::make($data['password']);

        // Create the user
        try {
            $user = User::create($data);
        } catch (\Exception $e) {
            // Handle the case where the user creation fails due to unexpected errors
            return redirect()->back()->with('error', 'Registration failed. Please try again.');
        }

        if ($user) {
            // Redirect to the login page with a success message
            return redirect()->route('login')->with('success', 'Registration successful! Please login.');
        }

        // If user creation failed, return an error
        return redirect()->back()->with('error', 'Registration failed. Please try again.');
    }

    public function login(Request $request) {
        // Check if the user is already logged in
        if (Auth::check()) {
            // Redirect to the dashboard if the user is authenticated
            return redirect()->route('dashboard');
        }
    
        // If the user is not logged in, proceed with login validation and form submission
        $credentials = $request->validate([
            'email' => 'required|email', // Validate email
            'password' => 'required|min:8', // Validate password length
        ], [
            'email.required' => 'Email is required.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
        ]);
    
        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')->with('success', 'Logged in successfully.');
        }
    
        // If authentication fails, return an error message
        return redirect()->back()->with('error', 'Login failed. Please check your credentials and try again.');
    }
        public function dashboard() {
        if (Auth::check()) {
            return view('Auth.dashboard');
        }
        return redirect()->route('login');
    }

    public function logout() {
        Auth::logout();
        return view('Auth.dashboard');
    }
}
