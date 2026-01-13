<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactInfo;
use App\Models\HomeLocationContent;
use App\Models\MapLocation;
use App\Models\HomeImagesGrid;
use App\Models\HomeHighlightTwo;
use App\Models\HomeFeature;
use App\Models\HomeHighlightOne;
use App\Models\HomeTaste;
use App\Models\Room;
use App\Models\HomeHeroSlider;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phone = ContactInfo::where('is_active', true)->value('value'); // gets JSON column only        $firstPhone = $contactInfo?->value[0] ?? null;
        $firstPhone = $phone[0] ?? null;

        $locationContent = HomeLocationContent::first();

        $mapLocation = MapLocation::where('is_active', true)->latest()->first();

        $images = HomeImagesGrid::orderBy('position')->get();

        $highlightTwo = HomeHighlightTwo::with('items')->first();

        $features = HomeFeature::orderBy('order')->get();

        $highlightOne = HomeHighlightOne::first();

        $homeTaste = HomeTaste::with('items')->first();

        $rooms = Room::take(3)->get();

        $heroSlides = HomeHeroSlider::where('is_active', true)->orderBy('sort_order', 'asc')->get();

        $socialLinks = \App\Models\SocialLink::where('is_active', true)->get();

        return view('frontend.pages.home', compact('firstPhone', 'locationContent', 'mapLocation', 'images', 'highlightTwo', 'features', 'highlightOne', 'homeTaste', 'rooms', 'heroSlides', 'socialLinks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
