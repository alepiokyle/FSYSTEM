<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class viewstudentController extends Controller
{
       public function index()
    {
        $students = User::with('profile')->where('user_role_id', 7)->get();
        return view('admin.studentAccount.student', compact('students'));
    }

    public function destroy($id)
    {
        $student = User::findOrFail($id);
        $profile = $student->profile;
        if ($profile) {
            $profile->delete();
        }
        $student->delete();

        return redirect()->route('view.student')->with('success', 'Student account and profile deleted successfully.');
    }
}
