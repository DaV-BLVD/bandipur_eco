@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-full mx-auto space-y-8">

        {{-- 1. Dashboard Header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-black tracking-tight flex items-center">
                    <i class="fas fa-chart-line mr-4 text-primary opacity-90"></i>
                    Dashboard Overview
                </h1>
                <p class="text-gray-500 mt-1">
                    Welcome back, <span class="font-bold text-black">{{ auth()->user()->name }}</span>! Here is your website
                    status.
                </p>
            </div>

            <div class="flex items-center space-x-3">
                <div
                    class="text-sm text-gray-600 bg-white px-5 py-2.5 rounded-xl shadow-sm border border-gray-100 font-bold uppercase tracking-wider flex items-center">
                    <i class="fa-regular fa-calendar-check mr-2 text-primary"></i>
                    {{ now()->format('D, M d, Y') }}
                </div>
            </div>
        </div>

        {{-- 2. Stats Summary Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $stats = [
                    [
                        'label' => 'Total Slides',
                        'value' => \App\Models\HomeHeroSlider::count(),
                        'icon' => 'fa-images',
                        'color' => 'bg-blue-500',
                    ],
                    [
                        'label' => 'Active Rooms',
                        'value' => \App\Models\Room::count(),
                        'icon' => 'fa-bed',
                        'color' => 'bg-emerald-500',
                    ],
                    [
                        'label' => 'Gallery Items',
                        'value' => \App\Models\GalleryContent::count(),
                        'icon' => 'fa-photo-film',
                        'color' => 'bg-amber-500',
                    ],
                    [
                        'label' => 'Pending Inquiries',
                        'value' => '0',
                        'icon' => 'fa-paper-plane',
                        'color' => 'bg-primary',
                    ],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4 hover:shadow-md transition-shadow">
                    <div
                        class="{{ $stat['color'] }} w-12 h-12 rounded-xl flex items-center justify-center text-white shadow-lg shadow-gray-100">
                        <i class="fas {{ $stat['icon'] }} text-xl"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $stat['label'] }}</p>
                        <h3 class="text-2xl font-black text-black">{{ $stat['value'] }}</h3>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- 3. Content Management Shortcuts --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Quick Links --}}
            <div class="lg:col-span-2 space-y-4">
                <h2 class="text-lg font-bold text-black flex items-center uppercase tracking-wider">
                    <i class="fas fa-rocket mr-2 text-primary"></i>
                    Quick Management
                </h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @php
                        $quickLinks = [
                            ['title' => 'Sliders', 'route' => 'home-hero-slider.index', 'icon' => 'fa-images'],
                            ['title' => 'Rooms', 'route' => 'rooms.index', 'icon' => 'fa-door-open'],
                            ['title' => 'Rates', 'route' => 'room-rates.index', 'icon' => 'fa-file-invoice-dollar'],
                            ['title' => 'Gallery', 'route' => 'gallery-contents.index', 'icon' => 'fa-photo-film'],
                            ['title' => 'FAQ', 'route' => 'faqs.index', 'icon' => 'fa-circle-question'],
                            ['title' => 'Contact', 'route' => 'contact-info.index', 'icon' => 'fa-address-book'],
                        ];
                    @endphp

                    @foreach ($quickLinks as $link)
                        <a href="{{ route($link['route']) }}"
                            class="group bg-white p-4 rounded-2xl border border-gray-100 shadow-sm hover:border-primary hover:shadow-lg transition-all text-center">
                            <div class="text-gray-400 group-hover:text-primary transition-colors mb-2">
                                <i class="fas {{ $link['icon'] }} text-2xl"></i>
                            </div>
                            <span class="text-sm font-bold text-gray-700 group-hover:text-black">{{ $link['title'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- System Status --}}
            <div class="space-y-4">
                <h2 class="text-lg font-bold text-black flex items-center uppercase tracking-wider">
                    <i class="fas fa-shield-halved mr-2 text-primary"></i>
                    System Info
                </h2>
                <div class="bg-black rounded-2xl p-6 text-white shadow-xl relative overflow-hidden">
                    {{-- Decorative Icon --}}
                    <i class="fas fa-server absolute -right-4 -bottom-4 text-white/10 text-8xl"></i>

                    <div class="relative z-10 space-y-4">
                        <div class="flex justify-between items-center border-b border-white/10 pb-2">
                            <span class="text-gray-400 text-xs font-bold uppercase">Laravel Version</span>
                            <span class="font-mono text-sm">v{{ App::version() }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-white/10 pb-2">
                            <span class="text-gray-400 text-xs font-bold uppercase">PHP Version</span>
                            <span class="font-mono text-sm">{{ PHP_VERSION }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-white/10 pb-2">
                            <span class="text-gray-400 text-xs font-bold uppercase">Environment</span>
                            <span
                                class="px-2 py-0.5 bg-primary rounded text-[10px] font-black uppercase">{{ app()->environment() }}</span>
                        </div>
                        <div class="pt-2">
                            <p class="text-[10px] text-gray-400 uppercase font-bold mb-2 tracking-widest">Storage Status</p>
                            <div class="w-full bg-white/10 rounded-full h-1.5">
                                <div class="bg-primary h-1.5 rounded-full" style="width: 45%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
