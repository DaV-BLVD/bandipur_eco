<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutHero;
use Illuminate\Http\Request;

class AboutHeroController extends Controller
{
    public function index()
    {
        $heroes = AboutHero::orderBy('sort_order')->get();
        return view('admin.about-hero.index', compact('heroes'));
    }

    public function create()
    {
        return view('admin.about-hero.form', [
            'hero' => new AboutHero(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'sort_order' => 'nullable|integer',
        ]);

        $path = $request->file('image')->store('about-hero', 'public');

        AboutHero::create([
            'image' => $path,
            'status' => $request->status ?? 0,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('about-hero.index')->with('success', 'About hero image added.');
    }

    public function edit(AboutHero $aboutHero)
    {
        return view('admin.about-hero.form', [
            'hero' => $aboutHero,
        ]);
    }

    public function update(Request $request, AboutHero $aboutHero)
    {
        $request->validate([
            'sort_order' => 'nullable|integer',
        ]);

        $data = [
            'status' => $request->status ?? 0,
            'sort_order' => $request->sort_order ?? 0,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('about-hero', 'public');
        }

        $aboutHero->update($data);

        return redirect()->route('about-hero.index')->with('success', 'About hero updated.');
    }

    public function destroy(AboutHero $aboutHero)
    {
        $aboutHero->delete();
        return back()->with('success', 'About hero deleted.');
    }
}
