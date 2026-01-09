<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MapLocation;
use Illuminate\Http\Request;

class MapLocationController extends Controller
{
    public function index()
    {
        $locations = MapLocation::latest()->get();
        return view('admin.map-location.index', compact('locations'));
    }

    public function create()
    {
        $mapLocation = new MapLocation();
        return view('admin.map-location.form', compact('mapLocation'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'embed_url' => 'required|string|max:500',
            'description' => 'nullable|string',
            'primary_color' => 'required|string|max:7',
            'secondary_color' => 'required|string|max:7',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        MapLocation::create($data);

        return redirect()->route('map-location.index')->with('success', 'Map location created.');
    }

    public function edit(MapLocation $mapLocation)
    {
        return view('admin.map-location.form', compact('mapLocation'));
    }

    public function update(Request $request, MapLocation $mapLocation)
    {
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'embed_url' => 'required|string|max:500',
            'description' => 'nullable|string',
            'primary_color' => 'required|string|max:7',
            'secondary_color' => 'required|string|max:7',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        $mapLocation->update($data);

        return redirect()->route('map-location.index')->with('success', 'Map location updated.');
    }

    public function destroy(MapLocation $mapLocation)
    {
        $mapLocation->delete();
        return redirect()->route('map-location.index')->with('success', 'Map location deleted.');
    }
}
