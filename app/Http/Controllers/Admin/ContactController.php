<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactModel;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        // Get first contact or create new empty one
        $contact = ContactModel::firstOrCreate(
            ['id' => 1], // This ensures we always have exactly one record
            [
                'phone' => '',
                'address' => '',
                'email' => '',
                'map' => ''
            ]
        );

        return view('admin.pages.contact', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'required|email|max:255',
            'map' => 'required|string',
        ]);

        $contact = ContactModel::findOrFail($id);
        $contact->update($validated);

        // Add with() to the redirect
        return redirect()
            ->route('contact-content.index')
            ->with('success', 'Contact information updated successfully');
    }
}