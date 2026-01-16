<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ReserveSubmission;
use Illuminate\Http\Request;
use App\Mail\ReserveSubmissionMail;
use Illuminate\Support\Facades\Mail;

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

        $to = 'aaryandangol.g@gmail.com';
        $subject = '🏨 New Booking: ' . $data['full_name'];

        // 4. Send using the new ReserveSubmissionMail
        Mail::to($to)->send(new ReserveSubmissionMail($data, $subject));

        return back()->with('success', 'Your reservation request has been submitted.');
    }
}
