<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::orderBy('id', 'asc')->get();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.form'); // Reusing the form view
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        Room::create($data);
        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.form', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $data = $this->validateRequest($request);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $data['image'] = $request->file('image')->store('rooms', 'public');
        }

        $room->update($data);
        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        if ($room->image) {
            Storage::disk('public')->delete($room->image);
        }
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted.');
    }

    private function validateRequest($request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:single,double,others',
            'badge_text' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Required on create, optional on update logic handled in controller usually, but simplistic here
            'description' => 'required|string',
            'occupancy' => 'required|string',
            'bed_type' => 'required|string',
            'has_wifi' => 'boolean',
            'currency' => 'required|in:USD,NPR',
            'price' => 'required|numeric',
        ]);
    }
}
