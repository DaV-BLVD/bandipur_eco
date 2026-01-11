<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RatesHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RatesHeroController extends Controller
{
    public function index()
    {
        $heroes = RatesHero::latest()->get();
        return view('admin.rates-hero.index', compact('heroes'));
    }

    public function create()
    {
        return view('admin.rates-hero.form', ['hero' => new RatesHero()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('image')->store('rates-hero', 'public');

        RatesHero::create([
            'image' => $path,
        ]);

        return redirect()->route('rates-hero.index')->with('success', 'Hero image added');
    }

    public function edit(RatesHero $ratesHero)
    {
        return view('admin.rates-hero.form', ['hero' => $ratesHero]);
    }

    public function update(Request $request, RatesHero $ratesHero)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($ratesHero->image);
            $ratesHero->image = $request->file('image')->store('rates-hero', 'public');
        }

        $ratesHero->save();

        return redirect()->route('rates-hero.index')->with('success', 'Hero image updated');
    }

    public function destroy(RatesHero $ratesHero)
    {
        Storage::disk('public')->delete($ratesHero->image);
        $ratesHero->delete();

        return back()->with('success', 'Hero image deleted');
    }
}
