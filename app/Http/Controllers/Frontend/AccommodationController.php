<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccommodationHero;

class AccommodationController extends Controller
{
    public function index()
    {
        $hero = AccommodationHero::where('status', true)->latest()->first();

        return view('frontend.pages.accommodation', compact('hero'));
    }
}
