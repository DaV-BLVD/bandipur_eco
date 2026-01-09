<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactSubmissionController extends Controller
{
    public function index()
    {
        // Sort by newest first and unread first
        $submissions = ContactSubmission::orderBy('is_read', 'asc')->latest()->paginate(15);
        return view('admin.contact-submissions.index', compact('submissions'));
    }

    public function show(ContactSubmission $contactSubmission)
    {
        // Automatically mark as read when viewed
        if (!$contactSubmission->is_read) {
            $contactSubmission->update(['is_read' => true]);
        }
        return view('admin.contact-submissions.show', compact('contactSubmission'));
    }

    public function destroy(ContactSubmission $contactSubmission)
    {
        $contactSubmission->delete();
        return redirect()->route('contact-submissions.index')->with('success', 'Submission deleted successfully.');
    }

    public function markAsRead(ContactSubmission $contactSubmission)
    {
        $contactSubmission->update(['is_read' => true]);
        return redirect()->back()->with('success', 'Message marked as read.');
    }

    public function markAsUnread(ContactSubmission $contactSubmission)
    {
        $contactSubmission->update(['is_read' => false]);
        return redirect()->back()->with('success', 'Message marked as unread.');
    }
}
