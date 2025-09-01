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

            if ($user->user_role_id == 4) {
                return redirect()->route('admin.dashboard')->with('success', 'Logged In Successfully');
            }
            if ($user->user_role_id == 5) {
                return redirect()->route('Dean.deandashboard')->with('success', 'Logged In Successfully');
            }
            if ($user->user_role_id == 6) {
                return redirect()->route('teacher.teacherdashboard')->with('success', 'Logged In Successfully');
            }
            if ($user->user_role_id == 7) {
                return redirect()->route('student.studentdashboard')->with('success', 'Logged In Successfully');
            }

            // Unexpected role on web guard
            Auth::guard('web')->logout();
            return back()->withErrors(['login_error' => 'Unauthorized role for web guard.'])->withInput();
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

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
