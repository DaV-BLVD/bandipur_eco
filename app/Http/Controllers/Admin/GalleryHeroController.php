<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryHeroController extends Controller
{
    public function index()
    {
        $heroes = GalleryHero::latest()->get(); // 👈 REQUIRED
        return view('admin.gallery-hero.index', compact('heroes'));
    }

    public function create()
    {
        $hero = new GalleryHero();
        return view('admin.gallery-hero.form', compact('hero'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('gallery-hero', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        // Optional: allow only one active hero
        if ($data['is_active']) {
            GalleryHero::where('is_active', true)->update(['is_active' => false]);
        }

        GalleryHero::create($data);

        return redirect()->route('gallery-hero.index')->with('success', 'Hero image created.');
    }

    public function edit(GalleryHero $galleryHero)
    {
        return view('admin.gallery-hero.form', [
            'hero' => $galleryHero,
        ]);
    }

    public function update(Request $request, GalleryHero $galleryHero)
    {
        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($galleryHero->image) {
                Storage::disk('public')->delete($galleryHero->image);
            }
            $data['image'] = $request->file('image')->store('gallery-hero', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        if ($data['is_active']) {
            GalleryHero::where('id', '!=', $galleryHero->id)->update(['is_active' => false]);
        }

        $galleryHero->update($data);

        return redirect()->route('gallery-hero.index')->with('success', 'Hero image updated.');
    }

    public function destroy(GalleryHero $galleryHero)
    {
        if ($galleryHero->image) {
            Storage::disk('public')->delete($galleryHero->image);
        }

        $galleryHero->delete();

        return redirect()->route('gallery-hero.index')->with('success', 'Hero image deleted.');
    }
}
