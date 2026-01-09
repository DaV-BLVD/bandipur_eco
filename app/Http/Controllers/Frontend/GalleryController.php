<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GalleryHero;

class GalleryController extends Controller
{
    public function index()
    {
        $hero = GalleryHero::where('is_active', true)->latest()->first();
        
        return view('frontend.pages.gallery', compact('hero'));
    }
}
