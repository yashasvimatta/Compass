<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Adjust the model namespace accordingly
use App\Models\Course; 
use App\Models\Feedback;
use App\Models\Assignment;
use Illuminate\Support\Facades\DB;

use App\Models\StudentAssignment;// Adjust the model namespace accordingly

class InstructorController extends Controller
{
    public function showDashboard(Request $request)
    {
        $instructorId = $request->session()->get('user')->id;
        $courses = Course::where('user_id', $instructorId)
                        ->orderBy('id', 'DESC')
                        ->get();
        // $courses = Course::orderBy('id', 'DESC')->get();
        return view('instructor.dashboard',  compact('courses'));
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
public function managecourses(Request $request)
{
    $instructorId = $request->session()->get('user')->id;
    $courses = Course::where('user_id', $instructorId)
                    ->orderBy('id', 'DESC')
                    ->get();
    return view('instructor.managecourses', ['courses' => $courses]);
}
public function feedbackcreate()
{
    $users = User::where('role', 'student')->orderBy('id', 'DESC')->get();;

    return view('instructor.feedback', compact('users'));
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

    return redirect()->route('instructorfeedbackcreate')->with('success', 'Feedback submitted successfully!');
}
public function createassignment(Request $request)
{
    $instructorId = $request->session()->get('user')->id;
    $courses = Course::where('user_id', $instructorId)
                    ->orderBy('id', 'DESC')
                    ->get();
                    return view('instructor.createassignment', ['courses' => $courses]);
}

public function storeassignment(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'due_date' => 'required|date',
        'file' => 'file|mimes:pdf,doc,docx|max:10240', // Adjust file validation as needed
    ]);

    $instructorId = $request->session()->get('user')->id;

    $assignment = new Assignment([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'due_date' => $request->input('due_date'),
    ]);

    // Handle file upload if a file is provided
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filePath = $file->store('assignments', 'public'); // Store file in the 'public' disk under 'assignments' directory
        $assignment->file_path = $filePath;
    }
    $assignment->user_id = $instructorId;
    $assignment->course_id = $request->input('course_id');
    // Save the assignment
    $assignment->save();

    return redirect()->route('assignments.create')->with('success', 'Assignment created successfully.');
}
public function addmarks(Request $request)
{
    $instructorId = $request->session()->get('user')->id;
    $assignments = Assignment::where('user_id', $instructorId)
                    ->orderBy('id', 'DESC')
                    ->get();
                    return view('instructor.addmarks', ['assignments' => $assignments]);
}

public function savemarks(Request $request)
{
    // Validate the form data
    $request->validate([
        'assignment_id' => 'required|exists:assignments,id',
        'student_id' => 'required|exists:users,id', // Make sure to replace 'students' with the actual table name for students
        'marks_obtained' => 'required|numeric|max:100',
        'grade' => 'required',
    ]);

    // Create or update the student assignment record
    $studentAssignment = StudentAssignment::updateOrCreate(
        [
            'assignment_id' => $request->input('assignment_id'),
            'student_id' => $request->input('student_id'),
        ],
        [
            'marks_obtained' => $request->input('marks_obtained'),
            'grade' => $request->input('grade'),
        ]
    );

    // You can add any additional logic or redirect as needed
    return redirect()->route('instructoraddmarks')->with('success', 'Marks saved successfully!');
}
public function studentProgress()
{

    // $instructorId = $request->session()->get('user')->id;
    // $courses = Course::where('user_id', $instructorId)
    //                 ->orderBy('id', 'DESC')
    //                 ->get();

    // Get all students
    $students = User::where('role', 'student')->get();

    // Initialize an empty array to store the student progress data
    $studentProgressData = [];

    // Loop through each student
    foreach ($students as $student) {
        // Get the courses for the student
        $courses = $student->enrolledCourses;

        // Loop through each course
        foreach ($courses as $course) {
            // Initialize total marks for the student and course
            $totalMarks = 0;

            // Get the assignments for the course
            $assignments = $course->assignments;

            // Loop through each assignment
            foreach ($assignments as $assignment) {
                // Get the marks obtained by the student for the assignment
                $marksObtained = DB::table('student_assignments')
                    ->where('assignment_id', $assignment->id)
                    ->where('student_id', $student->id)
                    ->value('marks_obtained');

                // If marks are obtained, add them to the total
                if ($marksObtained !== null) {
                    $totalMarks += $marksObtained;
                }
            }

            // Add the student progress data to the array
            $studentProgressData[] = [
                'student_name' => $student->first_name,
                'course_name' => $course->course_name,
                'total_marks' => $totalMarks,
            ];
        }
    }
    return view('instructor.student_progress', ['studentProgressData' => $studentProgressData]);
}
public function updatecourse(Request $request)
{

   $course = Course::find($request->input('id'));
   if ($course) {
       // Update user data
       $course->course_name = $request->input('course_name');
       $course->course_code = $request->input('course_code');
       $course->course_desc = $request->input('course_desc');
      
       $course->save();
       $instructorId = $request->session()->get('user')->id;
       $courses = Course::where('user_id', $instructorId)
                       ->orderBy('id', 'DESC')
                       ->get();
       return view('instructor.managecourses', ['courses' => $courses]);
   }
}

}
