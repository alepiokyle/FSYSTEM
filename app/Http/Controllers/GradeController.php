<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the grades view with actual data
     */
    public function viewGrades(Request $request)
    {
        $query = Grade::with(['student', 'subject', 'teacher'])
            ->where('status', 'approved');

        // Apply filters
        if ($request->filled('department')) {
            $query->whereHas('subject', function ($q) use ($request) {
                $q->where('department', $request->department);
            });
        }

        if ($request->filled('year_level')) {
            $query->whereHas('subject', function ($q) use ($request) {
                $q->where('year_level', $request->year_level);
            });
        }

        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }

        if ($request->filled('school_year')) {
            $query->where('school_year', $request->school_year);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('student', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('student_id', 'like', "%{$search}%");
                });
            });
        }

        $grades = $query->orderBy('created_at', 'desc')->get();

        return view('Admin.viewgrade', compact('grades'));
    }

    /**
     * Show form to add/edit grades
     */
    public function create()
    {
        $students = User::where('role', 'student')->get();
        $subjects = Subject::all();
        $teachers = User::where('role', 'teacher')->get();

        return view('Admin.grades.create', compact('students', 'subjects', 'teachers'));
    }

    /**
     * Store new grades
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:users,id',
            'prelim' => 'nullable|numeric|between:0,100',
            'midterm' => 'nullable|numeric|between:0,100',
            'semi_final' => 'nullable|numeric|between:0,100',
            'final' => 'nullable|numeric|between:0,100',
            'semester' => 'required|string',
            'school_year' => 'required|string',
        ]);

        // Calculate final grade
        $prelim = $validated['prelim'] ?? 0;
        $midterm = $validated['midterm'] ?? 0;
        $semiFinal = $validated['semi_final'] ?? 0;
        $final = $validated['final'] ?? 0;
        
        $finalGrade = ($prelim + $midterm + $semiFinal + $final) / 4;
        $validated['final_grade'] = round($finalGrade, 2);
        
        // Determine status based on final grade
        $validated['status'] = $finalGrade >= 75 ? 'passed' : 'failed';

        Grade::create($validated);

        return redirect()->route('grades.view')->with('success', 'Grade added successfully!');
    }

    /**
     * Update grade status (approve/reject)
     */
    public function updateStatus(Request $request, Grade $grade)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending'
        ]);

        $grade->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Grade status updated successfully!');
    }

    /**
     * Get grades for a specific student
     */
    public function getStudentGrades($studentId)
    {
        $grades = Grade::with(['subject', 'teacher'])
            ->where('student_id', $studentId)
            ->where('status', 'approved')
            ->orderBy('semester')
            ->orderBy('school_year')
            ->get();

        return response()->json($grades);
    }
}
