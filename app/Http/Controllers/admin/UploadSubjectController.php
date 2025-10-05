<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class UploadSubjectController extends Controller
{
    public function index()
    {
        // Fetch all subjects ordered by creation date (newest first)
        $subjects = Subject::orderBy('created_at', 'desc')->get();

        // Get departments for the form
        $departments = \App\Models\Department::all();

        return view('admin.uploadSubject.subject', compact('subjects', 'departments'));
    }
}
