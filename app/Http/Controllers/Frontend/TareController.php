<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RateHeader;

class TareController extends Controller
{
    public function index()
    {
        $rateHeader = RateHeader::where('is_active', true)->latest()->first();

        return view('frontend.pages.tare', compact('rateHeader'));
    }
}
