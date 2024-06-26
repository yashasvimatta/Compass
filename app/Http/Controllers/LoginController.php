<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User; 
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\Mail;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
    public function forgotPassword(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
    
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        try {
            Mail::to($user->email)->send(new ForgotPassword($user));
            return response()->json(['message' => 'Password reset email sent'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to send password reset email'], 500);
        }
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $email = $request->input('email');
    $password = $request->input('password');

    // Check the user's credentials and status
    $user = DB::table('users')->where('email', $email)->first();
    if ($user && $password == $user->password && $user->status == 1) {
        // Authentication passed...
        $request->session()->put('user', $user);
        // Check user role
        if ($user->role == 'admin') {
            // Redirect to admin dashboard
            return redirect()->route('admin.dashboard');
        }
        else if ($user->role == 'instructor') {
            return redirect()->route('instructor.dashboard');
        }
        else if ($user->role == 'student') {
            return redirect()->route('student.dashboard');
        }
        else if ($user->role == 'Quality_Assurance') {
            return redirect()->route('qa.dashboard');
        }
        else if ($user->role == 'Program_Coordinator') {
            return redirect()->route('pc.dashboard');
        }
        else if ($user->role == 'Quality_Assurance') {
            return redirect()->route('qa.dashboard');
        }
  

        // Redirect to the intended URL or a default route
        return redirect()->intended('/dashboard');
    } else {
        // Authentication failed...
        return redirect()->back()->with('error', 'Invalid email or password.');
    }
}
}
