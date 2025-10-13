<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        // Mark as read when viewing
        if (!$contact->read) {
            $contact->update(['read' => true]);
        }

        return view('admin.contacts.show', compact('contact'));
    }

   public function markAsRead(Contact $contact)
{
    $contact->update(['read' => true]);

    return redirect()->route('admin.contacts.index')
        ->with('success', 'Pesan ditandai sebagai sudah dibaca.');
}

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Pesan berhasil dihapus!');
    }
}