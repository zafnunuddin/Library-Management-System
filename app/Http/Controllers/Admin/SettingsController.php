<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Show the System Settings page, pre-filled with the current values.
     */
    public function index()
    {
        $setting = Setting::first() ?? new Setting();

        return view('admin.settings.index', compact('setting'));
    }

    /**
     * Save the System Settings (creates the row the first time it's saved).
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'library_name'               => 'nullable|string|max:255',
            'university_name'            => 'nullable|string|max:255',
            'fine_per_day'               => 'required|integer|min:0',
            'maximum_borrow_days'        => 'required|integer|min:1',
            'maximum_books_per_user'     => 'required|integer|min:1',
            'library_logo'               => 'nullable|image|max:2048',
            'email_notification'        => 'nullable|boolean',
            'due_notification'          => 'nullable|boolean',
            'registration_notification' => 'nullable|boolean',
        ]);

        $validated['email_notification'] = $request->boolean('email_notification');
        $validated['due_notification'] = $request->boolean('due_notification');
        $validated['registration_notification'] = $request->boolean('registration_notification');

        $setting = Setting::first() ?? new Setting();

        if ($request->hasFile('library_logo')) {
            $path = $request->file('library_logo')->store('library-logos', 'public');
            $validated['library_logo'] = $path;
        } else {
            unset($validated['library_logo']);
        }

        $setting->fill($validated);
        $setting->save();

        return back()->with('success', 'Settings saved successfully.');
    }
}
