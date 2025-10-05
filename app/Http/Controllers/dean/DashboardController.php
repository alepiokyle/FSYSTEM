<?php

namespace App\Http\Controllers\Dean;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the authenticated dean
        $dean = Auth::guard('dean')->user();

        // Get the dean's department name
        $departmentName = $dean->profile->department->name;

        // Count total subjects uploaded in the department
        $totalSubjects = Subject::where('department', $departmentName)->count();

        // Count teachers assigned (subjects with teacher_id not null)
        $teachersAssigned = Subject::where('department', $departmentName)->whereNotNull('teacher_id')->count();

        return view('Dean.deandashboard', compact('totalSubjects', 'teachersAssigned'));
    }
}
