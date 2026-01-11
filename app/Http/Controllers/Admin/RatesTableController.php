<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RatesTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatesTableController extends Controller
{
    /**
     * Display a listing of the rates.
     */
    public function index()
    {
        // Ordering by sort_order first, then by the latest created
        $rates = RatesTable::orderBy('id', 'asc')
            ->get();

        return view('admin.rates-table.index', compact('rates'));
    }

    /**
     * Show the form for creating a new rate.
     */
    public function create()
    {
        $rate = new RatesTable();
        // Default currency for new records
        $rate->currency = 'USD'; 
        return view('admin.rates-table.form', compact('rate'));
    }

    /**
     * Store a newly created rate in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        // Logic to set the next sort order automatically if not provided
        if (!$request->filled('sort_order')) {
            $data['sort_order'] = RatesTable::max('sort_order') + 1;
        }

        RatesTable::create($data);

        return redirect()
            ->route('rates-table.index')
            ->with('success', 'Room rate for "' . $request->room_type . '" has been added successfully!');
    }

    /**
     * Show the form for editing the specified rate.
     */
    public function edit($id)
{
    // Use findOrFail to ensure we get a 404 if the ID is wrong
    $rate = RatesTable::findOrFail($id);
    return view('admin.rates-table.form', compact('rate'));
}

    /**
     * Update the specified rate in storage.
     */
    public function update(Request $request, $id)
{
    $rate = RatesTable::findOrFail($id);

    $data = $request->validate([
        'room_type'    => 'required|string|max:255',
        'single_price' => 'nullable|numeric',
        'double_price' => 'nullable|numeric',
        'extra_bed'    => 'nullable|numeric',
        'inclusions'   => 'required|array|min:1',
        'currency'     => 'required|string|in:USD,NPR',
        'sort_order'   => 'nullable|integer',
    ]);

    $rate->update($data);
    return redirect()->route('rates-table.index')->with('success', 'Rate updated successfully!');
}

    /**
     * Remove the specified rate from storage.
     */
    public function destroy($id)
    {
        $rate = RatesTable::findOrFail($id);
        $type = $rate->room_type;
        $rate->delete();

        return redirect()->route('rates-table.index')
            ->with('success', 'Rate category "' . $type . '" deleted successfully.');
    }
    /**
     * Centralized validation logic to avoid repetition.
     */
    protected function validateRequest(Request $request)
    {
        return $request->validate([
            'room_type'    => 'required|string|max:255',
            'single_price' => 'nullable|numeric|min:0',
            'double_price' => 'nullable|numeric|min:0',
            'extra_bed'    => 'nullable|numeric|min:0',
            'currency'     => 'required|string|in:USD,NPR',
            'sort_order'   => 'nullable|integer|min:0',
            // Ensure we filter out any empty strings from the dynamic items
            'inclusions'   => 'required|array|min:1',
            'inclusions.*' => 'required|string|distinct|max:255',
        ], [
            'inclusions.*.required' => 'The inclusion item cannot be empty.',
            'inclusions.min' => 'Please provide at least one inclusion.',
        ]);
    }
}