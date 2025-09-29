<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Debug: Log that this controller method is being called
        \Log::info('UploadController@index called - returning latest 10 subjects');

        $subjects = Subject::latest()->take(10)->get(); // Get latest 10 subjects
        return view('admin.uploadSubject.subject', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Handle subject upload logic
        $validated = $request->validate([
            'department' => 'required|string|max:255',
            'subject_code' => 'required|string|max:10',
            'subject_name' => 'required|string|max:255',
            'units' => 'required|integer|min:1|max:6',
            'semester' => 'required|string|max:255',
            'school_year' => 'required|string|max:20',
            'description' => 'nullable|string',
            'status' => 'required|string|max:255',
        ]);

        $subject = Subject::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Subject uploaded successfully',
            'subject' => $subject
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return view('admin.uploadSubject.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        return view('admin.uploadSubject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'subject_code' => 'required|string|max:10',
            'subject_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $subject->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Subject updated successfully',
            'subject' => $subject
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Subject deleted successfully'
        ]);
    }
}
