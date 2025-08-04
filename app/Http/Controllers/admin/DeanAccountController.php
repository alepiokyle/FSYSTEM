<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DeanAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin'); // Ensure only admin can access this controller
    }

    /**
     * Show the form to create a new dean account.
     */
    public function create()
    {
        return view('admin.deans.create'); // Make sure this view file exists
    }

    /**
     * Store the new dean account in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dean', // Assign the role as 'dean'
        ]);

        return redirect()->back()->with('success', 'Dean account registered successfully!');
    }
}
