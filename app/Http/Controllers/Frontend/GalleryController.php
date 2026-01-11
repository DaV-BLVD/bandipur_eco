<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GalleryHero;
use App\Models\GalleryHeader;
use App\Models\GalleryContent;

class GalleryController extends Controller
{
    public function index()
    {
        $hero = GalleryHero::where('is_active', true)->latest()->first();

        $header = GalleryHeader::where('is_active', true)->latest()->first();

        $galleryItems = GalleryContent::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function ($item) {
                return [
                    'src' => asset('storage/' . $item->image),
                    'category' => $item->category,
                    'title' => $item->title,
                ];
            });
        return view('frontend.pages.gallery', compact('hero', 'header', 'galleryItems'));
    }
}
