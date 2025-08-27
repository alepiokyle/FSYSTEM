<?php

namespace App\Http\Controllers\dean;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssignController extends Controller
{
    public function index()
    {
        return view('dean.AssignTeacher.assign');
    }
}
