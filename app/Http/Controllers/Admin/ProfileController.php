<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::first();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::firstOrNew([]);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cv_path' => 'nullable|file|mimes:pdf,doc,docx|max:5120'
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::delete($profile->photo);
            }
            $validated['photo'] = $request->file('photo')->store('profile', 'public');
        }

        // Handle CV upload
        if ($request->hasFile('cv_path')) {
            if ($profile->cv_path) {
                Storage::delete($profile->cv_path);
            }
            $validated['cv_path'] = $request->file('cv_path')->store('cv', 'public');
        }

        $profile->fill($validated);
        $profile->save();

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}