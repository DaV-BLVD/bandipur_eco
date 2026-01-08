<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index()
    {
        $infos = ContactInfo::latest()->get();
        return view('admin.contact-info.index', compact('infos'));
    }

    public function create()
    {
        return view('admin.contact-info.form', [
            'info' => new ContactInfo(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon' => 'required|string',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'value' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'theme_color' => 'required|string|max:20',
            'is_active' => 'nullable',
        ]);

        $data['is_active'] = $request->has('is_active');

        ContactInfo::create($data);

        return redirect()->route('contact-info.index')->with('success', 'Contact info created');
    }

    public function edit(ContactInfo $contactInfo)
    {
        return view('admin.contact-info.form', [
            'info' => $contactInfo,
        ]);
    }

    public function update(Request $request, ContactInfo $contactInfo)
    {
        $data = $request->validate([
            'icon' => 'required|string',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'value' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'theme_color' => 'required|string|max:20',
            'is_active' => 'nullable',
        ]);

        $data['is_active'] = $request->has('is_active');

        $contactInfo->update($data);

        return redirect()->route('contact-info.index')->with('success', 'Contact info updated');
    }

    public function destroy(ContactInfo $contactInfo)
    {
        $contactInfo->delete();
        return back()->with('success', 'Contact info deleted');
    }
}
