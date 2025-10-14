<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsersProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SectionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = UsersProfile::where('users_id', $user->id)->first();

        return view('student.Profile.Section', compact('profile'));
    }

    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $profile = UsersProfile::where('users_id', $user->id)->first();

        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($profile->profile_picture && Storage::exists('public/profile_pictures/' . $profile->profile_picture)) {
                Storage::delete('public/profile_pictures/' . $profile->profile_picture);
            }

            // Store new image
            $fileName = time() . '_' . $user->id . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            $path = $request->file('profile_picture')->storeAs('public/profile_pictures', $fileName);

            // Update profile
            $profile->update(['profile_picture' => $fileName]);

            return response()->json([
                'success' => true,
                'image_url' => asset('storage/profile_pictures/' . $fileName),
                'message' => 'Profile picture updated successfully!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No file uploaded.'
        ]);
    }
}
