<?php

// app/Http/Controllers/Admin/HomeImagesGridController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeImagesGrid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeImagesGridController extends Controller
{
    public function index()
    {
        $images = HomeImagesGrid::orderBy('position')->get();
        return view('admin.home-images-grid.index', compact('images'));
    }

    public function create()
    {
        $image = false;
        return view('admin.home-images-grid.form', compact('image'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'position' => 'required|integer',
        ]);

        $path = $request->file('image')->store('home-images-grid', 'public');

        HomeImagesGrid::create([
            'image' => $path,
            'alt_text' => $request->alt_text,
            'position' => $request->position,
        ]);

        return redirect()->route('home-images-grid.index')->with('success', 'Image added successfully.');
    }

    public function edit(HomeImagesGrid $homeImagesGrid)
    {
        $image = $homeImagesGrid;
        return view('admin.home-images-grid.form', compact('image'));
    }

    public function update(Request $request, HomeImagesGrid $homeImagesGrid)
    {
        $request->validate([
            'position' => 'required|integer',
        ]);

        $data = $request->only('alt_text', 'position');

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($homeImagesGrid->image);
            $data['image'] = $request->file('image')->store('home-images-grid', 'public');
        }

        $homeImagesGrid->update($data);

        return redirect()->route('home-images-grid.index')->with('success', 'Image updated successfully.');
    }
}
