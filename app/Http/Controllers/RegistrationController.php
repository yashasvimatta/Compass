<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function verify($token)
{
    $user = User::where('verification_token', $token)->first();
    if (!$user) {
        return redirect()->route('login')->with('error', 'Invalid verification token.');
    }

    // Check if the token is still valid (you may add expiration logic)
    // Update the user's status to 1
    $user->status = 1;
    $user->save();

    return redirect()->route('login')->with('success', 'Email verification successful. You can now log in.');
}

    public function register(Request $request)
{
    // return response()->json(['success' => true, 'message' => $request]);
    // Validation rules
    $request->validate([
        'selectedRole' => 'required',
        'firstName' => 'required',
        'lastName' => 'required',
        'phone' => 'required|numeric|digits:10|unique:users', // Ensure phone is unique in the 'users' table
        'address' => 'required',
        'dob' => 'required|date',
        'email' => 'required|email|unique:users', // Ensure email is unique in the 'users' table
        'password' => 'required',
        'race' => 'required',
        'ethnicity' => 'required',
        'maritalStatus' => 'required',
        'gender' => 'required'
        // Add more rules for other fields
    ]);

    // Additional custom validation for email and phone
    $emailExists = User::where('email', $request->input('email'))->exists();
    if ($emailExists) {
        return redirect()->back()->withInput()->withErrors(['email' => 'The email address is already in use.']);
    }

    $phoneExists = User::where('phone', $request->input('phone'))->exists();
    if ($phoneExists) {
        return redirect()->back()->withInput()->withErrors(['phone' => 'The phone number is already in use.']);
    }

    // Create a new user instance
    $user = new User();
    $user->fill($request->all());
    $user->role = $request->input('selectedRole');
    $user->first_name = $request->input('firstName');
    $user->last_name = $request->input('lastName');
    $user->marital_status = $request->input('maritalStatus');
    $user->verification_token = Str::uuid();

    // Save the user
    $user->save();

    // Send welcome email
    try {
        Mail::to($user->email)->send(new WelcomeEmail($user));
    } catch (\Exception $e) {
        // Handle email sending failure if needed
    }

    return redirect()->route('login')->with('success', 'Registration successful. Welcome email sent.');
}
}
