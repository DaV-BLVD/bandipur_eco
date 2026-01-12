<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutImagesGrid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutImagesGridController extends Controller
{
    public function index()
    {
        $items = AboutImagesGrid::orderBy('order')->get();
        return view('admin.about-images-grid.index', compact('items'));
    }

    public function create()
    {
        $item = new AboutImagesGrid();
        return view('admin.about-images-grid.form', compact('item'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order' => 'nullable|integer',
            'status' => 'nullable', // Validation changed to nullable
        ]);

        // FIX: Explicitly handle checkbox logic
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('about/images-grid', 'public');
        }

        AboutImagesGrid::create($data);

        return redirect()->route('about-images-grid.index')->with('success', 'Item added successfully');
    }

    public function edit(AboutImagesGrid $about_images_grid)
    {
        $item = $about_images_grid;
        return view('admin.about-images-grid.form', compact('item'));
    }

    public function update(Request $request, AboutImagesGrid $about_images_grid)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'order' => 'nullable|integer',
            'status' => 'nullable', // Validation changed to nullable
        ]);

        // FIX: If 'status' is missing in the request, it means it was unchecked (set to false)
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            if ($about_images_grid->image) {
                Storage::disk('public')->delete($about_images_grid->image);
            }
            $data['image'] = $request->file('image')->store('about/images-grid', 'public');
        }

        $about_images_grid->update($data);

        return redirect()->route('about-images-grid.index')->with('success', 'Item updated successfully');
    }

    public function destroy(AboutImagesGrid $about_images_grid)
    {
        if ($about_images_grid->image) {
            Storage::disk('public')->delete($about_images_grid->image);
        }

        $about_images_grid->delete();

        return back()->with('success', 'Item deleted');
    }
}
