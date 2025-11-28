<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Profile; // <-- Tambahkan ini

class ContactController extends Controller
{
    public function index()
    {
        // Ambil data profil untuk ditampilkan di halaman contact
        $profile = Profile::first();

        return view('contact', compact('profile'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:1000'
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'subject.required' => 'Subjek wajib diisi',
            'message.required' => 'Pesan wajib diisi',
            'message.min' => 'Pesan minimal 10 karakter',
            'message.max' => 'Pesan maksimal 1000 karakter'
        ]);

        // Simpan pesan ke database
        Contact::create($validated);

        return redirect()->route('contact')
            ->with('success', 'Pesan Anda telah terkirim! Saya akan membalasnya segera.');
    }
}
