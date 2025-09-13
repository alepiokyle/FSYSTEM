<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class addFacultyController extends Controller
{
    public function index()
    {
        return view('admin.faculty.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department' => 'required|string|max:255',
            'subject_code' => 'required|string|max:255',
            'subject_name' => 'required|string|max:255',
            'units' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'school_year' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        // Assuming you have a Subject model to save the data
        \App\Models\Subject::create([
            'department' => $validated['department'],
            'subject_code' => $validated['subject_code'],
            'subject_name' => $validated['subject_name'],
            'units' => $validated['units'],
            'description' => $request->input('description'),
            'school_year' => $validated['school_year'],
            'semester' => $validated['semester'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.upload-subject')->with('success', 'Subject saved successfully.');
    }
}
