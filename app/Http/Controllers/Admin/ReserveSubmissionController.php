<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReserveSubmission;

class ReserveSubmissionController extends Controller
{
    public function index()
    {
        $reservations = ReserveSubmission::latest()->get();
        return view('admin.reserve-submissions.index', compact('reservations'));
    }

    public function show(ReserveSubmission $reserveSubmission)
    {
        $reserveSubmission->update(['is_read' => true]);

        return view('admin.reserve-submissions.show', compact('reserveSubmission'));
    }

    public function destroy(ReserveSubmission $reserveSubmission)
    {
        $reserveSubmission->delete();

        return redirect()->route('reserve-submissions.index')->with('success', 'Reservation deleted.');
    }

    public function markAsRead(ReserveSubmission $reserveSubmission)
    {
        $reserveSubmission->update(['is_read' => true]);
        return redirect()->back()->with('success', 'Reservation marked as read.');
    }

    public function markAsUnread(ReserveSubmission $reserveSubmission)
    {
        $reserveSubmission->update(['is_read' => false]);
        return redirect()->back()->with('success', 'Reservation marked as unread.');
    }
}
