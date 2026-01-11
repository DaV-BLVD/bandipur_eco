<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryContentController extends Controller
{
    public function index()
    {
        $contents = GalleryContent::orderBy('sort_order')->get();
        return view('admin.gallery-contents.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.gallery-contents.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'image' => 'required|image',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        GalleryContent::create($data);

        return redirect()->route('gallery-contents.index')->with('success', 'Gallery image added successfully.');
    }

    public function edit(GalleryContent $galleryContent)
    {
        return view('admin.gallery-contents.form', compact('galleryContent'));
    }

    public function update(Request $request, GalleryContent $galleryContent)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'image' => 'nullable|image',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($galleryContent->image) {
                Storage::disk('public')->delete($galleryContent->image);
            }
            $data['image'] = $request->file('image')->store('gallery', 'public');
        }

        $galleryContent->update($data);

        return redirect()->route('gallery-contents.index')->with('success', 'Gallery image updated.');
    }

    public function destroy(GalleryContent $galleryContent)
    {
        if ($galleryContent->image) {
            Storage::disk('public')->delete($galleryContent->image);
        }

        $galleryContent->delete();

        return back()->with('success', 'Gallery image deleted.');
    }
}
