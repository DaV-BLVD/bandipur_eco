<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactHero;
use App\Models\ContactHeader;
use App\Models\ContactInfo;
use App\Models\ContactSubmission;
use App\Models\MapLocation;
use App\Models\Faq;
use App\Mail\WelcomeMail; // Make sure this is here
use Illuminate\Support\Facades\Mail; // IMPORTANT: Add this!

class ContactController extends Controller
{
    public function index()
    {
        $hero = ContactHero::where('is_active', true)->latest()->first();

        $header = ContactHeader::where('is_active', true)->latest()->first();

        $contactInfos = ContactInfo::where('is_active', 1)->orderBy('id')->get();

        $mapLocation = MapLocation::where('is_active', true)->latest()->first();

        $faqs = Faq::where('is_active', true)->get();

        return view('frontend.pages.contact', compact('hero', 'header', 'contactInfos', 'mapLocation', 'faqs'));
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

        // 1. Save to database
        ContactSubmission::create($data);

        // 2. Define the missing variables
        $to = 'aaryandangol.g@gmail.com';
        $subject = 'New Inquiry from ' . $data['name'];

        // 3. Send the Mail (Passing the whole $data array)
        Mail::to($to)->send(new WelcomeMail($data, $subject));

        return response()->json([
            'success' => true,
            'message' => 'Your message has been sent successfully!',
        ]);
    }
}
