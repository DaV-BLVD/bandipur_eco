<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhoWeArePhoto;
use Illuminate\Http\Request;

class WhoWeArePhotoController extends Controller
{
    public function index()
    {
        $photos = WhoWeArePhoto::orderBy('sort_order')->get();
        return view('admin.who-we-are-photos.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.who-we-are-photos.form', [
            'photo' => new WhoWeArePhoto(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_primary' => 'required|image',
            'image_secondary' => 'required|image',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $primaryPath = $request->file('image_primary')->store('who-we-are', 'public');
        $secondaryPath = $request->file('image_secondary')->store('who-we-are', 'public');

        WhoWeArePhoto::create([
            'image_primary' => $primaryPath,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image_secondary' => $secondaryPath,
            'status' => $request->status ?? 0,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('who-we-are-photos.index')->with('success', 'Photo added successfully.');
    }

    public function edit(WhoWeArePhoto $whoWeArePhoto)
    {
        return view('admin.who-we-are-photos.form', [
            'photo' => $whoWeArePhoto,
        ]);
    }

    public function update(Request $request, WhoWeArePhoto $whoWeArePhoto)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->only('title', 'subtitle', 'sort_order');
        $data['status'] = $request->status ?? 0;

        if ($request->hasFile('image_primary')) {
            $data['image_primary'] = $request->file('image_primary')->store('who-we-are', 'public');
        }
        if ($request->hasFile('image_secondary')) {
            $data['image_secondary'] = $request->file('image_secondary')->store('who-we-are', 'public');
        }

        $whoWeArePhoto->update($data);

        return redirect()->route('who-we-are-photos.index')->with('success', 'Photo updated successfully.');
    }

    public function destroy(WhoWeArePhoto $whoWeArePhoto)
    {
        $whoWeArePhoto->delete();
        return back()->with('success', 'Photo deleted.');
    }
}
