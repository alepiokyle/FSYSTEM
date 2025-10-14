<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'attendance' => 'required|array',
            'attendance.*' => 'in:Present,Absent,Late,Excused',
        ]);

        $subjectId = $request->subject_id;
        $date = $request->date;
        $attendanceData = $request->attendance;
        $teacherId = Auth::guard('teacher')->id();

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
            foreach ($attendanceData as $studentId => $status) {
                Attendance::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'date' => $date,
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
            return response()->json([
                'success' => false,
                'message' => 'Failed to save attendance. Please try again.'
            ], 500);
        }
    }
}
