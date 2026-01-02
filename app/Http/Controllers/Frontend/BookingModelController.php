<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingModelController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $validated = $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|string',
            'room_type' => 'required|string',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        // 2. Logic (Save to DB or Send Email)
        // Example: Booking::create($validated);

        // 3. Redirect back with a success message
        return back()->with('success', 'Thank you! We have received your request. We will contact you shortly.');
    }
}
