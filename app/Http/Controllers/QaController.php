<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Adjust the model namespace accordingly
use App\Models\Policy;
use App\Models\Course;
use App\Models\Feedback;
use App\Models\Assignment;
use App\Models\Ticket;
use App\Models\CourseEnrollment; // Adjust the model namespace accordingly

class QaController extends Controller
{
  

    public function showDashboard()
    {
        $ongoingAssessments = $this->getOngoingAssessmentsCount();
        $openQualityIssues = $this->getOpenQualityIssuesCount();
        $newFeedback = $this->getNewFeedbackCount();
        $totalPolicies = $this->getTotalPoliciesCount();

        return view('qa.dashboard', compact('ongoingAssessments', 'openQualityIssues', 'newFeedback', 'totalPolicies'));
    }

    private function getOngoingAssessmentsCount()
{
    // Your logic to get the count of ongoing assessments (open assignments with due date in the future)
    return Assignment::whereDate('due_date', '>', now())
        ->count();
}

    private function getOpenQualityIssuesCount()
    {
        // Your logic to get the count of open quality issues (unresolved tickets)
        return Ticket::where('resolved', 'false')->count();
    }

    private function getNewFeedbackCount()
    {
        // Your logic to get the count of new feedback
        return Feedback::count();
    }

    private function getTotalPoliciesCount()
    {
        // Your logic to get the count of total policies
        return Policy::count();
    }

    public function getfeedback()
    {
        $feedbackData = Feedback::join('users as u1', 'feedbacks.user_id', '=', 'u1.id')
        ->join('users as u2', 'feedbacks.feedback_for', '=', 'u2.id')
        ->where('u2.role', '=', 'Instructor')
        ->select('u1.first_name as user_name', 'feedbacks.subject', 'feedbacks.feedback', 'u2.first_name as feedback_for_name')
        ->get();
        return view('qa.feedback', ['feedbacks' => $feedbackData]);
    }
    // Index page - list all policies
    public function policyindex()
    {
        $policies = Policy::all();
        return view('qa.policy', compact('policies'));
    }

    // Show a specific policy
    public function show($id)
    {
        $policy = Policy::findOrFail($id);
        return view('qa.show', compact('policy'));
    }

    // Display the form to create a new policy
    public function create()
    {
        return view('qa.create');
    }

    // Store a newly created policy in the database
    public function store(Request $request)
    {
        $policyData = [
            'title' => $request->title,
            'description' => $request->description,
        ];
    
        // Check if a file was uploaded
        if ($request->hasFile('document')) {
            // Add logic to handle file upload
            $policyData['document'] = $request->file('document')->store('policy_documents');
        }
    
        $policy = Policy::create($policyData);
    
        return redirect()->route('qa.policyindex')->with('success', 'Policy created successfully');
    }

    // Display the form to edit a policy
    public function edit($id)
    {
        $policy = Policy::findOrFail($id);
        return view('qa.edit', compact('policy'));
    }

    // Update the specified policy in the database
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'title' => 'required',
        //     'description' => 'required',
        //     'document' => 'nullable|mimes:pdf,doc,docx|max:2048',
        // ]);

        $policy = Policy::findOrFail($id);

        $policy->update([
            'title' => $request->title,
            'description' => $request->description,
            'document' => $request->has('document') ? $request->file('document')->store('policy_documents') : $policy->document,
        ]);

        return redirect()->route('qa.policyindex')->with('success', 'Policy updated successfully');
    }

    // Delete a policy
    public function destroy($id)
    {
        $policy = Policy::findOrFail($id);
        $policy->delete();

        return redirect()->route('qa.policyindex')->with('success', 'Policy deleted successfully');
    }
  
}
