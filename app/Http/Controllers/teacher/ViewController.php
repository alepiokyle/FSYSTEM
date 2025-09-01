<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    
    public function index()
    {
        return view('teacher.ViewAssign.Viewsubject');
    }
}
