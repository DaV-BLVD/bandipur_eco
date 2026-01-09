<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ReserveSubmission;
use Illuminate\Http\Request;

class ReserveSubmissionController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|string|max:50',
            'room_type' => 'required|string|max:100',
            'full_name' => 'required|string|max:150',
            'phone' => 'required|string|max:30',
        ]);

        ReserveSubmission::create($data);

        return back()->with('success', 'Your reservation request has been submitted.');
    }
}
