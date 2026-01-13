<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeHeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeHeroSliderController extends Controller
{
    public function index()
    {
        $sliders = HomeHeroSlider::orderBy('sort_order', 'asc')->get();
        return view('admin.home-hero-slider.index', compact('sliders'));
    }

    public function create()
    {
        // Pass null to indicate create mode
        return view('admin.home-hero-slider.form', ['slider' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp',
            'title_highlight' => 'required|string|max:255',
            'button_link' => 'required',
            'color_hex' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hero-sliders', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        HomeHeroSlider::create($data);

        return redirect()->route('home-hero-slider.index')->with('success', 'Slide created successfully.');
    }

    public function edit($id)
    {
        $slider = HomeHeroSlider::findOrFail($id);
        return view('admin.home-hero-slider.form', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = HomeHeroSlider::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title_highlight' => 'required|string|max:255',
            'color_hex' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $data['image'] = $request->file('image')->store('hero-sliders', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        $slider->update($data);

        return redirect()->route('home-hero-slider.index')->with('success', 'Slide updated successfully.');
    }

    public function destroy($id)
    {
        $slider = HomeHeroSlider::findOrFail($id);
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }
        $slider->delete();

        return redirect()->route('home-hero-slider.index')->with('success', 'Slide deleted successfully.');
    }
}
