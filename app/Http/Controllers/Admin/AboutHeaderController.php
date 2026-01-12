<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutHeader;
use Illuminate\Http\Request;

class AboutHeaderController extends Controller
{
    public function index()
    {
        $headers = AboutHeader::orderBy('sort_order')->get();
        return view('admin.about-header.index', compact('headers'));
    }

    public function create()
    {
        return view('admin.about-header.form', [
            'header' => new AboutHeader(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'badge_text' => 'required|string|max:255',
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        AboutHeader::create([
            'badge_text' => $request->badge_text,
            'heading' => $request->heading,
            'description' => $request->description,
            'status' => $request->status ?? 0,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('about-header.index')->with('success', 'About header created.');
    }

    public function edit(AboutHeader $aboutHeader)
    {
        return view('admin.about-header.form', [
            'header' => $aboutHeader,
        ]);
    }

    public function update(Request $request, AboutHeader $aboutHeader)
    {
        $request->validate([
            'badge_text' => 'required|string|max:255',
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        $aboutHeader->update([
            'badge_text' => $request->badge_text,
            'heading' => $request->heading,
            'description' => $request->description,
            'status' => $request->status ?? 0,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('about-header.index')->with('success', 'About header updated.');
    }

    public function destroy(AboutHeader $aboutHeader)
    {
        $aboutHeader->delete();
        return back()->with('success', 'About header deleted.');
    }
}
