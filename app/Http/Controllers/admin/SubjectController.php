<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Show the form
    public function create()
    {
        $subjects = Subject::latest()->get();
        return view('admin.upload', compact('subjects'));
    }

    // Handle saving to DB
    public function store(Request $request)
    {
        $request->validate([
            'department' => 'required|string',
            'subject_name' => 'required|string',
            'subject_code' => 'required|string|unique:subjects',
            'units' => 'required|integer',
            'year_level' => 'required|string',
            'semester' => 'required|string',
            'school_year' => 'required|string',
        ]);

        $subject = Subject::create([
            'department' => $request->department,
            'subject_name' => $request->subject_name,
            'subject_code' => $request->subject_code,
            'units' => $request->units,
            'year_level' => $request->year_level,
            'semester' => $request->semester,
            'school_year' => $request->school_year,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'subject' => $subject,
                'message' => 'Subject uploaded successfully!'
            ]);
        }

        return redirect()->route('subjects.create')->with('success', 'Subject uploaded successfully!');
    }
}
