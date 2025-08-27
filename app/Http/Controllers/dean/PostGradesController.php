<?php

namespace App\Http\Controllers\dean;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostGradesController extends Controller
{
    
    public function index()
    {
        return view('Dean.PostGrades.post');
    }
    
}
