<?php

namespace App\Http\Controllers\dean;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TeacherAccount;
use App\Models\Subject;

class AssignController extends Controller
{
    public function index()
    {
        // Fetch active teachers with their profiles
        $teachers = TeacherAccount::with('profile')->where('is_active', true)->get();

        // Get the authenticated dean
        $dean = Auth::guard('dean')->user();

        // Get the dean's department name
        $departmentName = $dean->profile->department->name;

        // Fetch subjects filtered by the dean's department
        $subjects = Subject::with('teacher')->where('department', $departmentName)->get();

        // Get unique year levels and sections for the department
        $yearLevels = Subject::where('department', $departmentName)->distinct()->pluck('year_level')->filter()->sort();
        $sections = Subject::where('department', $departmentName)->distinct()->pluck('section')->filter()->sort();

        return view('dean.AssignTeacher.assign', compact('teachers', 'subjects', 'departmentName', 'yearLevels', 'sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers_account,id',
        ]);

        $subject = Subject::find($request->subject_id);
        $subject->teacher_id = $request->teacher_id;
        $subject->save();

        return response()->json([
            'success' => true,
            'message' => 'Teacher assigned successfully.'
        ]);
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
