<?php

namespace App\Http\Controllers\dean;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectLoadingController extends Controller
{
    public function index()
    {
        // Fetch all subjects from database, ordered by creation date (newest first)
        $subjects = Subject::orderBy('created_at', 'desc')->get();

        return view('Dean.SubjectLoading.loading', compact('subjects'));
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
