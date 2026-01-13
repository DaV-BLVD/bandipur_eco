<?php

// app/Http/Controllers/Admin/HomeLocationContentController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeLocationContent;
use Illuminate\Http\Request;

class HomeLocationContentController extends Controller
{
    public function index()
    {
        $content = HomeLocationContent::first();
        return view('admin.home-location-content.index', compact('content'));
    }

    public function create()
    {
        $content = false;
        return view('admin.home-location-content.form', compact('content'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string',
            'description' => 'required|string',
            'car_text' => 'required|string',
            'pickup_text' => 'required|string',
        ]);

        HomeLocationContent::create($request->all());

        return redirect()->route('home-location-content.index')->with('success', 'Location content created successfully.');
    }

    public function edit(HomeLocationContent $homeLocationContent)
    {
        $content = $homeLocationContent;
        return view('admin.home-location-content.form', compact('content'));
    }

    public function update(Request $request, HomeLocationContent $homeLocationContent)
    {
        $request->validate([
            'heading' => 'required|string',
            'description' => 'required|string',
            'car_text' => 'required|string',
            'pickup_text' => 'required|string',
        ]);

        $homeLocationContent->update($request->all());

        return redirect()->route('home-location-content.index')->with('success', 'Location content updated successfully.');
    }
}
