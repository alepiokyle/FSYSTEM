<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Subject;
use App\Models\Attendance;
use App\Models\Grade;

class AttendanceController extends Controller
{

    public function index()
    {
        $teacherId = Auth::guard('teacher')->id();
        $assignedSubjects = Subject::where('teacher_id', $teacherId)->get();

        return view('teacher.Manage.attendance', compact('assignedSubjects'));
    }

    public function getStudents(Request $request, $subjectId)
    {
        try {
            $subject = Subject::findOrFail($subjectId);

            // Check if the subject is assigned to the current teacher
            if ($subject->teacher_id != Auth::guard('teacher')->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not authorized to view students for this subject.'
                ], 403);
            }

            $students = $subject->students()->with(['profile.department'])->get()->map(function ($student) use ($request, $subject) {
                $profile = $student->profile;
                if (!$profile) {
                    return null; // Skip students without profile
                }
                $fullName = trim($profile->first_name . ' ' . ($profile->middle_name ? $profile->middle_name . ' ' : '') . $profile->last_name . ($profile->suffix ? ' ' . $profile->suffix : ''));
                $attendance = Attendance::where('student_id', $student->id)
                    ->where('subject_id', $subject->id)
                    ->where('date', $request->query('date'))
                    ->where('time', $request->query('time'))
                    ->first();

                return [
                    'id' => $student->id,
                    'student_id' => $profile->student_id,
                    'name' => $fullName,
                    'department' => $profile->department ? $profile->department->name : 'N/A',
                    'year_level' => $profile->year_level,
                    'status' => $attendance ? $attendance->status : null,
                ];
            })->filter()->values(); // Remove null entries

            return response()->json([
                'success' => true,
                'students' => $students,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load students. Please try again.'
            ], 500);
        }
    }

    public function getSubjectDetails($subjectId)
    {
        try {
            $subject = Subject::findOrFail($subjectId);

            // Check if the subject is assigned to the current teacher
            if ($subject->teacher_id != Auth::guard('teacher')->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not authorized to view this subject.'
                ], 403);
            }

            $teacherProfile = $subject->teacher->profile;
            $teacherName = trim($teacherProfile->first_name . ' ' . ($teacherProfile->middle_name ? $teacherProfile->middle_name . ' ' : '') . $teacherProfile->last_name . ($teacherProfile->suffix ? ' ' . $teacherProfile->suffix : ''));

            return response()->json([
                'success' => true,
                'subject' => [
                    'subject_code' => $subject->subject_code,
                    'subject_name' => $subject->subject_name,
                    'section' => $subject->section,
                    'teacher_name' => $teacherName,
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load subject details. Please try again.'
            ], 500);
        }
    }

    public function getGradingStudents($subjectId)
    {
        try {
            $subject = Subject::findOrFail($subjectId);

            // Check if the subject is assigned to the current teacher
            if ($subject->teacher_id != Auth::guard('teacher')->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not authorized to view students for this subject.'
                ], 403);
            }

            $students = $subject->students()->with(['profile.department'])->get()->map(function ($student) use ($subject) {
                $profile = $student->profile;
                if (!$profile) {
                    return null; // Skip students without profile
                }
                $fullName = trim($profile->first_name . ' ' . ($profile->middle_name ? $profile->middle_name . ' ' : '') . $profile->last_name . ($profile->suffix ? ' ' . $profile->suffix : ''));

                // Fetch existing grade record
                $grade = Grade::where('student_id', $student->id)
                    ->where('subject_id', $subject->id)
                    ->where('teacher_id', Auth::guard('teacher')->id())
                    ->first();

                // Calculate attendance score (percentage of present days)
                $totalAttendanceDays = Attendance::where('student_id', $student->id)
                    ->where('subject_id', $subject->id)
                    ->count();

                $presentDays = Attendance::where('student_id', $student->id)
                    ->where('subject_id', $subject->id)
                    ->where('status', 'Present')
                    ->count();

                $attendanceScore = $totalAttendanceDays > 0 ? ($presentDays / $totalAttendanceDays) * 100 : null;

                return [
                    'id' => $student->id,
                    'name' => $fullName,
                    'student_id' => $profile->student_id,
                    'department' => $profile->department ? $profile->department->name : 'N/A',
                    'year_level' => $profile->year_level,
                    'quiz' => $grade ? $grade->quiz : null,
                    'total_quiz' => $grade ? $grade->total_quiz : null,
                    'assignment' => $grade ? $grade->assignment : null,
                    'total_assignment' => $grade ? $grade->total_assignment : null,
                    'attendance_score' => $attendanceScore,
                    'total_attendance_score' => $totalAttendanceDays > 0 ? 100 : null,
                    'exam' => $grade ? $grade->exam : null,
                    'total_exam' => $grade ? $grade->total_exam : null,
                    'performance' => $grade ? $grade->performance : null,
                    'total_performance' => $grade ? $grade->total_performance : null,
                    'final_grade' => $grade ? $grade->term_grade : null,
                ];
            })->filter()->values(); // Remove null entries

            return response()->json([
                'success' => true,
                'students' => $students,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load students. Please try again.'
            ], 500);
        }
    }

    public function saveGradingComponent(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'component' => 'required|in:quiz,assignment,attendance_score,exam,performance',
            'student_id' => 'required|exists:users,id',
            'score' => 'nullable|numeric|min:0|max:100',
            'total' => 'nullable|numeric|min:1',
        ]);

        $subjectId = $request->subject_id;
        $component = $request->component;
        $studentId = $request->student_id;
        $score = $request->score;
        $total = $request->total;
        $teacherId = Auth::guard('teacher')->id();

        // Check if subject is assigned to teacher
        $subject = Subject::findOrFail($subjectId);
        if ($subject->teacher_id != $teacherId) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to save grades for this subject.'
            ], 403);
        }

        try {
            // Ensure grade record exists
            $grade = Grade::firstOrCreate(
                [
                    'student_id' => $studentId,
                    'subject_id' => $subjectId,
                    'teacher_id' => $teacherId,
                ],
                [
                    'status' => 'draft',
                    'semester' => $subject->semester,
                    'school_year' => $subject->school_year,
                ]
            );

            // Update the specific component
            $grade->update([
                $component => $score,
                "total_{$component}" => $total,
            ]);

            // Recalculate final grade if all components are present
            $components = ['quiz', 'assignment', 'attendance_score', 'exam', 'performance'];
            $allPresent = true;
            $finalGrade = 0;

            foreach ($components as $comp) {
                if ($grade->$comp === null || $grade->{"total_{$comp}"} === null) {
                    $allPresent = false;
                    break;
                }
                $percentage = ($grade->$comp / $grade->{"total_{$comp}"}) * 100;
                $weight = in_array($comp, ['quiz', 'assignment', 'attendance_score']) ? 0.10 : ($comp === 'exam' ? 0.30 : 0.40);
                $finalGrade += $percentage * $weight;
            }

            if ($allPresent) {
                $grade->update([
                    'term_grade' => round($finalGrade, 2),
                    'remarks' => $finalGrade >= 75 ? 'Passed' : 'Failed',
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Score saved successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to save grading component: ' . $e->getMessage(), [
                'subject_id' => $subjectId,
                'component' => $component,
                'student_id' => $studentId,
                'teacher_id' => $teacherId,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to save score. Please try again.'
            ], 500);
        }
    }

    public function saveAttendance(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'time' => 'required',
            'attendance' => 'required|array',
            'attendance.*' => 'in:Present,Absent,Late,Excused',
        ]);

        $subjectId = (int) $request->subject_id;
        $date = $request->date;
        $time = $request->time;
        $attendanceData = $request->attendance;
        $teacherId = (int) Auth::guard('teacher')->id();

        // Check if subject is assigned to teacher
        $subject = Subject::findOrFail($subjectId);
        if ($subject->teacher_id != $teacherId) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to save attendance for this subject.'
            ], 403);
        }

        // Check if date is weekend
        $dayOfWeek = date('N', strtotime($date)); // 1=Monday, 7=Sunday
        if ($dayOfWeek >= 6) {
            return response()->json([
                'success' => false,
                'message' => 'Attendance cannot be recorded on weekends.'
            ], 400);
        }

        try {
            // Get enrolled students for the subject
            $enrolledStudentIds = $subject->students()->pluck('id')->toArray();

            // Check if all students in attendance data are enrolled
            $invalidStudents = [];
            foreach ($attendanceData as $studentId => $status) {
                $studentId = (int) $studentId;
                if (!in_array($studentId, $enrolledStudentIds)) {
                    $invalidStudents[] = $studentId;
                }
            }

            if (!empty($invalidStudents)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Some students are not enrolled in this subject.'
                ], 400);
            }

            foreach ($attendanceData as $studentId => $status) {
                $studentId = (int) $studentId;
                Attendance::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'date' => $date,
                        'time' => $time,
                        'subject_id' => $subjectId,
                    ],
                    [
                        'status' => $status,
                        'teacher_id' => $teacherId,
                    ]
                );
            }

            return response()->json([
                'success' => true,
                'message' => 'Attendance saved successfully.'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to save attendance: ' . $e->getMessage(), [
                'subject_id' => $subjectId,
                'date' => $date,
                'teacher_id' => $teacherId,
                'attendance_data' => $attendanceData,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to save attendance. Please try again.'
            ], 500);
        }
    }

    public function getPastRecords(Request $request)
    {
        try {
            $teacherId = Auth::guard('teacher')->id();

            $records = Attendance::with(['student.profile', 'subject'])
                ->where('teacher_id', $teacherId)
                ->orderBy('date', 'desc')
                ->orderBy('time', 'desc')
                ->get()
                ->map(function ($attendance) {
                    $profile = $attendance->student->profile;
                    if (!$profile) {
                        return null; // Skip if no profile
                    }
                    $fullName = trim($profile->first_name . ' ' . ($profile->middle_name ? $profile->middle_name . ' ' : '') . $profile->last_name . ($profile->suffix ? ' ' . $profile->suffix : ''));
                    return [
                        'date' => $attendance->date,
                        'time' => $attendance->time,
                        'student_id' => $profile->student_id,
                        'student_name' => $fullName,
                        'status' => $attendance->status,
                        'subject' => $attendance->subject ? $attendance->subject->subject_name : 'N/A',
                    ];
                })
                ->filter() // Remove null entries
                ->values(); // Reindex array

            return response()->json([
                'success' => true,
                'records' => $records,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load past records. Please try again. Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
