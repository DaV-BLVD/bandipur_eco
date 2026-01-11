<?php

// app/Http/Controllers/Admin/AccommodationHeaderController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccommodationHeader;
use Illuminate\Http\Request;

class AccommodationHeaderController extends Controller
{
    public function index()
    {
        $headers = AccommodationHeader::latest()->get();
        return view('admin.accommodation_header.index', compact('headers'));
    }

    public function create()
    {
        $header = new AccommodationHeader();
        return view('admin.accommodation_header.form', compact('header'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'badge_text' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
        ]);

        AccommodationHeader::create($data);

        return redirect()->route('accommodation-header.index')->with('success', 'Accommodation header created.');
    }

    public function edit(AccommodationHeader $accommodationHeader)
    {
        $header = $accommodationHeader;
        return view('admin.accommodation_header.form', compact('header'));
    }

    public function update(Request $request, AccommodationHeader $accommodationHeader)
    {
        $data = $request->validate([
            'badge_text' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $accommodationHeader->update($data);

        return redirect()->route('accommodation-header.index')->with('success', 'Accommodation header updated.');
    }

    public function destroy(AccommodationHeader $accommodationHeader)
    {
        $accommodationHeader->delete();

        return redirect()->route('accommodation-header.index')->with('success', 'Accommodation header deleted.');
    }
}
