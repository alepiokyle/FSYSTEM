<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function create()
    {
        return view('userAuth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        // 1) Try USERS (web guard)
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::guard('web')->user();

            // optional: check is_active
            if (property_exists($user, 'is_active') && (int) $user->is_active !== 1) {
                Auth::guard('web')->logout();
                return back()->withErrors(['login_error' => 'User account is deactivated.'])->withInput();
            }

            // // Unexpected role on web guard
            // Auth::guard('web')->logout();
            // return back()->withErrors(['login_error' => 'Unauthorized role for web guard.'])->withInput();

            // optional: role check
            if ((int) $user->user_role_id !== 7) {
                Auth::guard('parent')->logout();
                return back()->withErrors(['login_error' => 'Unauthorized role for parent guard.'])->withInput();
            }

            return redirect()->route('student.studentdashboard')->with('success', 'Logged In Successfully');
        }

        // 2) If not user, TRY PARENT (parent guard)
        if (Auth::guard('parent')->attempt($credentials)) {
            $request->session()->regenerate();
            $parent = Auth::guard('parent')->user();

            // optional: check is_active
            if (property_exists($parent, 'is_active') && (int) $parent->is_active !== 1) {
                Auth::guard('parent')->logout();
                return back()->withErrors(['login_error' => 'Parent account is deactivated.'])->withInput();
            }

            // optional: role check
            if ((int) $parent->user_role_id !== 8) {
                Auth::guard('parent')->logout();
                return back()->withErrors(['login_error' => 'Unauthorized role for parent guard.'])->withInput();
            }

            return redirect()->route('parent.parentdashboard')->with('success', 'Logged In Successfully');
        }

        // 3) If not user, TRY admin (admin guard)
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            $admin = Auth::guard('admin')->user();

            // optional: check is_active
            if (property_exists($admin, 'is_active') && (int)  $admin->is_active !== 1) {
                Auth::guard('admin')->logout();
                return back()->withErrors(['login_error' => 'Admin account is deactivated.'])->withInput();
            }

            // optional: role check
            if ((int)  $admin->user_role_id !== 4) {
                Auth::guard('admin')->logout();
                return back()->withErrors(['login_error' => 'Unauthorized role for admin guard.'])->withInput();
            }

            return redirect()->route('admin.dashboard')->with('success', 'Logged In Successfully');
        }

        // 4) If not user, TRY dean (dean guard)
        if (Auth::guard('dean')->attempt($credentials)) {
            $request->session()->regenerate();
            $dean = Auth::guard('dean')->user();

            // optional: check is_active
            if (property_exists($dean, 'is_active') && (int)  $dean->is_active !== 1) {
                Auth::guard('dean')->logout();
                return back()->withErrors(['login_error' => 'dean account is deactivated.'])->withInput();
            }

            // optional: role check
            if ((int)  $dean->user_role_id !== 5) {
                Auth::guard('dean')->logout();
                return back()->withErrors(['login_error' => 'Unauthorized role for dean guard.'])->withInput();
            }

            return redirect()->route('Dean.deandashboard')->with('success', 'Logged In Successfully');
        }

        // 4) If not user, TRY teacher (dean teacher)
        if (Auth::guard('teacher')->attempt($credentials)) {
            $request->session()->regenerate();
            $teacher = Auth::guard('teacher')->user();

            // optional: check is_active
            if (property_exists($teacher, 'is_active') && (int)  $teacher->is_active !== 1) {
                Auth::guard('teacher')->logout();
                return back()->withErrors(['login_error' => 'teacher account is deactivated.'])->withInput();
            }

            // optional: role check
            if ((int)  $teacher->user_role_id !== 6) {
                Auth::guard('teacher')->logout();
                return back()->withErrors(['login_error' => 'Unauthorized role for teacher guard.'])->withInput();
            }

            return redirect()->route('teacher.teacherdashboard')->with('success', 'Logged In Successfully');
        }

        // Both failed
        return back()->withErrors(['login_error' => 'Invalid username or password'])->withInput();
    }

    public function logout(Request $request)
    {
        // log out whichever guard is authenticated
        if (Auth::guard('parent')->check()) {
            Auth::guard('parent')->logout();
        }
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
