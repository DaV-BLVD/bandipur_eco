<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccommodationHighlight;
use Illuminate\Http\Request;

class AccommodationHighlightController extends Controller
{
    public function index()
    {
        $highlights = AccommodationHighlight::orderBy('sort_order')->get();
        return view('admin.accommodation-highlight.index', compact('highlights'));
    }

    public function create()
    {
        return view('admin.accommodation-highlight.form', [
            'highlight' => new AccommodationHighlight(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        AccommodationHighlight::create($request->all());

        return redirect()->route('accommodation-highlight.index')->with('success', 'Amenity created successfully.');
    }

    public function edit(AccommodationHighlight $accommodationHighlight)
    {
        return view('admin.accommodation-highlight.form', [
            'highlight' => $accommodationHighlight,
        ]);
    }

    public function update(Request $request, AccommodationHighlight $accommodationHighlight)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $accommodationHighlight->update($request->all());

        return redirect()->route('accommodation-highlight.index')->with('success', 'Amenity updated successfully.');
    }

    public function destroy(AccommodationHighlight $accommodationHighlight)
    {
        $accommodationHighlight->delete();

        return back()->with('success', 'Amenity deleted.');
    }
}
