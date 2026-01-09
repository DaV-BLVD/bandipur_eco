<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('id', 'asc')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $faq = new Faq();
        return view('admin.faqs.form', compact('faq'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'required|boolean',
        ]);

        // FIX: Remove the $request->has line.
        // The 'is_active' value is already in $data thanks to validation.

        Faq::create($data);

        return redirect()->route('faqs.index')->with('success', 'FAQ created.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.form', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'required|boolean',
        ]);

        // FIX: Remove the $request->has line.
        $faq->update($data);

        return redirect()->route('faqs.index')->with('success', 'FAQ updated.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('faqs.index')->with('success', 'FAQ deleted.');
    }
}
