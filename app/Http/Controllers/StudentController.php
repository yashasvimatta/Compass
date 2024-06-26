<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Adjust the model namespace accordingly
use App\Models\Course;
use App\Models\Feedback;
use App\Models\CourseEnrollment; 
use App\Models\Assignment;
use App\Models\AssignmentSubmission;// Adjust the model namespace accordingly

class StudentController extends Controller
{
    public function showDashboard(Request $request)
    {
      // Assuming you have a $studentId variable representing the current student's ID
$studentId = $request->session()->get('user')->id;

// Get the IDs of courses the student has already enrolled in
$enrolledCourseIds = CourseEnrollment::where('user_id', $studentId)->pluck('course_id')->toArray();

// Get the courses that the student has not enrolled in
$courses = Course::whereIn('id', $enrolledCourseIds)
                ->orderBy('id', 'DESC')
                ->get();
        return view('student.dashboard',  compact('courses'));

    }
    public function enroll(Request $request,$course_id)
    {
        $id = $request->session()->get('user')->id;
        CourseEnrollment::create([
            'user_id' => $id,
            'course_id' => $course_id,
        ]);

        return response()->json(['message' => 'Enrollment successful']);
    }
    public function enrollStudents(Request $request)
    {
// Assuming you have a $studentId variable representing the current student's ID
$studentId = $request->session()->get('user')->id;

// Get the IDs of courses the student has already enrolled in
$enrolledCourseIds = CourseEnrollment::where('user_id', $studentId)->pluck('course_id')->toArray();

// Get the courses that the student has not enrolled in, including instructor information
$courses = Course::with('instructor') // Assuming the relationship is named 'instructor' in the Course model
    ->whereNotIn('id', $enrolledCourseIds)
    ->orderBy('id', 'DESC')
    ->get();

return view('student.enrollstudent', compact('courses'));
        // $courses = Course::orderBy('id', 'DESC')->get();

        // return view('student.enrollstudent',  compact('courses'));

    }
    public function getprofile(Request $request)
    {
    $userData = $request->session()->get('user');
    // Fetch the user data for the logged-in student
    $profile = User::find($userData->id);
    return view('student.profile',  compact('profile'));
    }

    public function saveCourse(Request $request)
{
  // Validation rules
  $request->validate([
    'course_name' => 'required',
    'course_code' => 'required',
    'course_desc' => 'required',
]);
$request->session()->start();
$userData = $request->session()->get('user');
    // Create a new course instance
    $course = new Course();

    // Set the course attributes
    $course->course_name = $request->input('course_name');
    $course->user_id = $userData->id;
    $course->course_code = $request->input('course_code');
    $course->course_desc = $request->input('course_desc');
    // Set other attributes as needed

    // Save the course to the database
    $course->save();

   // Use session to store a message
   session()->flash('success', 'Course Added successfully');

   return redirect()->back();
}
public function managecourses()
{
    $courses = Course::orderBy('id', 'DESC')->get();

    return view('instructor.managecourses', ['courses' => $courses]);
}
public function feedbackcreate()
{
    $users = User::where('role', 'instructor')->orderBy('id', 'DESC')->get();;

    return view('student.feedback', compact('users'));
}

public function feedbackstore(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'feedback_for' => 'required|exists:users,id',
        'feedback' => 'required',
        'subject' => 'required',
    ]);

    // Create a new feedback record
    Feedback::create([
        'user_id' => $request->session()->get('user')->id, // Assuming the currently logged-in user is giving the feedback
        'feedback_for' => $validatedData['feedback_for'],
        'feedback' => $validatedData['feedback'],
        'subject' => $validatedData['subject'],
    ]);

    return redirect()->route('feedbackcreate')->with('success', 'Feedback submitted successfully!');
}
public function getassignmentbycourse($courseId)
{
    // Assuming you have a relationship between Assignment and Course models
    $assignments = Assignment::where('course_id', $courseId)->get();

    // You can return the assignments or use them as needed
    return view('student.assignment', ['assignments' => $assignments]);
}
public function upload(Request $request)
    {
        $instructorId = $request->session()->get('user')->id;
        $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
            'file' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('assignment_submissions', 'public');

        $submission = AssignmentSubmission::create([
            'assignment_id' => $request->input('assignment_id'),
            'student_id' => $instructorId,
            'file_path' => $filePath,
        ]);

        return view('student.assignment', ['assignments' => $assignments]);
    }
    function getCourseInformationForUser(Request $request, $courseId)
{
    // Get the user
    $user = User::find($request->session()->get('user')->id);

    if (!$user) {
        // Handle the case where the user is not found
        return null;
    }

    // Get the course
    $course = Course::find($courseId);

    if (!$course) {
        // Handle the case where the course is not found for the user
        return null;
    }

    // Calculate total marks, obtained marks, and grade
    $totalMarks = 0;
    $obtainedMarks = 0;

    // Loop through assignments for the course
    foreach ($course->assignments as $assignment) {
        // Assuming 'total_marks' is a field in the Assignment model
        $totalMarks += 100;

        // Check if there is a submission for the assignment by the current user
        $submission = $assignment->submissions()->where('student_id', $request->session()->get('user')->id)->first();

        // If a submission exists, add the obtained marks
        if ($submission) {
            $obtainedMarks += $submission->obtained_marks;
        }
    }

    // Calculate the grade based on your grading criteria
    $grade = calculateGrade($obtainedMarks, $totalMarks);

    // Return the information
    return [
        'course_name' => $course->course_name,
        'total_marks' => $totalMarks,
        'obtained_marks' => $obtainedMarks,
        'grade' => $grade,
    ];
}
}
