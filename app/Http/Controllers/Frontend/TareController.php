<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RateHeader;
use App\Models\RoomRate;
use App\Models\RatesHero;
use App\Models\RatesTable;
use App\Models\ExclusiveSpecialOffer;
use App\Models\ImportantInfo;

class TareController extends Controller
{
    public function index()
    {
        $rateHeader = RateHeader::where('is_active', true)->latest()->first();

        $roomRates = RoomRate::where('is_active', true)->orderBy('sort_order')->get();

        $hero = RatesHero::latest()->first();

        $rates = RatesTable::orderBy('sort_order')->get();

        $offers = ExclusiveSpecialOffer::where('status', true)->orderBy('created_at', 'desc')->get();

        $infos = ImportantInfo::where('status', true)->orderBy('id', 'asc')->get();

        return view('frontend.pages.tare', compact('rateHeader', 'roomRates', 'hero', 'rates', 'offers', 'infos'));
    }
}
