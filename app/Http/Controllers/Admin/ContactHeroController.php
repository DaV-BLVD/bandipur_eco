<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactHeroController extends Controller
{
    public function index()
    {
        $heroes = ContactHero::latest()->get();
        return view('admin.contact-hero.index', compact('heroes'));
    }

    public function create()
    {
        return view('admin.contact-hero.form', [
            'hero' => new ContactHero()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image',
            'is_active' => 'nullable',
        ]);

        $data['image'] = $request->file('image')->store('contact-hero', 'public');
        $data['is_active'] = $request->has('is_active');

        ContactHero::create($data);

        return redirect()->route('contact-hero.index')
            ->with('success', 'Contact Hero created successfully');
    }

    public function edit(ContactHero $contactHero)
    {
        return view('admin.contact-hero.form', [
            'hero' => $contactHero
        ]);
    }

    public function update(Request $request, ContactHero $contactHero)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image',
            'is_active' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($contactHero->image);
            $data['image'] = $request->file('image')->store('contact-hero', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        $contactHero->update($data);

        return redirect()->route('contact-hero.index')
            ->with('success', 'Contact Hero updated successfully');
    }

    public function destroy(ContactHero $contactHero)
    {
        Storage::disk('public')->delete($contactHero->image);
        $contactHero->delete();

        return back()->with('success', 'Contact Hero deleted');
    }
}
