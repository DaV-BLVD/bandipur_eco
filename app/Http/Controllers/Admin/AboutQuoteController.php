<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutQuote;

class AboutQuoteController extends Controller
{
    public function index()
    {
        $quotes = AboutQuote::latest()->get();
        return view('admin.about-quote.index', compact('quotes'));
    }

    public function create()
    {
        return view('admin.about-quote.form', ['quote' => new AboutQuote()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon' => 'nullable|string',
            'subtitle' => 'required|string|max:255',
            'quote' => 'required|string',
            'status' => 'required|boolean',
        ]);

        AboutQuote::create($data);
        return redirect()->route('about-quote.index');
    }

    public function edit(AboutQuote $aboutQuote)
    {
        return view('admin.about-quote.form', ['quote' => $aboutQuote]);
    }

    public function update(Request $request, AboutQuote $aboutQuote)
    {
        $data = $request->validate([
            'icon' => 'nullable|string',
            'subtitle' => 'required|string|max:255',
            'quote' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $aboutQuote->update($data);
        return redirect()->route('about-quote.index');
    }

    public function destroy(AboutQuote $aboutQuote)
    {
        $aboutQuote->delete();
        return back();
    }
}
