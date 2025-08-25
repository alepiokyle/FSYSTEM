<?php

namespace App\Http\Controllers\dean;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class deanController extends Controller
{
    Public function index(){
        return view('Dean.deandashboard');
    }
}
