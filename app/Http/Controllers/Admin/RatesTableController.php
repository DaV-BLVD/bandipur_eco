<?php

// app/Http/Controllers/Admin/RateTableController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RatesTable;
use Illuminate\Http\Request;

class RatesTableController extends Controller
{
    public function index()
    {
        $rates = RatesTable::orderBy('sort_order')->get();
        return view('admin.rates-table.index', compact('rates'));
    }

    public function create()
    {
        $rate = new RatesTable();
        return view('admin.rates-table.form', compact('rate'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_type' => 'required|string|max:255',
            'single_price' => 'nullable|numeric',
            'double_price' => 'nullable|numeric',
            'extra_bed' => 'nullable|numeric',
            'inclusions' => 'required|array|min:1',
            'currency' => 'required|string|in:USD,NPR',
            'sort_order' => 'nullable|integer',
        ]);

        RatesTable::create($data);
        return redirect()->route('rates-table.index')->with('success', 'Rate added successfully!');
    }

    public function edit(RatesTable $rate)
    {
        return view('admin.rates-table.form', compact('rate'));
    }

    public function update(Request $request, RatesTable $rate)
    {
        $data = $request->validate([
            'room_type' => 'required|string|max:255',
            'single_price' => 'nullable|numeric',
            'double_price' => 'nullable|numeric',
            'extra_bed' => 'nullable|numeric',
            'inclusions' => 'required|array|min:1',
            'currency' => 'required|string|in:USD,NPR',
            'sort_order' => 'nullable|integer',
        ]);

        $rate->update($data);
        return redirect()->route('rates-table.index')->with('success', 'Rate updated successfully!');
    }

    public function destroy(RatesTable $rate)
    {
        $rate->delete();
        return redirect()->route('rates-table.index')->with('success', 'Rate deleted successfully!');
    }
}
