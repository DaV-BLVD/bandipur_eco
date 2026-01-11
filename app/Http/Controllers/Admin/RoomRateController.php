<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomRateController extends Controller
{
    public function index()
    {
        $rates = RoomRate::orderBy('sort_order')->get();
        return view('admin.room-rates.index', compact('rates'));
    }

    public function create()
    {
        return view('admin.room-rates.form');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('room-rates', 'public');
        }

        $data['features'] = array_values(array_filter($request->features ?? []));

        RoomRate::create($data);

        return redirect()->route('room-rates.index')->with('success', 'Room added.');
    }

    public function edit(RoomRate $roomRate)
    {
        return view('admin.room-rates.form', compact('roomRate'));
    }

    public function update(Request $request, RoomRate $roomRate)
    {
        $data = $this->validateData($request, false);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($roomRate->image);
            $data['image'] = $request->file('image')->store('room-rates', 'public');
        }

        $data['features'] = array_values(array_filter($request->features ?? []));

        $roomRate->update($data);

        return redirect()->route('room-rates.index')->with('success', 'Room updated.');
    }

    public function destroy(RoomRate $roomRate)
    {
        Storage::disk('public')->delete($roomRate->image);
        $roomRate->delete();

        return back()->with('success', 'Room deleted.');
    }

    private function validateData(Request $request, $imageRequired = true)
    {
        return $request->validate([
            'badge' => 'nullable|string',
            'title' => 'required|string',
            'tag' => 'nullable|string',
            'image' => $imageRequired ? 'required|image' : 'nullable|image',
            'price' => 'required|numeric',
            'currency' => 'required|string|max:3',
            'rating' => 'required|integer|min:1|max:5',
            'reviews' => 'required|integer',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
    }
}
