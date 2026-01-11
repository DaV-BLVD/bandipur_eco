<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RateHeader;
use App\Models\RoomRate;
use App\Models\RatesHero;
use App\Models\RatesTable;

class TareController extends Controller
{
    public function index()
    {
        $rateHeader = RateHeader::where('is_active', true)->latest()->first();

        $roomRates = RoomRate::where('is_active', true)->orderBy('sort_order')->get();

        $hero = RatesHero::latest()->first();

        $rates = RatesTable::orderBy('sort_order')->get();

        return view('frontend.pages.tare', compact('rateHeader', 'roomRates', 'hero', 'rates'));
    }
}
