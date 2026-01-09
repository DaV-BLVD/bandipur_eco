<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::all();
        return view('admin.social-links.index', compact('socialLinks'));
    }

    public function create()
    {
        $socialLink = new SocialLink();
        return view('admin.social-links.form', compact('socialLink'));
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:50',
        'icon' => 'required|string|max:50',
        'url' => 'required|url|max:255',
        'color' => 'nullable|string|max:7',
        'is_active' => 'nullable', // we’ll handle it manually
    ]);

    // Ensure boolean value
    $data['is_active'] = $request->has('is_active') ? true : false;

    SocialLink::create($data);

    return redirect()->route('social-links.index')->with('success', 'Social link added.');
}

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social-links.form', compact('socialLink'));
    }

    public function update(Request $request, SocialLink $socialLink)
{
    $data = $request->validate([
        'name' => 'required|string|max:50',
        'icon' => 'required|string|max:50',
        'url' => 'required|url|max:255',
        'color' => 'nullable|string|max:7',
        'is_active' => 'nullable', // we’ll handle it manually
    ]);

    // Ensure boolean value
    $data['is_active'] = $request->has('is_active') ? true : false;

    $socialLink->update($data);

    return redirect()->route('social-links.index')->with('success', 'Social link updated.');
}

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();
        return redirect()->route('social-links.index')->with('success', 'Social link deleted.');
    }
}
