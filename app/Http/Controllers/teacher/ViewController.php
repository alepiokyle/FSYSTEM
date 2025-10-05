<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;

class ViewController extends Controller
{

    public function index()
    {
        $teacherId = Auth::guard('teacher')->id();
        $assignedSubjects = Subject::where('teacher_id', $teacherId)->get();

        return view('teacher.ViewAssign.Viewsubject', compact('assignedSubjects'));
    }

    public function unassign($id)
    {
        try {
            $subject = Subject::findOrFail($id);

            // Check if the subject is assigned to the current teacher
            if ($subject->teacher_id != Auth::guard('teacher')->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not authorized to unassign this subject.'
                ], 403);
            }

            $subject->teacher_id = null;
            $subject->save();

            return response()->json([
                'success' => true,
                'message' => 'Subject unassigned successfully.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to unassign subject. Please try again.'
            ], 500);
        }
    }
}
