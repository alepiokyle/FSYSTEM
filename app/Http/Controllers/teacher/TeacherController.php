<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
use App\Models\Grade;

class TeacherController extends Controller
{
    public function index()
    {
        $teacherId = Auth::guard('teacher')->id();
        $subjects = Subject::where('teacher_id', $teacherId)
            ->whereHas('students')
            ->get();

        return view('teacher.Manages.assessment', compact('subjects'));
    }

    public function getStudents($subjectId)
    {
        $teacherId = Auth::guard('teacher')->id();
        $subject = Subject::where('id', $subjectId)
            ->where('teacher_id', $teacherId)
            ->with('students')
            ->first();

        if (!$subject) {
            return response()->json(['error' => 'Subject not found'], 404);
        }

        // Ensure all students have a grade record
        foreach ($subject->students as $student) {
            Grade::firstOrCreate(
                [
                    'student_id' => $student->id,
                    'subject_id' => $subjectId,
                    'teacher_id' => $teacherId,
                ],
                [
                    'status' => 'draft',
                    'semester' => $subject->semester,
                    'school_year' => $subject->school_year,
                ]
            );
        }

        $students = $subject->students->map(function ($student) use ($subjectId, $teacherId) {
            // Fetch existing grades
            $grade = Grade::where('student_id', $student->id)
                ->where('subject_id', $subjectId)
                ->where('teacher_id', $teacherId)
                ->first();

            return [
                'id' => $student->id,
                'name' => $student->name,
                'prelim' => $grade ? $grade->prelim : null,
                'midterm' => $grade ? $grade->midterm : null,
                'semi_final' => $grade ? $grade->semi_final : null,
                'final' => $grade ? $grade->final : null,
                'term_grade' => $grade ? $grade->term_grade : null,
                'remarks' => $grade ? $grade->remarks : '-',
                'status' => $grade ? $grade->status : 'draft',
            ];
        });

        return response()->json($students);
    }

    public function saveGrades(Request $request, $subjectId)
    {
        try {
            $teacherId = Auth::guard('teacher')->id();
            $grades = $request->input('grades');

            $subject = Subject::find($subjectId);
            if (!$subject || $subject->teacher_id != $teacherId) {
                return response()->json(['success' => false, 'error' => 'Subject not found or not authorized'], 404);
            }

            foreach ($grades as $studentId => $gradeData) {
                $existingGrade = Grade::where('student_id', $studentId)
                    ->where('subject_id', $subjectId)
                    ->where('teacher_id', $teacherId)
                    ->first();

                // Prevent editing if status is not draft
                if ($existingGrade && $existingGrade->status !== 'draft') {
                    continue;
                }

                $grade = Grade::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'subject_id' => $subjectId,
                        'teacher_id' => $teacherId,
                    ],
                    [
                        'prelim' => isset($gradeData['prelim']) && $gradeData['prelim'] !== '' ? (float) $gradeData['prelim'] : null,
                        'midterm' => isset($gradeData['midterm']) && $gradeData['midterm'] !== '' ? (float) $gradeData['midterm'] : null,
                        'semi_final' => isset($gradeData['semi_final']) && $gradeData['semi_final'] !== '' ? (float) $gradeData['semi_final'] : null,
                        'final' => isset($gradeData['final']) && $gradeData['final'] !== '' ? (float) $gradeData['final'] : null,
                        'status' => 'draft',
                        'semester' => $subject->semester,
                        'school_year' => $subject->school_year,
                    ]
                );

                // Calculate term_grade and remarks
                $prelim = $grade->prelim ? (float) $grade->prelim : null;
                $midterm = $grade->midterm ? (float) $grade->midterm : null;
                $semiFinal = $grade->semi_final ? (float) $grade->semi_final : null;
                $final = $grade->final ? (float) $grade->final : null;

                if ($prelim !== null && $midterm !== null && $semiFinal !== null && $final !== null) {
                    $termGrade = ($prelim + $midterm + $semiFinal + $final) / 4;
                    $remarks = $termGrade >= 75 ? 'Passed' : 'Failed';
                } else {
                    $termGrade = null;
                    $remarks = 'Incomplete';
                }

                $grade->update([
                    'term_grade' => $termGrade,
                    'remarks' => $remarks,
                ]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function submitGrades(Request $request, $subjectId)
    {
        $teacherId = Auth::guard('teacher')->id();

        $subject = Subject::find($subjectId);
        if (!$subject || $subject->teacher_id != $teacherId) {
            return response()->json(['error' => 'Subject not found or not authorized'], 404);
        }

        // Get total enrolled students
        $totalStudents = $subject->students()->count();

        // Count draft grades
        $draftGradesCount = Grade::where('subject_id', $subjectId)
            ->where('teacher_id', $teacherId)
            ->where('status', 'draft')
            ->count();

        // Check if all students have draft grades
        if ($draftGradesCount < $totalStudents) {
            return response()->json(['error' => 'Please save grades for all students before submitting.'], 400);
        }

        // Submit all draft grades
        $draftGrades = Grade::where('subject_id', $subjectId)
            ->where('teacher_id', $teacherId)
            ->where('status', 'draft')
            ->get();

        foreach ($draftGrades as $grade) {
            $grade->status = 'submitted';
            $grade->save();
        }

        // TODO: Notify Dean (future feature)

        return response()->json(['success' => true, 'message' => 'Grades submitted successfully to the Dean']);
    }
}
