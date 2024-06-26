<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment; 
class StudentAssignmentController extends Controller
{
    public function getStudents(Request $request, $assignmentId)
    {
      // Find the assignment by assignmentId
    $assignment = Assignment::findOrFail($assignmentId);

    // Get the related course
    $course = $assignment->course;

    // Check if the course has an enrollment
    if ($course->enrolledStudents) {
        // Get the students enrolled in the course
        $students = $course->enrolledStudents;

        return response()->json($students);
    }

    // Handle the case where there is no enrollment for the course
    return response()->json(['error' => 'No enrollment for the course'], 404);
    }
}