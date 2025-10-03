<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class UploadSubjectController extends Controller
{
    public function index()
    {
        // Debug: Log that this controller method is being called
        \Log::info('UploadSubjectController@index called - returning empty collection');

        $subjects = collect([]); // Return empty collection to show empty table
        return view('admin.uploadSubject.subject', compact('subjects'));
    }
}
