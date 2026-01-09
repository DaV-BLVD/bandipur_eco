<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index()
    {
        $infos = ContactInfo::orderBy('id', 'asc')->get();
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
        $request->validate([
            'icon' => 'required|string',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'values' => 'required|array', // Validate the outer array
            'theme_color' => 'required|string|max:20',
        ]);

        // Extract values and links into separate arrays for the DB
        $values = [];
        $links = [];
        foreach ($request->values as $item) {
            if (!empty($item['value'])) {
                $values[] = $item['value'];
                $links[] = !empty($item['link']) ? $item['link'] . $item['value'] : null;
            }
        }

        ContactInfo::create([
            'icon' => $request->icon,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'value' => $values, // Saved as JSON automatically
            'link' => $links, // Saved as JSON automatically
            'theme_color' => $request->theme_color,
            'is_active' => $request->has('is_active'),
        ]);

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
        $request->validate([
            'icon' => 'required|string',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'values' => 'required|array',
            'theme_color' => 'required|string|max:20',
        ]);

        $values = [];
        $links = [];
        foreach ($request->values as $item) {
            if (!empty($item['value'])) {
                $values[] = $item['value'];
                $links[] = $item['link'] ?? null;
            }
        }

        $contactInfo->update([
            'icon' => $request->icon,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'value' => $values,
            'link' => $links,
            'theme_color' => $request->theme_color,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('contact-info.index')->with('success', 'Contact info updated');
    }

    public function destroy(ContactInfo $contactInfo)
    {
        $contactInfo->delete();
        return back()->with('success', 'Contact info deleted');
    }
}
