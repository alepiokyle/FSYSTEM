<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GradesController extends Controller
{
       public function index()
    {
        return view('parent.Final.Grades');
    }
}
