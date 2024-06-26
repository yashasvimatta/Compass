<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Adjust the model namespace accordingly
use App\Models\Course; // Adjust the model namespace accordingly
use App\Models\Ticket;

class AdminController extends Controller
{
    public function showDashboard()
    {
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalStudents = User::where('role', 'student')->count();
        $totalInstructors = User::where('role', 'instructor')->count();
        $totalQAO = User::where('role', 'Quality_Assurance')->count();
        $totalProgramCoordinators = User::where('role', 'Program_Coordinator')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCourses',
            'totalStudents',
            'totalInstructors',
            'totalQAO',
            'totalProgramCoordinators'
        ));
    }
    public function createCourse()
    {
        $users = User::orderBy('id', 'DESC')->get();

        return view('admin.manage_courses', ['users' => $users]);
    }
  
    public function manageUsers()
    {
        $users = User::orderBy('id', 'DESC')->get();

        return view('admin.manage_users', ['users' => $users]);
    }
    public function deleteuser($deleteid)
    {
        $user = User::find($deleteid);

        if ($user) {
            $user->delete();

            // Use session to store a message
            session()->flash('success', 'User deleted successfully');
        } else {
            // User not found
            session()->flash('error', 'User not found');
        }

        return redirect()->back();
    }
    public function approveuser($userId)
    {
        $user = User::find($userId);

        if ($user) {
            // Update the user status to 1 (approved)
            $user->update(['status' => 1]);

            // Use session to store a message
            session()->flash('success', 'User approved successfully');
        } else {
            // User not found
            session()->flash('error', 'User not found');
        }

        return redirect()->back();
    }
    
    public function managestudents()
    {
        $students = User::where('role', 'student')->orderBy('id', 'DESC')->get();

        return view('admin.manage_student', ['users' => $students]);
    }
    
    public function manageinstructors()
    {
        $users = User::where('role', 'instructor')->orderBy('id', 'DESC')->get();;

        return view('admin.manage_instructor', ['users' => $users]);
    }
    
    public function manageqa()
    {
        $users = User::where('role', 'Quality_Assurance')->orderBy('id', 'DESC')->get();

        return view('admin.manage_qa', ['users' => $users]);
    }
    public function managepc()
    {
        $users = User::where('role', 'Program_Coordinator')->orderBy('id', 'DESC')->get();

        return view('admin.manage_pc', ['users' => $users]);
    }
    public function updateUser(Request $request)
    {
        $userId = $request->input('userId');
         $user = User::find($userId);

        if ($user) {
            // Update user data
            $user->first_name = $request->input('firstName');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');
           
            $user->save();

            return response()->json(['success' => true, 'message' => 'User updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }
    }
    public function saveCourse(Request $request)
{
  // Validation rules
  $request->validate([
    'course_name' => 'required',
    'course_code' => 'required',
    'course_desc' => 'required',
    'user_id' => 'required',
]);
$request->session()->start();
$userData = $request->session()->get('user');
    // Create a new course instance
    $course = new Course();

    // Set the course attributes
    $course->course_name = $request->input('course_name');
    $course->user_id = $request->user_id;
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

    return view('admin.course_list', ['courses' => $courses]);
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
       $courses = Course::orderBy('id', 'DESC')->get();
       return view('admin.course_list', ['courses' => $courses]);
   }
}

public function issueresolutionadmin(){
    $courses = Ticket::orderBy('id', 'DESC')->get();

    // Add a 'status' attribute to each ticket based on the 'resolved' value
    $issues = $courses->map(function ($issue) {
        $issue->status = $issue->resolved ? 'Resolved' : 'Unresolved';
        return $issue;
    });
    
    return view('admin.issueresoulution', ['issues' => $issues]);
}
public function updateticket(Request $request)
{

   $course = Ticket::find($request->input('id'));
   if ($course) {
       // Update user data
       $course->response = $request->input('response');
       $course->save();
       $courses = Ticket::orderBy('id', 'DESC')->get();
       return view('admin.issueresoulution', ['issues' => $courses]);
   }
}
public function markresolved(Request $request,$id)
{

   $course = Ticket::find($id);
   if ($course) {
       // Update user data
       $course->resolved = "true";
       $course->save();
       $courses = Ticket::orderBy('id', 'DESC')->get();
       return view('admin.issueresoulution', ['issues' => $courses]);
   }
}


}
