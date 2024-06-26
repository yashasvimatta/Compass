<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AssignmentsController;
use App\Http\Controllers\StudentAssignmentController;
use App\Http\Controllers\QaController;
use App\Http\Controllers\PcController;
use App\Http\Controllers\TicketController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/forgotpassword',  function () {
    return view('forgotpassword');
});
Route::get('/greeting', function () {
    return view('greeting', ['name' => 'James']);
});
// Route::get('/index', function () {
//     return view('index');
// });
Route::get('/login', function () {
    return view('login');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
// Route::get('/signup', 'Auth\LoginController@showLoginForm')->name('signup');

Route::get('/contactUs', function () {
    return view('contactus');
})->name('contactUs');;
Route::get('/aboutUs', function () {
    return view('aboutus');
});
Route::get('/services', function () {
    return view('services');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::post('/register', [RegistrationController::class, 'register']);
Route::post('/forgotpassword', [LoginController::class, 'forgotPassword']);

Route::get('/verify-email/{token}', [RegistrationController::class, 'verify'])->name('verify.email');


Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
Route::get('/admin/manageusers', [AdminController::class, 'manageusers'])->name('admin.manage_users');
Route::get('/admin/deleteuser/{deleteid}', [AdminController::class, 'deleteuser'])->name('admin.deleteuser');
Route::get('/admin/approveuser/{userid}', [AdminController::class, 'approveuser'])->name('admin.approveuser');
Route::get('/admin/managestudents', [AdminController::class, 'managestudents'])->name('admin.managestudents');
Route::get('/admin/manageinstructors', [AdminController::class, 'manageinstructors'])->name('admin.manageinstructors');
Route::get('/admin/manageqa', [AdminController::class, 'manageqa'])->name('admin.manageqa');
Route::get('/admin/managepc', [AdminController::class, 'managepc'])->name('admin.managepc');
Route::post('/admin/update-user', [AdminController::class, 'updateUser'])->name('admin.updateUser');
Route::post('/admin/savecourse', [AdminController::class, 'saveCourse'])->name('admin.saveCourse');
Route::get('/admin/manage_courses_admin', [AdminController::class, 'createcourse'])->name('admin.createcourse');   
Route::get('/admin/courses_admin', [AdminController::class, 'managecourses'])->name('admin.managecources');
Route::put('/admin/updatecourse', [AdminController::class, 'updatecourse'])->name('admin.updatecourse');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/chat', function () {
    return view('admin.chat');
});
Route::get('/admin/issueresolutionadmin', [AdminController::class, 'issueresolutionadmin'])->name('admin.issueresolutionadmin');
Route::put('/admin/updateticket', [AdminController::class, 'updateticket'])->name('admin.updateticket');
Route::put('/admin/markresolved/{id}', [AdminController::class, 'markresolved'])->name('admin.markresolved');


Route::get('/chat/users', [ChatController::class, 'getChatUsers']);
Route::post('/chat/save', [ChatController::class, 'saveMessage']);
Route::get('/chat/get/{receiverId}', [ChatController::class, 'getMessages']);
Route::get('/instructor/dashboard', [InstructorController::class, 'showDashboard'])->name('instructor.dashboard');
Route::get('/instructor/addcourse', function () {
    return view('instructor.addcourse');
});
Route::get('/instructor/managecourses', [InstructorController::class, 'managecourses'])->name('instructor.managecourses');
Route::get('/instructor/chat', function () {
    return view('instructor.chat');
});
Route::get('/student/dashboard', [StudentController::class, 'showDashboard'])->name('student.dashboard');
Route::get('student/syllabusstudent', function () {
    return view('student.syllabusstudent');
});
Route::get('student/enroll', [StudentController::class, 'enrollStudents'])->name('student.enroll');
Route::get('student/getprofile', [StudentController::class, 'getprofile'])->name('student.getprofile');

Route::get('/student/feedback', [StudentController::class, 'feedbackcreate'])->name('feedbackcreate');
Route::post('/student/feedback', [StudentController::class, 'feedbackstore'])->name('feedbackstore');
Route::post('student/enroll/{course_id}', [StudentController::class, 'enroll'])->name('enroll');
Route::post('/instructor/savecourse', [InstructorController::class, 'saveCourse'])->name('instructor.saveCourse');

Route::get('/instructor/feedback', [InstructorController::class, 'feedbackcreate'])->name('instructorfeedbackcreate');
Route::post('/instructor/feedback', [InstructorController::class, 'feedbackstore'])->name('instructorfeedbackstore');

Route::get('/instructor/assignment', [InstructorController::class, 'createassignment'])->name('assignments.create');
Route::post('/instructor/assignment', [InstructorController::class, 'storeassignment'])->name('assignments.store');

Route::get('/get-students/{assignment}', [StudentAssignmentController::class, 'getStudents'])->name('get.students');

Route::get('/instructor/addmarks', [InstructorController::class, 'addmarks'])->name('instructoraddmarks');
Route::post('/instructor/addmarks', [InstructorController::class, 'savemarks'])->name('instructoraddmarksstore');

Route::get('/instructor/studentprogress', [InstructorController::class, 'studentProgress'])->name('studentprogress');
Route::get('/qa/dashboard', [QaController::class, 'showDashboard'])->name('qa.dashboard');
Route::get('/pc/dashboard', [PcController::class, 'showDashboard'])->name('pc.dashboard');
Route::get('/pc/communications', [PcController::class, 'communications'])->name('pc.communications');
Route::get('/pc/feedback', [PcController::class, 'getfeedback'])->name('pc.getfeedback');
Route::get('/qa/feedback', [QaController::class, 'getfeedback'])->name('qa.getfeedback');
Route::get('/qa/policy', [QaController::class, 'policyindex'])->name('qa.policyindex');
Route::post('/qa/store', [QaController::class, 'store'])->name('qa.store');
Route::get('/qa/policies/{id}', [QaController::class, 'destroy'])->name('qa.destroy');
Route::put('/qa/policies/{id}', [QaController::class, 'update'])->name('qa.update');
Route::get('/qa/chat',  function () {
    return view('admin.chat');
});
Route::get('/pc/chat',  function () {
    return view('admin.chat');
});
Route::get('/student/chat',  function () {
    return view('admin.chat');
});
Route::resource('tickets', TicketController::class);
Route::put('/instructor/updatecourse', [InstructorController::class, 'updatecourse'])->name('instructor.updatecourse');
Route::get('/student/getassignmentbycourse/{course_id}', [StudentController::class, 'getassignmentbycourse'])->name('student.getassignmentbycourse');
Route::post('/student/uploadassignment', [StudentController::class, 'upload'])->name('student.upload');
Route::get('/student/getCourseInformationForUser/{course_id}', [StudentController::class, 'getCourseInformationForUser'])->name('student.getCourseInformationForUser');

