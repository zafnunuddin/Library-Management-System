<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // =========================
    // Show Profile
    // =========================
    public function index()
    {
        $user = Auth::user();

        return view('admin.profile.index', compact('user'));
    }

    // =========================
    // Edit Profile
    // =========================
    public function edit()
    {
        $user = Auth::user();

        return view('admin.profile.edit', compact('user'));
    }

    // =========================
    // Update Profile
    // =========================
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'nullable|max:20',
            'department' => 'nullable|max:255',
            'address'    => 'nullable',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {

            $photo = $request->file('photo')->store('users', 'public');

            $user->photo = $photo;
        }

        $user->name       = $request->name;
        $user->email      = $request->email;
        $user->phone      = $request->phone;
        $user->department = $request->department;
        $user->address    = $request->address;

        $user->save();

        return redirect()
            ->route('profile')
            ->with('success', 'Profile Updated Successfully.');
    }

    // =========================
    // Change Password Page
    // =========================
    public function changePassword()
    {
        return view('admin.profile.change_password');
    }

    // =========================
    // Update Password
    // =========================
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {

            return back()->with('error', 'Current Password is incorrect.');
        }

        $user->password = Hash::make($request->new_password);

        $user->save();

        return redirect()
            ->route('profile')
            ->with('success', 'Password Changed Successfully.');
    }

   

public function deletePhoto()
{
    $user = auth()->user();

    if ($user->photo && Storage::disk('public')->exists($user->photo)) {
        Storage::disk('public')->delete($user->photo);
    }

    $user->photo = null;
    $user->save();

    return back()->with('success', 'Profile Photo Deleted Successfully');
}
}