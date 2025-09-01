<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotesController extends Controller
{
     public function index()
    {
        return view('parent.Behavior.Notes');
    }
}
