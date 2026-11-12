<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function updateResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf|max:5120', // Max 5MB PDF
        ]);

        $setting = Setting::first() ?? new Setting();

        if ($request->hasFile('resume')) {
            // Purani file delete karein agar mojood hai
            if ($setting->resume_path && Storage::disk('public')->exists($setting->resume_path)) {
                Storage::disk('public')->delete($setting->resume_path);
            }

            $path = $request->file('resume')->store('resumes', 'public');
            $setting->resume_path = $path;
            $setting->save();
        }

        return back()->with('success', 'Resume updated successfully!');
    }
}