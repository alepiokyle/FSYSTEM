<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $studentCount = User::where('role', 'student')->count();
        $teacherCount = User::where('role', 'teacher')->count();
        $adminCount = User::where('role', 'admin')->count();
        
        return view('Admin.Dashboard', compact('studentCount', 'teacherCount', 'adminCount'));
    }

    /**
     * Display student management page
     *
     * @return \Illuminate\View\View
     */
    public function students()
    {
        $students = User::where('role', 'student')->paginate(10);
        return view('Admin.student', compact('students'));
    }

    /**
     * Display teacher management page
     *
     * @return \Illuminate\View\View
     */
    public function teachers()
    {
        $teachers = User::where('role', 'teacher')->paginate(10);
        return view('Admin.Teacher', compact('teachers'));
    }

    /**
     * Display parent management page
     *
     * @return \Illuminate\View\View
     */
    public function parents()
    {
        $parents = User::where('role', 'parent')->paginate(10);
        return view('Admin.parent', compact('parents'));
    }

    /**
     * Display dean management page
     *
     * @return \Illuminate\View\View
     */
    public function deans()
    {
        $deans = User::where('role', 'dean')->paginate(10);
        return view('Admin.dean', compact('deans'));
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('Admin.create');
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation and store logic here
        return redirect()->route('admin.dashboard')->with('success', 'Resource created successfully');
    }

    /**
     * Display the specified resource
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validation and update logic here
        return redirect()->route('admin.dashboard')->with('success', 'Resource updated successfully');
    }

    /**
     * Remove the specified resource from storage
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('admin.dashboard')->with('success', 'Resource deleted successfully');
    }

    /**
     * Display admin settings page
     *
     * @return \Illuminate\View\View
     */
    public function settings()
    {
        return view('Admin.setting');
    }

    /**
     * Update admin settings
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSettings(Request $request)
    {
        // Settings update logic here
        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully');
    }

    /**
     * Display system logs or reports
     *
     * @return \Illuminate\View\View
     */
    public function reports()
    {
        return view('Admin.reports');
    }
}
