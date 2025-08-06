<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 🔐 Hardcoded Admin Credentials

        if ($request->email === 'admin@ko.com' && $request->password === 'admin123') {
            // Create a dummy admin user instance
            $adminUser = \App\Models\User::firstOrCreate(
                ['email' => 'admin@ko.com'],
                ['name' => 'Admin User', 'password' => bcrypt('admin123'), 'role' => 'admin', 'email_verified_at' => now()]
            );

            \Illuminate\Support\Facades\Auth::login($adminUser);

            return redirect()->route('dashboard');
        }

        // 🌐 Authenticate other user roles
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            switch ($user->role) {
                case 'dean':
                    return redirect()->route('dean.dashboard');
                case 'teacher':
                    return redirect()->route('teacher.dashboard');
                case 'student':
                    return redirect()->route('student.dashboard');
                case 'parent':
                    return redirect()->route('parent.dashboard');
                default:
                    return back()->with('error', 'Unknown role.');
            }
        }

        return back()->with('error', 'Invalid credentials.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
