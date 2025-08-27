<?php

namespace App\Http\Controllers\dean;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApproveGradesController extends Controller
{

    public function index()
    {
        return view('Dean.ApproveGrades.Approve');
    }
}
