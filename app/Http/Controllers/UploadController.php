<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    /**
     * Display the upload form
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('Admin.upload', compact('subjects'));
    }

    /**
     * Store a newly created subject
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department' => 'required|string|max:10',
            'subject_name' => 'required|string|max:255',
            'subject_code' => 'required|string|max:50|unique:subjects,subject_code',
            'units' => 'required|integer|min:1|max:10',
            'year_level' => 'required|string|max:10',
            'semester' => 'required|string|max:10',
            'school_year' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $subject = Subject::create([
                'subject_code' => $request->subject_code,
                'subject_name' => $request->subject_name,
                'department' => $request->department,
                'year_level' => $request->year_level,
                'semester' => $request->semester,
                'units' => $request->units,
                'school_year' => $request->school_year,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Subject uploaded successfully!',
                'subject' => $subject
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error uploading subject: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified subject
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'department' => 'required|string|max:10',
            'subject_name' => 'required|string|max:255',
            'subject_code' => 'required|string|max:50|unique:subjects,subject_code,' . $id,
            'units' => 'required|integer|min:1|max:10',
            'year_level' => 'required|string|max:10',
            'semester' => 'required|string|max:10',
            'school_year' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $subject = Subject::findOrFail($id);
            $subject->update([
                'subject_code' => $request->subject_code,
                'subject_name' => $request->subject_name,
                'department' => $request->department,
                'year_level' => $request->year_level,
                'semester' => $request->semester,
                'units' => $request->units,
                'school_year' => $request->school_year,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Subject updated successfully!',
                'subject' => $subject
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating subject: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return view('Admin.subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified subject.
     */
    public function edit(Subject $subject)
    {
        return view('Admin.subjects.edit', compact('subject'));
    }

    /**
     * Remove the specified subject
     */
    public function destroy($id)
    {
        try {
            $subject = Subject::findOrFail($id);
            $subject->delete();

            return response()->json([
                'success' => true,
                'message' => 'Subject deleted successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting subject: ' . $e->getMessage()
            ], 500);
        }
    }
}
