<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryHeader;
use Illuminate\Http\Request;

class GalleryHeaderController extends Controller
{
    public function index()
    {
        $headers = GalleryHeader::latest()->get();
        return view('admin.gallery-headers.index', compact('headers'));
    }

    public function create()
    {
        return view('admin.gallery-headers.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        GalleryHeader::create($request->all());

        return redirect()->route('gallery-headers.index')->with('success', 'Gallery Header created successfully.');
    }

    public function edit(GalleryHeader $galleryHeader)
    {
        return view('admin.gallery-headers.form', compact('galleryHeader'));
    }

    public function update(Request $request, GalleryHeader $galleryHeader)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $galleryHeader->update($request->all());

        return redirect()->route('gallery-headers.index')->with('success', 'Gallery Header updated successfully.');
    }

    public function destroy(GalleryHeader $galleryHeader)
    {
        $galleryHeader->delete();

        return back()->with('success', 'Gallery Header deleted.');
    }
}
