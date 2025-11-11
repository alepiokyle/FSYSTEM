<?php

namespace App\Http\Controllers\Dean;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TeacherAccount;
use App\Models\DeanAccount;

class SwitchRoleController extends Controller
{
    public function switchToTeacher(Request $request)
    {
        $dean = Auth::guard('dean')->user();

        if (!$dean) {
            return redirect()->route('login')->withErrors(['error' => 'Not authenticated as Dean.']);
        }

        // Find teacher account with same username
        $teacher = TeacherAccount::where('username', $dean->username)->first();

        if (!$teacher) {
            return back()->withErrors(['error' => 'No associated Teacher account found.']);
        }

        // Check if teacher is active
        if (!$teacher->is_active) {
            return back()->withErrors(['error' => 'Associated Teacher account is suspended.']);
        }

        // Logout dean
        Auth::guard('dean')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Manually login as teacher (assuming same password or no password check for switching)
        Auth::guard('teacher')->login($teacher);
        $request->session()->regenerate();
        return redirect()->route('teacher.teacherdashboard')->with('success', 'Switched to Teacher role.');
    }

    public function switchToDean(Request $request)
    {
        $teacher = Auth::guard('teacher')->user();

        if (!$teacher) {
            return redirect()->route('login')->withErrors(['error' => 'Not authenticated as Teacher.']);
        }

        // Find dean account with same username
        $dean = DeanAccount::where('username', $teacher->username)->first();

        if (!$dean) {
            return back()->withErrors(['error' => 'No associated Dean account found.']);
        }

        // Check if dean is active
        if (!$dean->is_active) {
            return back()->withErrors(['error' => 'Associated Dean account is suspended.']);
        }

        // Logout teacher
        Auth::guard('teacher')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Manually login as dean
        Auth::guard('dean')->login($dean);
        $request->session()->regenerate();
        return redirect()->route('Dean.deandashboard')->with('success', 'Switched to Dean role.');
    }
}
