<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactHeader;
use Illuminate\Http\Request;

class ContactHeaderController extends Controller
{
    public function index()
    {
        $headers = ContactHeader::latest()->get();
        return view('admin.contact-header.index', compact('headers'));
    }

    public function create()
    {
        return view('admin.contact-header.form', [
            'header' => new ContactHeader()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable',
        ]);

        $data['is_active'] = $request->has('is_active');

        ContactHeader::create($data);

        return redirect()
            ->route('contact-header.index')
            ->with('success', 'Contact Header created successfully');
    }

    public function edit(ContactHeader $contactHeader)
    {
        return view('admin.contact-header.form', [
            'header' => $contactHeader
        ]);
    }

    public function update(Request $request, ContactHeader $contactHeader)
    {
        $data = $request->validate([
            'badge_text' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable',
        ]);

        $data['is_active'] = $request->has('is_active');

        $contactHeader->update($data);

        return redirect()
            ->route('contact-header.index')
            ->with('success', 'Contact Header updated successfully');
    }

    public function destroy(ContactHeader $contactHeader)
    {
        $contactHeader->delete();

        return back()->with('success', 'Contact Header deleted');
    }
}
