<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactHero;
use App\Models\ContactHeader;
use App\Models\ContactInfo;

class ContactController extends Controller
{
    public function index()
    {
        $hero = ContactHero::where('is_active', true)->latest()->first();

        $header = ContactHeader::where('is_active', true)->latest()->first();

        $contactInfos = ContactInfo::where('is_active', 1)
            ->orderBy('id')
            ->get();

        return view('frontend.pages.contact', compact('hero', 'header', 'contactInfos'));
    }
}
