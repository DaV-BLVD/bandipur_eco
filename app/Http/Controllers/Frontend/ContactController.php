<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactHero;
use App\Models\ContactHeader;
use App\Models\ContactInfo;
use App\Models\ContactSubmission;

class ContactController extends Controller
{
    public function index()
    {
        $hero = ContactHero::where('is_active', true)->latest()->first();

        $header = ContactHeader::where('is_active', true)->latest()->first();

        $contactInfos = ContactInfo::where('is_active', 1)->orderBy('id')->get();

        return view('frontend.pages.contact', compact('hero', 'header', 'contactInfos'));
    }

    // Handle form submission
    public function submit(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        // Save to database
        ContactSubmission::create($data);

        // Return JSON response for AJAX
        return response()->json([
            'success' => true,
            'message' => 'Your message has been sent successfully!',
        ]);
    }
}
