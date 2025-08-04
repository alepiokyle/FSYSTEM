<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function __construct()
    {
        // Ensure user is authenticated for all methods
        $this->middleware('auth');
    }

    public function index()
    {
        // Ensure user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        // Fetch all subjects ordered by id descending
        $subjects = DB::table('subjects')->orderBy('id', 'desc')->get();

        return view('Admin.upload', compact('subjects'));
    }

    public function store(Request $request)
    {
        // Double-check authentication
        if (!Auth::check()) {
            return response()->json([
                'error' => 'Authentication required',
                'redirect' => route('login')
            ], 401);
        }

        try {
            $validated = $request->validate([
                'department' => 'required|string|max:255',
                'subject_code' => 'required|string|max:50|unique:subjects,subject_code',
                'subject_name' => 'required|string|max:255',
                'units' => 'required|integer|min:1|max:10',
                'year_level' => 'required|string|max:20',
                'semester' => 'required|string|max:20',
                'school_year' => ['required', 'string', 'regex:/^\d{4}-\d{4}$/'],
            ]);

            DB::table('subjects')->insert($validated);

            return redirect()
                ->route('upload.subjects')
                ->with('success', 'Subject uploaded successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($e->errors());
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to upload subject: ' . $e->getMessage());
        }
    }
}
