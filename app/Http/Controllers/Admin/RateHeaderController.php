<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RateHeader;
use Illuminate\Http\Request;

class RateHeaderController extends Controller
{
    public function index()
    {
        $headers = RateHeader::latest()->get();
        return view('admin.rate-header.index', compact('headers'));
    }

    public function create()
    {
        return view('admin.rate-header.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        RateHeader::create($request->all());

        return redirect()->route('rate-header.index')->with('success', 'Rate header created successfully.');
    }

    public function edit(RateHeader $rateHeader)
    {
        return view('admin.rate-header.form', compact('rateHeader'));
    }

    public function update(Request $request, RateHeader $rateHeader)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $rateHeader->update($request->all());

        return redirect()->route('rate-header.index')->with('success', 'Rate header updated successfully.');
    }

    public function destroy(RateHeader $rateHeader)
    {
        $rateHeader->delete();

        return back()->with('success', 'Rate header deleted.');
    }
}
