<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccommodationHero;
use App\Models\AccommodationHeader;
use App\Models\Room;
use App\Models\AccommodationHighlight;
use App\Models\AccommodationHighlightPic;

class AccommodationController extends Controller
{
    public function index()
    {
        $hero = AccommodationHero::where('status', true)->latest()->first();

        $header = AccommodationHeader::where('status', true)->latest()->first();

        $rooms = Room::all();

        $highlights = AccommodationHighlight::where('status', true)->orderBy('sort_order')->get();

        $pics = AccommodationHighlightPic::where('status', true)->orderBy('sort_order')->get();

        return view('frontend.pages.accommodation', compact('hero', 'header', 'rooms', 'highlights', 'pics'));
    }
}
