<?php

// app/Http/Controllers/Admin/HomeTasteController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeTaste;
use Illuminate\Http\Request;

class HomeTasteController extends Controller
{
    public function index()
    {
        $content = HomeTaste::with('items')->first();
        return view('admin.home-taste.index', compact('content'));
    }

    public function create()
    {
        $content = false;
        return view('admin.home-taste.form', compact('content'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subtitle' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'items.*.text' => 'required|string',
        ]);

        $taste = HomeTaste::create($request->only('subtitle', 'title', 'description'));

        foreach ($request->items as $index => $item) {
            $taste->items()->create([
                'text' => $item['text'],
                'order' => $index,
            ]);
        }

        return redirect()->route('home-taste.index')->with('success', 'Content created.');
    }

    public function edit(HomeTaste $homeTaste)
    {
        $content = $homeTaste->load('items');
        return view('admin.home-taste.form', compact('content'));
    }

    public function update(Request $request, HomeTaste $homeTaste)
    {
        $request->validate([
            'subtitle' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'items.*.text' => 'required|string',
        ]);

        $homeTaste->update($request->only('subtitle', 'title', 'description'));

        $homeTaste->items()->delete();

        foreach ($request->items as $index => $item) {
            $homeTaste->items()->create([
                'text' => $item['text'],
                'order' => $index,
            ]);
        }

        return redirect()->route('home-taste.index')->with('success', 'Content updated.');
    }
}
