<?php

namespace App\Http\Controllers\dean;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\User;

class SubjectLoadingController extends Controller
{
    public function index()
    {
        // Get the authenticated dean
        $dean = Auth::guard('dean')->user();

        // Get the dean's department name
        $departmentName = $dean->profile->department->name;

        // Fetch subjects filtered by the dean's department, ordered by creation date (newest first)
        $subjects = Subject::where('department', $departmentName)
                          ->orderBy('created_at', 'desc')
                          ->get();

        // Fetch all students
        $students = User::where('user_role_id', 7)->with('profile')->get();

        return view('Dean.SubjectLoading.loading', compact('subjects', 'students'));
    }

    /**
     * Delete a subject from the database
     */
    public function destroy($id)
    {
        try {
            $subject = Subject::findOrFail($id);

            // Store subject info for success message
            $subjectName = $subject->subject_name;
            $subjectCode = $subject->subject_code;

            // Delete the subject
            $subject->delete();

            return response()->json([
                'success' => true,
                'message' => "Subject '{$subjectCode} - {$subjectName}' has been successfully deleted."
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete subject. Please try again.'
            ], 500);
        }
    }
}
