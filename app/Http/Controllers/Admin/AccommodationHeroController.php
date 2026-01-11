<?php

// app/Http/Controllers/Admin/AccommodationHeroController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccommodationHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccommodationHeroController extends Controller
{
    public function index()
    {
        $heroes = AccommodationHero::latest()->get();
        return view('admin.accommodation_hero.index', compact('heroes'));
    }

    public function create()
    {
        $hero = new AccommodationHero();
        return view('admin.accommodation_hero.form', compact('hero'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        $data['image'] = $request->file('image')->store('accommodation-hero', 'public');

        AccommodationHero::create($data);

        return redirect()->route('accommodation-hero.index')->with('success', 'Accommodation hero added successfully.');
    }

    public function edit(AccommodationHero $accommodationHero)
    {
        $hero = $accommodationHero;
        return view('admin.accommodation_hero.form', compact('hero'));
    }

    public function update(Request $request, AccommodationHero $accommodationHero)
    {
        $data = $request->validate([
            'image' => 'nullable|image|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($accommodationHero->image);
            $data['image'] = $request->file('image')->store('accommodation-hero', 'public');
        }

        $accommodationHero->update($data);

        return redirect()->route('accommodation-hero.index')->with('success', 'Accommodation hero updated successfully.');
    }

    public function destroy(AccommodationHero $accommodationHero)
    {
        Storage::disk('public')->delete($accommodationHero->image);
        $accommodationHero->delete();

        return redirect()->route('accommodation-hero.index')->with('success', 'Accommodation hero deleted.');
    }
}
