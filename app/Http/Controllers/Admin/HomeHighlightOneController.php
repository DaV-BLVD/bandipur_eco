<?php

// app/Http/Controllers/Admin/HomeHighlightOneController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeHighlightOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeHighlightOneController extends Controller
{
    public function index()
    {
        $content = HomeHighlightOne::first();
        return view('admin.home-highlight-one.index', compact('content'));
    }

    public function create()
    {
        $content = false;
        return view('admin.home-highlight-one.form', compact('content'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'percentage' => 'required|string',
            'text' => 'required|string',
        ]);

        HomeHighlightOne::create([
            'image' => $request->file('image')->store('home-highlight-one', 'public'),
            'percentage' => $request->percentage,
            'text' => $request->text,
        ]);

        return redirect()->route('home-highlight-one.index')->with('success', 'Highlight created successfully.');
    }

    public function edit(HomeHighlightOne $homeHighlightOne)
    {
        $content = $homeHighlightOne;
        return view('admin.home-highlight-one.form', compact('content'));
    }

    public function update(Request $request, HomeHighlightOne $homeHighlightOne)
    {
        $request->validate([
            'percentage' => 'required|string',
            'text' => 'required|string',
        ]);

        $data = $request->only('percentage', 'text');

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($homeHighlightOne->image);
            $data['image'] = $request->file('image')->store('home-highlight-one', 'public');
        }

        $homeHighlightOne->update($data);

        return redirect()->route('home-highlight-one.index')->with('success', 'Highlight updated successfully.');
    }
}
