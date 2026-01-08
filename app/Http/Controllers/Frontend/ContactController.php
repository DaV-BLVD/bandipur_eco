<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactHero;
use App\Models\ContactHeader;

class ContactController extends Controller
{
    public function index()
    {
        $hero = ContactHero::where('is_active', true)->latest()->first();

        $header = ContactHeader::where('is_active', true)->latest()->first();

        return view('frontend.pages.contact', compact('hero', 'header'));
    }
}
