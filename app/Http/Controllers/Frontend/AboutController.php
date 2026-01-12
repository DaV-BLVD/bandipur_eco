<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutHero;
use App\Models\AboutHeader;
use App\Models\WhoWeArePhoto;
use App\Models\WhoWeAreContent;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $hero = AboutHero::where('status', true)->orderBy('sort_order')->first();

        $header = AboutHeader::where('status', true)->orderBy('sort_order')->first();

        $photos = WhoWeArePhoto::where('status', true)->orderBy('sort_order')->get();

        $whoWeAre = WhoWeAreContent::where('status', 1)->latest()->first();

        return view('frontend.pages.about', compact('hero', 'header', 'photos', 'whoWeAre'));
    }
}
