<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        return view('teacher.teacherdashboard');
    }
}
