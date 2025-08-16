<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DeanController extends Controller
{
    // Ensure user is logged in
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show all dean accounts
    public function index()
    {
        // Only admin can access
        if(auth()->user()->role_name != 'admin') {
            abort(403, 'Unauthorized access');
        }

        $deans = User::where('role_name', 'dean')->get();
        return view('admin.deans.index', compact('deans'));
    }

    // Add a new dean account
    public function store(Request $request)
    {
        // Only admin can access
        if(auth()->user()->role_name != 'admin') {
            abort(403, 'Unauthorized access');
        }

        // Validate form input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'department' => 'required|string',
            'password' => 'nullable|string|min:6',
        ]);

        // Create new dean
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_name' => 'dean', // fixed role
            'department' => $request->department,
            'password' => Hash::make($request->password ?? '123456'), // default password
        ]);

        return redirect()->back()->with('success', 'Dean added successfully.');
    }
}
