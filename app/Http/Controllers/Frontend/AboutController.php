<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutHero;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $hero = AboutHero::where('status', true)->orderBy('sort_order')->first();

        return view('frontend.pages.about', compact('hero'));
    }
}
