<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadSubjectController extends Controller
{
    public function index()
    {
        return view('admin.uploadSubject.subject');
    }
}
