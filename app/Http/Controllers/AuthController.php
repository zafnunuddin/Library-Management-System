<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\BookIssue;

class AuthController extends Controller
{
    // =========================
    // Register Page
    // =========================
    public function register()
{
    return view('auth.register');
}

public function storeRegistration(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',

        'student_id' => [
            'required',
            'digits:3',
            'unique:users,student_id',
        ],

        'email' => [
        'required',
        'email',
        'regex:/^[0-9]{3}@edu\.bd$/',
        'unique:users,email',
    ],

        'department' => 'required|string|max:100',

        'semester' => 'required|string|max:50',

        'password' => 'required|confirmed|min:6',

        'phone' => [
            'required',
            'digits:11',
            'unique:users,phone',
        ],

        'address' => 'nullable|string|max:500',
    ]);

    User::create([
        'name' => $validated['name'],
        'student_id' => $validated['student_id'],
        'email' => $validated['email'],
        'department' => $validated['department'],
        'semester' => $validated['semester'],
        'password' => Hash::make($validated['password']),
        'phone' => $validated['phone'],
        'address' => $validated['address'] ?? null,
        'role' => 'user',
        'status' => 'active',
        'member_since' => now(),
    ]);

    return redirect()
        ->route('login')
        ->with('success', 'Registration successful! Please login.');
}


    // =========================
    // Registration Process
    // =========================
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',

        'student_id' => [
            'required',
            'digits:3',
            'unique:users,student_id',
        ],

        'email' => [
            'required',
            'email',
            'regex:/^[0-9]{3}@edu\.bd$/',
            'unique:users,email',
        ],

        'phone' => [
            'required',
            'digits:11',
        ],

        'address' => 'nullable|string',

        'password' => 'required|min:8|confirmed',
    ], [
        'student_id.digits' => 'Incorrect Student ID.',
        'student_id.unique' => 'This Student ID is already registered.',

        'email.regex' => 'The Email is incorrect.',
        'email.unique' => 'This email is already registered.',

        'phone.digits' => 'Phone number must be exactly 11 digits.',

        'password.confirmed' => 'Password and Confirm Password do not match.',
    ]);

    $user = User::create([
        'name' => $request->name,
        'student_id' => $request->student_id,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'phone' => $request->phone,
        'address' => $request->address,

        // User registration থেকে কেউ Admin হতে পারবে না
        'role' => 'user',

        'status' => 'Active',
        'member_since' => now(),
    ]);

    return redirect()
        ->route('login')
        ->with('success', 'Registration successful. Please login.');
}

    // =========================
    // Login Page
    // =========================
    public function login()
    {
        return view('auth.login');
    }


    // =========================
    // Login Process
    // =========================
 public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'role' => 'required|in:admin,user',
    ]);

    if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password,
        'role' => $request->role,
    ])) {

        $request->session()->regenerate();

        if ($request->role === 'admin') {

            return redirect()
                ->route('admin.dashboard');

        }

        return redirect()
            ->route('user.dashboard');
    }

    return back()
        ->withErrors([
            'email' => 'Email, password or role is incorrect.',
        ])
        ->withInput($request->only('email', 'role'));
}

    // =========================
    // Logout
    // =========================
    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('home');
}

    // =====================================================
// SHOW FORGOT PASSWORD PAGE
// =====================================================

public function showForgotPassword()
{
    return view('auth.forgot-password');
}


// =====================================================
// SEND PASSWORD RESET LINK
// =====================================================

public function sendResetLink(Request $request)
{
    $request->validate([
        'email' => [
            'required',
            'email',
            'exists:users,email',
        ],
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    if ($status === Password::RESET_LINK_SENT) {

        return back()->with(
            'success',
            'Password reset link has been sent to your email.'
        );
    }

    return back()->withErrors([
        'email' => __($status),
    ]);
}


// =====================================================
// SHOW RESET PASSWORD PAGE
// =====================================================

public function showResetPassword(Request $request, $token)
{
    return view('auth.reset-password', [
        'token' => $token,
        'email' => $request->email,
    ]);
}


// =====================================================
// RESET PASSWORD
// =====================================================

public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => [
            'required',
            'confirmed',
            'min:8',
        ],
    ]);

    $status = Password::reset(
        $request->only(
            'email',
            'password',
            'password_confirmation',
            'token'
        ),

        function ($user, $password) {

            $user->forceFill([
                'password' => Hash::make($password),
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
        }
    );

    if ($status === Password::PASSWORD_RESET) {

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Your password has been reset successfully. You can now login.'
            );
    }

    return back()->withErrors([
        'email' => [__($status)],
    ]);
}
}