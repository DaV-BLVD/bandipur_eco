<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutOne;
use Illuminate\Support\Facades\Storage;

class AboutOneController extends Controller
{
    public function index()
    {
        $abouts = AboutOne::all();
        return view('admin.about-one.index', compact('abouts'));
    }

    public function create()
    {
        return view('admin.about-one.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'since' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'suites' => 'nullable|integer',
            'acres' => 'nullable|integer',
            'views' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'quote' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('about-one', 'public');
        }

        AboutOne::create($data);

        return redirect()->route('about-one.index')->with('success', 'About section created successfully.');
    }

    public function edit(AboutOne $aboutOne)
    {
        return view('admin.about-one.form', compact('aboutOne'));
    }

    public function update(Request $request, AboutOne $aboutOne)
    {
        $data = $request->validate([
            'since' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'suites' => 'nullable|integer',
            'acres' => 'nullable|integer',
            'views' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'quote' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($aboutOne->image) {
                Storage::disk('public')->delete($aboutOne->image);
            }
            $data['image'] = $request->file('image')->store('about-one', 'public');
        }

        $aboutOne->update($data);

        return redirect()->route('about-one.index')->with('success', 'About section updated successfully.');
    }

    public function destroy(AboutOne $aboutOne)
    {
        if ($aboutOne->image) {
            Storage::disk('public')->delete($aboutOne->image);
        }
        $aboutOne->delete();
        return redirect()->route('about-one.index')->with('success', 'About section deleted successfully.');
    }
}
