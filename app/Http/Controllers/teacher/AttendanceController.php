<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Subject;
use App\Models\Attendance;

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
                $fullName = trim($profile->first_name . ' ' . ($profile->middle_name ? $profile->middle_name . ' ' : '') . $profile->last_name . ($profile->suffix ? ' ' . $profile->suffix : ''));
                $attendance = Attendance::where('student_id', $student->id)
                    ->where('subject_id', $subject->id)
                    ->where('date', $request->query('date'))
                    ->where('time', $request->query('time'))
                    ->first();

                return [
                    'id' => $student->id,
                    'student_id' => $profile->student_id,
                    'full_name' => $fullName,
                    'department' => $profile->department ? $profile->department->name : 'N/A',
                    'year_level' => $profile->year_level,
                    'status' => $attendance ? $attendance->status : null,
                ];
            });

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
