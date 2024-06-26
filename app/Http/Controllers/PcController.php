<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Adjust the model namespace accordingly
use App\Models\Course;
use App\Models\Feedback;
use App\Models\CourseEnrollment; // Adjust the model namespace accordingly

class PcController extends Controller
{
    public function showDashboard(Request $request)
    {
        $totalStudents = User::where('role', 'student')->count();
        $totalInstructors = User::where('role', 'instructor')->count();
        return view('pc.dashboard', compact(
            'totalStudents',
            'totalInstructors'
        ));

    }
    public function communications(Request $request)
    {
        return view('pc.communications');
    }
    public function getfeedback()
    {
        $feedbackData = Feedback::join('users as u1', 'feedbacks.user_id', '=', 'u1.id')
        ->join('users as u2', 'feedbacks.feedback_for', '=', 'u2.id')
        ->where('u2.role', '=', 'Instructor')
        ->select('u1.first_name as user_name', 'feedbacks.subject', 'feedbacks.feedback', 'u2.first_name as feedback_for_name')
        ->get();
    
    return response()->json($feedbackData);
    }
  
}
