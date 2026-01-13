<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeHighlightTwo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeHighlightTwoController extends Controller
{
    public function index()
    {
        $content = HomeHighlightTwo::with('items')->first();
        return view('admin.home-highlight-two.index', compact('content'));
    }

    public function create()
    {
        $content = false;
        return view('admin.home-highlight-two.form', compact('content'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'heading' => 'required',
            'description' => 'required',
            'image_one' => 'required|image',
            'image_two' => 'required|image',
        ]);

        $content = HomeHighlightTwo::create([
            'label' => $request->label,
            'heading' => $request->heading,
            'description' => $request->description,
            'image_one' => $request->file('image_one')->store('home-highlight-two', 'public'),
            'image_two' => $request->file('image_two')->store('home-highlight-two', 'public'),
        ]);

        foreach ($request->items as $item) {
            $content->items()->create($item);
        }

        return redirect()->route('home-highlight-two.index');
    }

    public function edit(HomeHighlightTwo $homeHighlightTwo)
    {
        $content = $homeHighlightTwo->load('items');
        return view('admin.home-highlight-two.form', compact('content'));
    }

    public function update(Request $request, HomeHighlightTwo $homeHighlightTwo)
    {
        $data = $request->only('label', 'heading', 'description');

        if ($request->hasFile('image_one')) {
            Storage::disk('public')->delete($homeHighlightTwo->image_one);
            $data['image_one'] = $request->file('image_one')->store('home-highlight-two', 'public');
        }

        if ($request->hasFile('image_two')) {
            Storage::disk('public')->delete($homeHighlightTwo->image_two);
            $data['image_two'] = $request->file('image_two')->store('home-highlight-two', 'public');
        }

        $homeHighlightTwo->update($data);

        $homeHighlightTwo->items()->delete();
        foreach ($request->items as $item) {
            $homeHighlightTwo->items()->create($item);
        }

        return redirect()->route('home-highlight-two.index');
    }
}
