<?php

// app/Http/Controllers/Admin/HomeFeatureController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeFeature;
use Illuminate\Http\Request;

class HomeFeatureController extends Controller
{
    public function index()
    {
        $features = HomeFeature::orderBy('order')->get();
        return view('admin.home-features.index', compact('features'));
    }

    public function create()
    {
        $feature = false;
        return view('admin.home-features.form', compact('feature'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'time' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'order' => 'required|integer',
        ]);

        HomeFeature::create($request->all());

        return redirect()->route('home-features.index')->with('success', 'Feature added successfully.');
    }

    public function edit(HomeFeature $homeFeature)
    {
        $feature = $homeFeature;
        return view('admin.home-features.form', compact('feature'));
    }

    public function update(Request $request, HomeFeature $homeFeature)
    {
        $request->validate([
            'time' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'order' => 'required|integer',
        ]);

        $homeFeature->update($request->all());

        return redirect()->route('home-features.index')->with('success', 'Feature updated successfully.');
    }

    public function destroy(HomeFeature $homeFeature)
    {
        $homeFeature->delete();

        return redirect()->route('home-features.index')->with('success', 'Feature deleted successfully.');
    }
}
