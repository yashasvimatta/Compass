<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssignmentsController extends Controller
{
    public function create()
{
    $instructorId = $request->session()->get('user')->id;
    $courses = Course::where('user_id', $instructorId)
                    ->orderBy('id', 'DESC')
                    ->get();
                    return view('instructor.createassignment', ['courses' => $courses]);
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'due_date' => 'required|date',
        'file' => 'file|mimes:pdf,doc,docx|max:10240', // Adjust file validation as needed
    ]);

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

    // Save the assignment
    $assignment->save();

    return redirect()->route('assignments.index')->with('success', 'Assignment created successfully.');
}

}

