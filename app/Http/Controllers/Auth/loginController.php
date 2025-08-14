<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function create()
    {
        return view('userAuth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->user_role_id == 4) {
                return redirect()->route('admin.dashboard')->with('success', 'Logged In Successfully');
            }

            if ($user->user_role_id == 5) {
                return redirect()->route('dean.dashboard')->with('success', 'Logged In Successfully');
            }

            if ($user->user_role_id == 6) {
                return redirect()->route('teacher.dashboard')->with('success', 'Logged In Successfully');
            }

            if ($user->user_role_id == 7) {
                return redirect()->route('student.dashboard')->with('success', 'Logged In Successfully');
            }

            if ($user->user_role_id == 8) {
                return redirect()->route('parent.dashboard')->with('success', 'Logged In Successfully');
            }
        }

        return back()->withErrors(['login_error' => 'Invalid username or password'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
