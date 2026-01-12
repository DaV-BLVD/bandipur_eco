<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutTwo;
use Illuminate\Support\Facades\Storage;

class AboutTwoController extends Controller
{
    public function index()
    {
        $abouts = AboutTwo::all();
        return view('admin.about-two.index', compact('abouts'));
    }

    public function create()
    {
        return view('admin.about-two.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tagline' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description1' => 'nullable|string',
            'description2' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'feature1_icon' => 'nullable|string|max:255',
            'feature1_title' => 'nullable|string|max:255',
            'feature1_description' => 'nullable|string|max:255',
            'feature2_icon' => 'nullable|string|max:255',
            'feature2_title' => 'nullable|string|max:255',
            'feature2_description' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('about-two', 'public');
        }

        AboutTwo::create($data);

        return redirect()->route('about-two.index')->with('success', 'About section created successfully.');
    }

    public function edit(AboutTwo $aboutTwo)
    {
        return view('admin.about-two.form', compact('aboutTwo'));
    }

    public function update(Request $request, AboutTwo $aboutTwo)
    {
        $data = $request->validate([
            'tagline' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'description1' => 'nullable|string',
            'description2' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'feature1_icon' => 'nullable|string|max:255',
            'feature1_title' => 'nullable|string|max:255',
            'feature1_description' => 'nullable|string|max:255',
            'feature2_icon' => 'nullable|string|max:255',
            'feature2_title' => 'nullable|string|max:255',
            'feature2_description' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            if ($aboutTwo->image) {
                Storage::disk('public')->delete($aboutTwo->image);
            }
            $data['image'] = $request->file('image')->store('about-two', 'public');
        }

        $aboutTwo->update($data);

        return redirect()->route('about-two.index')->with('success', 'About section updated successfully.');
    }

    public function destroy(AboutTwo $aboutTwo)
    {
        if ($aboutTwo->image) {
            Storage::disk('public')->delete($aboutTwo->image);
        }
        $aboutTwo->delete();
        return redirect()->route('about-two.index')->with('success', 'About section deleted successfully.');
    }
}
