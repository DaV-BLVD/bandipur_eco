<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccommodationHighlightPic;
use Illuminate\Http\Request;

class AccommodationHighlightPicController extends Controller
{
    public function index()
    {
        $pics = AccommodationHighlightPic::orderBy('sort_order')->get();
        return view('admin.accommodation-highlight-pic.index', compact('pics'));
    }

    public function create()
    {
        return view('admin.accommodation-highlight-pic.form', [
            'pic' => new AccommodationHighlightPic(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'rating_text' => 'required|string|max:20',
            'sort_order' => 'nullable|integer',
        ]);

        $path = $request->file('image')->store('accommodation-highlight', 'public');

        AccommodationHighlightPic::create([
            'image' => $path,
            'rating_text' => $request->rating_text,
            'status' => $request->status ?? 0,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('accommodation-highlight-pic.index')->with('success', 'Image added successfully.');
    }

    public function edit(AccommodationHighlightPic $accommodationHighlightPic)
    {
        return view('admin.accommodation-highlight-pic.form', [
            'pic' => $accommodationHighlightPic,
        ]);
    }

    public function update(Request $request, AccommodationHighlightPic $accommodationHighlightPic)
    {
        $request->validate([
            'rating_text' => 'required|string|max:20',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->only('rating_text', 'sort_order');
        $data['status'] = $request->status ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('accommodation-highlight', 'public');
        }

        $accommodationHighlightPic->update($data);

        return redirect()->route('accommodation-highlight-pic.index')->with('success', 'Image updated successfully.');
    }

    public function destroy(AccommodationHighlightPic $accommodationHighlightPic)
    {
        $accommodationHighlightPic->delete();
        return back()->with('success', 'Image deleted.');
    }
}
