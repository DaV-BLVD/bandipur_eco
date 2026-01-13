@extends('frontend.app')

@section('content')
    @push('style')
        {{-- carousel --}}
        <style>
            /* Carousel Slide Transitions - No White Flash */
            .carousel-slide {
                position: absolute;
                inset: 0;
                opacity: 0;
                z-index: 0;
                visibility: hidden;
                transition: opacity 1.2s ease-in-out, visibility 1.2s;
            }

            .carousel-slide.active {
                opacity: 1;
                z-index: 1;
                visibility: visible;
            }

            .carousel-slide.prev {
                opacity: 1;
                z-index: 0;
                visibility: visible;
            }

            /* Ken Burns Effect for Images */
            .slide-image {
                transition: transform 8s ease-out;
                transform: scale(1);
            }

            .carousel-slide.active .slide-image {
                transform: scale(1.1);
            }

            /* Text Animations */
            .carousel-slide.active .text-reveal-1 {
                animation: fadeInDown 0.8s ease-out 0.3s forwards;
                opacity: 0;
            }

            .carousel-slide.active .text-reveal-2 {
                animation: fadeInUp 0.8s ease-out 0.5s forwards;
                opacity: 0;
            }

            .carousel-slide.active .text-reveal-3 {
                animation: fadeInUp 0.8s ease-out 0.7s forwards;
                opacity: 0;
            }

            .carousel-slide.active .text-reveal-4 {
                animation: scaleIn 0.8s ease-out 0.9s forwards;
                opacity: 0;
            }

            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translateY(-40px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(40px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes scaleIn {
                from {
                    opacity: 0;
                    transform: scale(0.8);
                }

                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            /* Progress Bar Animation */
            @keyframes progressBar {
                from {
                    width: 0%;
                }

                to {
                    width: 100%;
                }
            }

            .progress-active {
                animation: progressBar 6s linear forwards;
            }

            /* Scroll Bounce */
            @keyframes scrollBounce {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(10px);
                }
            }

            .scroll-indicator {
                animation: scrollBounce 2s ease-in-out infinite;
            }

            /* Button Glow */
            @keyframes pulseGlow {

                0%,
                100% {
                    box-shadow: 0 0 20px rgba(109, 109, 24, 0.4);
                }

                50% {
                    box-shadow: 0 0 40px rgba(109, 109, 24, 0.7);
                }
            }

            .animate-glow {
                animation: pulseGlow 2s ease-in-out infinite;
            }

            /* Overlay gradient for better text readability */
            .image-overlay {
                background: linear-gradient(to bottom,
                        rgba(0, 0, 0, 0.5) 0%,
                        rgba(0, 0, 0, 0.3) 40%,
                        rgba(0, 0, 0, 0.4) 60%,
                        rgba(0, 0, 0, 0.7) 100%);
            }

            .image-overlay-side {
                background: linear-gradient(to right,
                        rgba(0, 0, 0, 0.4) 0%,
                        transparent 50%,
                        rgba(0, 0, 0, 0.4) 100%);
            }
        </style>

        {{-- main --}}
        <style>
            /* Custom Scroll Reveal Animation */
            .reveal {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
            }

            .reveal.active {
                opacity: 1;
                transform: translateY(0);
            }

            .delay-100 {
                transition-delay: 100ms;
            }

            .delay-200 {
                transition-delay: 200ms;
            }

            .delay-300 {
                transition-delay: 300ms;
            }
        </style>
    @endpush
    <title>Home | Bandipur</title>
    {{-- hero section --}}
    <div id="hero-wrapper" class="sticky top-0 h-screen w-full overflow-hidden z-0 bg-black">
        <div class="" id='hero-bg'>
            <!-- Hero Section with Loop Carousel -->
            <section id="hero" class="relative w-full h-screen overflow-hidden bg-black">

                <!-- Carousel Container -->
                <div id="carousel" class="relative w-full h-full bg-black">

                    <!-- Slide 1 -->
                    <div class="carousel-slide active" data-slide="0">
                        <!-- Image -->
                        <div class="slide-image absolute inset-0 w-full h-full">
                            <img src="{{ asset('frontendimages/hotel_entrance.png') }}" alt="Resort Pool View"
                                class="w-full h-full object-cover" />
                        </div>
                        <!-- Overlays -->
                        <div class="image-overlay absolute inset-0"></div>
                        <div class="image-overlay-side absolute inset-0"></div>

                        <!-- Content -->
                        <div class="relative z-10 h-full flex flex-col justify-center items-center text-center px-4 sm:px-6 lg:px-8"
                            id='hero-text'>

                            <span
                                class="text-reveal-1 text-white px-5 py-1 rounded-full bg-[#6d6d18] font-semibold tracking-[0.3em] uppercase text-sm sm:text-base mb-4">
                                Welcome to Paradise
                            </span>
                            <h1
                                class="text-reveal-2 text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                                Our <span class="text-[#6d6d18]">Story</span> Begins<br class="hidden sm:block"> With
                                Nature
                            </h1>
                            <p
                                class="text-reveal-3 text-gray-300 text-base sm:text-lg md:text-xl max-w-2xl mb-8 leading-relaxed">
                                Nestled in the heart of untouched wilderness, our resort offers an escape
                                into serenity where luxury meets the natural world.
                            </p>
                            <a href="{{ url('about') }}"
                                class="text-reveal-4 group relative inline-flex items-center gap-2 bg-[#6d6d18] hover:bg-[#6d6d18]/90 text-white font-semibold py-3 px-8 sm:py-4 sm:px-10 rounded-full transition-all duration-300 animate-glow">
                                <span>Discover Our Journey</span>

                                <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-slide" data-slide="1">
                        <!-- Image -->
                        <div class="slide-image absolute inset-0 w-full h-full">
                            <img src="{{ asset('frontendimages/cusin.png') }}" alt="Resort Lobby"
                                class="w-full h-full object-cover" />
                        </div>
                        <!-- Overlays -->
                        <div class="image-overlay absolute inset-0"></div>
                        <div class="image-overlay-side absolute inset-0"></div>

                        <!-- Content -->
                        <div class="relative z-10 h-full flex flex-col justify-center items-center text-center px-4 sm:px-6 lg:px-8"
                            id='hero-text'>
                            <span
                                class="text-reveal-1 text-white px-5 py-1 rounded-full bg-[#0a7c15] font-semibold tracking-[0.3em] uppercase text-sm sm:text-base mb-4">
                                Since 1995
                            </span>
                            <h1
                                class="text-reveal-2 text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                                Three Decades of<br class="hidden sm:block"> <span class="text-[#0a7c15]">Excellence</span>
                            </h1>
                            <p
                                class="text-reveal-3 text-gray-300 text-base sm:text-lg md:text-xl max-w-2xl mb-8 leading-relaxed">
                                For over 30 years, we have been crafting unforgettable experiences,
                                blending traditional hospitality with modern luxury.
                            </p>
                            <a href="{{ url('gallery') }}"
                                class="text-reveal-4 group relative inline-flex items-center gap-2 bg-[#0a7c15] hover:bg-[#0a7c15]/90 text-white font-semibold py-3 px-8 sm:py-4 sm:px-10 rounded-full transition-all duration-300">
                                <span>Explore Our History</span>
                                <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="carousel-slide" data-slide="2">
                        <!-- Image -->
                        <div class="slide-image absolute inset-0 w-full h-full">
                            <img src="{{ asset('frontendimages/way_to_room.png') }}" alt="Resort Garden"
                                class="w-full h-full object-cover" />
                        </div>
                        <!-- Overlays -->
                        <div class="image-overlay absolute inset-0"></div>
                        <div class="image-overlay-side absolute inset-0"></div>

                        <!-- Content -->
                        <div class="relative z-10 h-full flex flex-col justify-center items-center text-center px-4 sm:px-6 lg:px-8"
                            id='hero-text'>
                            <span
                                class="text-reveal-1 text-white px-5 py-1 rounded-full bg-[#6d6d18] font-semibold tracking-[0.3em] uppercase text-sm sm:text-base mb-4">
                                Our Philosophy
                            </span>
                            <h1
                                class="text-reveal-2 text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                                Sustainable <span class="text-[#6d6d18]">Luxury</span><br class="hidden sm:block">
                                Redefined
                            </h1>
                            <p
                                class="text-reveal-3 text-gray-300 text-base sm:text-lg md:text-xl max-w-2xl mb-8 leading-relaxed">
                                We believe in preserving the beauty that surrounds us. Every element of our resort
                                is designed with sustainability and eco-consciousness at its core.
                            </p>
                            <a href="{{ url('about') }}"
                                class="text-reveal-4 group relative inline-flex items-center gap-2 border-2 border-[#6d6d18] hover:bg-[#6d6d18] text-white font-semibold py-3 px-8 sm:py-4 sm:px-10 rounded-full transition-all duration-300">
                                <span>Our Values</span>
                                <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="carousel-slide" data-slide="3">
                        <!-- Image -->
                        <div class="slide-image absolute inset-0 w-full h-full">
                            <img src="{{ asset('frontendimages/rooms/double.png') }}" alt="Resort Beach"
                                class="w-full h-full object-cover" />
                        </div>
                        <!-- Overlays -->
                        <div class="image-overlay absolute inset-0"></div>
                        <div class="image-overlay-side absolute inset-0"></div>

                        <!-- Content -->
                        <div class="relative z-10 h-full flex flex-col justify-center items-center text-center px-4 sm:px-6 lg:px-8"
                            id='hero-text' f>
                            <span
                                class="text-reveal-1 text-white px-5 py-1 rounded-full bg-[#0a7c15] font-semibold tracking-[0.3em] uppercase text-sm sm:text-base mb-4">
                                Meet The Team
                            </span>
                            <h1
                                class="text-reveal-2 text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                                Passionate <span class="text-[#0a7c15]">People</span><br class="hidden sm:block">
                                Extraordinary
                                Service
                            </h1>
                            <p
                                class="text-reveal-3 text-gray-300 text-base sm:text-lg md:text-xl max-w-2xl mb-8 leading-relaxed">
                                Behind every memorable stay is a dedicated team committed to exceeding
                                your expectations and creating moments that last a lifetime.
                            </p>
                            <a href="{{ url('accommodation') }}"
                                class="text-reveal-4 group relative inline-flex items-center gap-2 bg-[#0a7c15] hover:bg-[#0a7c15]/90 text-white font-semibold py-3 px-8 sm:py-4 sm:px-10 rounded-full transition-all duration-300">
                                <span>Meet Our Team</span>
                                <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Navigation Arrows -->
                <button id="prevBtn" class="absolute left-4 sm:left-8 top-1/2 -translate-y-1/2 z-20 group cursor-pointer">
                    <div
                        class="w-8 h-8 sm:w-14 sm:h-14 rounded-full border-2 border-white/30 hover:border-[#6d6d18] hover:bg-[#6d6d18]/20 flex items-center justify-center transition-all duration-300 backdrop-blur-sm">
                        <i
                            class="fa-solid fa-angle-left sm:text-xl text-white group-hover:text-[#6d6d18] transition-colors"></i>
                    </div>
                </button>

                <button id="nextBtn"
                    class="absolute right-4 sm:right-8 top-1/2 -translate-y-1/2 z-20 group cursor-pointer">
                    <div
                        class="w-8 h-8 sm:w-14 sm:h-14 rounded-full border-2 border-white/30 hover:border-[#6d6d18] hover:bg-[#6d6d18]/20 flex items-center justify-center transition-all duration-300 backdrop-blur-sm">
                        <i
                            class="fa-solid fa-angle-right sm:text-xl text-white group-hover:text-[#6d6d18] transition-colors"></i>
                    </div>
                </button>

                <!-- Slide Indicators with Progress -->
                <div class="absolute bottom-24 sm:bottom-28 left-1/2 -translate-x-1/2 z-20 flex items-center gap-3">
                    <button
                        class="slide-dot group relative w-12 sm:w-16 h-1 rounded-full overflow-hidden bg-white/30 transition-all duration-300 cursor-pointer"
                        data-index="0">
                        <span class="progress-bar absolute inset-0 bg-[#6d6d18] rounded-full origin-left"
                            style="width: 0%;"></span>
                    </button>
                    <button
                        class="slide-dot group relative w-12 sm:w-16 h-1 rounded-full overflow-hidden bg-white/30 transition-all duration-300 cursor-pointer"
                        data-index="1">
                        <span class="progress-bar absolute inset-0 bg-[#6d6d18] rounded-full origin-left"
                            style="width: 0%;"></span>
                    </button>
                    <button
                        class="slide-dot group relative w-12 sm:w-16 h-1 rounded-full overflow-hidden bg-white/30 transition-all duration-300 cursor-pointer"
                        data-index="2">
                        <span class="progress-bar absolute inset-0 bg-[#6d6d18] rounded-full origin-left"
                            style="width: 0%;"></span>
                    </button>
                    <button
                        class="slide-dot group relative w-12 sm:w-16 h-1 rounded-full overflow-hidden bg-white/30 transition-all duration-300 cursor-pointer"
                        data-index="3">
                        <span class="progress-bar absolute inset-0 bg-[#6d6d18] rounded-full origin-left"
                            style="width: 0%;"></span>
                    </button>
                </div>

                <!-- Slide Counter -->
                <div
                    class="absolute bottom-24 sm:bottom-28 right-4 sm:right-8 z-20 flex items-center gap-2 text-white font-medium">
                    <span id="currentSlide" class="text-2xl sm:text-3xl text-[#6d6d18] font-light">01</span>
                    <span class="text-white/30">/</span>
                    <span class="text-sm sm:text-base text-white/50">04</span>
                </div>

                <!-- Scroll Down Indicator -->
                <div
                    class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 scroll-indicator pointer-events-auto cursor-pointer">
                    <a href='#about' class="flex flex-col items-center gap-2 text-white/70">
                        <span class="text-xs uppercase tracking-widest hidden sm:block">Scroll</span>
                        <div class=" flex justify-center pt-2 text-center">
                            <i class='fa-solid fa-angles-down animate-pulse text-xl'></i>
                        </div>
                    </a>
                </div>

                <!-- Social Links - Desktop -->
                <div class="hidden lg:flex absolute left-40 top-1/2 -translate-y-1/2 z-20 flex-col items-center gap-4">
                    <div class="w-px h-12 bg-gradient-to-b from-transparent to-white/30"></div>
                    <a href="#"
                        class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white/70 hover:text-[#6d6d18] hover:border-[#6d6d18] transition-all duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white/70 hover:text-[#6d6d18] hover:border-[#6d6d18] transition-all duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center text-white/70 hover:text-[#6d6d18] hover:border-[#6d6d18] transition-all duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                        </svg>
                    </a>
                    <div class="w-px h-12 bg-gradient-to-b from-white/30 to-transparent"></div>
                </div>

            </section>
        </div>
    </div>

    {{-- just for id --}}
    <section id="about" class="p-10"></section>

    <main class="relative z-10 bg-white shadow-[0_-20px_60px_rgba(0,0,0,0.2)]">

        <section class="py-28 px-4 bg-white">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="text-[#6d6d18] uppercase tracking-[0.3em] text-sm font-bold mb-6 reveal">
                    Namaste & Welcome
                </h2>
                <h3 class="text-4xl md:text-6xl font-serif text-gray-900 mb-8 leading-tight reveal delay-100">
                    Preserving Culture, Protecting Nature
                </h3>
                <p class="text-gray-600 leading-relaxed text-lg mb-16 max-w-3xl mx-auto reveal delay-200">
                    Located in the living museum of Bandipur, Nepal, our resort is more than a destination. We provide a
                    sustainable gateway to the Annapurna range, built with traditional brick and wood by local artisans.
                    Every stay supports our mission to preserve the heritage of Tanahun.
                </p>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 reveal delay-300">
                    <div class="group flex flex-col items-center">
                        <div
                            class="w-16 h-16 flex items-center justify-center rounded-full bg-[#6d6d18]/10 text-[#6d6d18] mb-4 group-hover:bg-[#6d6d18] group-hover:text-white transition-all duration-500">
                            <i class='fa-solid fa-hotel text-4xl'></i>
                        </div>
                        <span
                            class="text-xs uppercase font-bold tracking-widest text-gray-500 group-hover:text-[#6d6d18]">Hotel
                            Teller</span>
                    </div>
                    <div class="group flex flex-col items-center">
                        <div
                            class="w-16 h-16 flex items-center justify-center rounded-full bg-[#6d6d18]/10 text-[#6d6d18] mb-4 group-hover:bg-[#6d6d18] group-hover:text-white transition-all duration-500">
                            <i class='fa-solid fa-car text-3xl'></i>
                        </div>
                        <span
                            class="text-xs uppercase font-bold tracking-widest text-gray-500 group-hover:text-[#6d6d18]">Car
                            Parking</span>
                    </div>
                    <div class="group flex flex-col items-center">
                        <div
                            class="w-16 h-16 flex items-center justify-center rounded-full bg-[#6d6d18]/10 text-[#6d6d18] mb-4 group-hover:bg-[#6d6d18] group-hover:text-white transition-all duration-500">
                            <i class="fa-solid fa-martini-glass text-3xl"></i>
                        </div>
                        <span
                            class="text-xs uppercase font-bold tracking-widest text-gray-500 group-hover:text-[#6d6d18]">Mini
                            Bar</span>
                    </div>
                    <div class="group flex flex-col items-center">
                        <div
                            class="w-16 h-16 flex items-center justify-center rounded-full bg-[#6d6d18]/10 text-[#6d6d18] mb-4 group-hover:bg-[#6d6d18] group-hover:text-white transition-all duration-500">
                            <i class="fa-solid fa-champagne-glasses text-3xl"></i>
                        </div>
                        <span
                            class="text-xs uppercase font-bold tracking-widest text-gray-500 group-hover:text-[#6d6d18]">Drinks</span>
                    </div>
                </div>
            </div>
        </section>

        <section id="rooms" class="py-24 bg-[#fdfbf7]">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-end mb-16 reveal">
                    <div>
                        <h2 class="text-[#0a7c15] font-bold uppercase tracking-widest text-sm mb-2">Our Sanctuary</h2>
                        <h3 class="text-4xl md:text-5xl font-serif">Thoughtful Accommodations</h3>
                    </div>
                    <a href="{{ url('accommodation') }}"
                        class="group text-[#6d6d18] font-bold border-b-2 border-[#6d6d18] pb-1 hover:text-[#0a7c15] hover:border-[#0a7c15] transition-all">
                        View All Rooms <span class="inline-block group-hover:translate-x-2 transition-transform">→</span>
                    </a>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                    <div class="group cursor-pointer reveal delay-100">
                        <div class="overflow-hidden relative rounded-lg">
                            <img src="{{ asset('frontendimages/rooms/single.png') }}" alt="Single"
                                class="w-full h-96 object-cover group-hover:scale-110 transition duration-1000">
                            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                        </div>
                        <div class="mt-8">
                            <h4 class="text-2xl font-serif mb-3">Single Bed Room</h4>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">Wake up to the Annapurna range through
                                floor-to-ceiling windows. Features a private terrace.</p>
                            <p class="text-[#0a7c15] font-bold text-lg">From Rs. 1800 <span
                                    class="text-xs text-gray-400 font-normal uppercase">/ Night</span></p>
                        </div>
                    </div>

                    <div class="group cursor-pointer reveal delay-200">
                        <div class="overflow-hidden relative rounded-lg">
                            <img src="{{ asset('frontendimages/rooms/double.png') }}" alt="Deluxe Room"
                                class="w-full h-96 object-cover group-hover:scale-110 transition duration-1000">
                            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                        </div>
                        <div class="mt-8">
                            <h4 class="text-2xl font-serif mb-3">Couple Bed Room</h4>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">Intricately carved wood details with a
                                blend of modern sustainable comfort.</p>
                            <p class="text-[#0a7c15] font-bold text-lg">From Rs. 2200 <span
                                    class="text-xs text-gray-400 font-normal uppercase">/ Night</span></p>
                        </div>
                    </div>

                    <div class="group cursor-pointer reveal delay-300">
                        <div class="overflow-hidden relative rounded-lg">
                            <img src="{{ asset('frontendimages/rooms/triple.png') }}" alt="Eco Cabin"
                                class="w-full h-96 object-cover group-hover:scale-110 transition duration-1000">
                            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                        </div>
                        <div class="mt-8">
                            <h4 class="text-2xl font-serif mb-3">Triple Bed</h4>
                            <p class="text-gray-600 text-sm mb-4 leading-relaxed">Nestled in our organic gardens. Perfect
                                for those seeking absolute privacy.</p>
                            <p class="text-[#0a7c15] font-bold text-lg">From Rs. 2800 <span
                                    class="text-xs text-gray-400 font-normal uppercase">/ Night</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-28 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex flex-col lg:flex-row items-center gap-20">
                    <div class="lg:w-1/2 relative reveal">
                        <div class="absolute -top-10 -left-10 w-40 h-40 bg-[#6d6d18]/5 rounded-full -z-10 animate-pulse">
                        </div>
                        <img src="{{ asset('frontendimages/hospitality.png') }}" alt="Organic Dining"
                            class="rounded-2xl shadow-2xl w-full h-[600px] object-cover ring-8 ring-white">
                        <div
                            class="absolute -bottom-10 -right-10 bg-[#0a7c15] p-10 text-white hidden md:block rounded-2xl shadow-2xl transform hover:scale-105 transition-transform">
                            <p class="text-5xl font-serif mb-1">85%</p>
                            <p class="text-xs uppercase tracking-[0.2em] font-bold opacity-80 leading-relaxed">Ingredients
                                from<br>our own garden</p>
                        </div>
                    </div>
                    <div class="lg:w-1/2 reveal delay-200">
                        <h2 class="text-[#0a7c15] font-bold uppercase tracking-widest text-sm mb-4">Farm to Table</h2>
                        <h3 class="text-4xl md:text-5xl font-serif mb-8 text-gray-900 leading-tight">A Taste of the
                            Himalayas</h3>
                        <p class="text-gray-600 mb-8 leading-relaxed text-lg">
                            Dining at Bandipur Eco is a journey through Nepal’s rich flavors. Our chefs specialize in
                            <strong class="text-[#6d6d18]">Newari Cuisine</strong>, utilizing organic vegetables grown in
                            the red soil of our own terrace
                            gardens.
                        </p>
                        <ul class="space-y-5 mb-10">
                            <li class="flex items-center gap-4 group">
                                <span
                                    class="w-8 h-8 rounded-full bg-[#6d6d18]/10 flex items-center justify-center text-[#6d6d18] font-bold group-hover:bg-[#6d6d18] group-hover:text-white transition-colors">✓</span>
                                <span class="text-gray-700 font-medium">Traditional Samay Baji Platters</span>
                            </li>
                            <li class="flex items-center gap-4 group">
                                <span
                                    class="w-8 h-8 rounded-full bg-[#6d6d18]/10 flex items-center justify-center text-[#6d6d18] font-bold group-hover:bg-[#6d6d18] group-hover:text-white transition-colors">✓</span>
                                <span class="text-gray-700 font-medium">Mountain Herbs & Hand-pressed Oils</span>
                            </li>
                            <li class="flex items-center gap-4 group">
                                <span
                                    class="w-8 h-8 rounded-full bg-[#6d6d18]/10 flex items-center justify-center text-[#6d6d18] font-bold group-hover:bg-[#6d6d18] group-hover:text-white transition-colors">✓</span>
                                <span class="text-gray-700 font-medium">Evening Campfire Barbecue</span>
                            </li>
                        </ul>
                        <a href="#"
                            class="inline-block bg-[#6d6d18] text-white px-10 py-4 font-bold rounded-sm hover:bg-[#0a7c15] transition-all shadow-lg hover:-translate-y-1">
                            Explore the Menu
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-28 bg-[#6d6d18] text-white relative">
            <div class="max-w-7xl mx-auto px-4 text-center mb-20 reveal">
                <h2 class="uppercase tracking-[0.3em] text-xs font-bold opacity-70 mb-4">The Itinerary</h2>
                <h3 class="text-4xl md:text-5xl font-serif">A Day Above the Clouds</h3>
            </div>
            <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-4 gap-6">
                <div
                    class="bg-white/5 p-10 rounded-2xl backdrop-blur-md border border-white/10 hover:bg-white/20 transition-all duration-500 reveal delay-100">
                    <p class="text-green-300 font-bold text-sm mb-4">06:00 AM</p>
                    <h4 class="text-2xl font-serif mb-4">Sunrise Ritual</h4>
                    <p class="text-sm text-gray-200 leading-relaxed">Watch the sun paint the Dhaulagiri and Annapurna
                        ranges
                        in shades of gold from your balcony.</p>
                </div>
                <div
                    class="bg-white/5 p-10 rounded-2xl backdrop-blur-md border border-white/10 hover:bg-white/20 transition-all duration-500 reveal delay-200">
                    <p class="text-green-300 font-bold text-sm mb-4">11:00 AM</p>
                    <h4 class="text-2xl font-serif mb-4">Village Walk</h4>
                    <p class="text-sm text-gray-200 leading-relaxed">Explore the silent, vehicle-free streets of Bandipur.
                        Visit the Bindabasini temple and local artisans.</p>
                </div>
                <div
                    class="bg-white/5 p-10 rounded-2xl backdrop-blur-md border border-white/10 hover:bg-white/20 transition-all duration-500 reveal delay-300">
                    <p class="text-green-300 font-bold text-sm mb-4">03:00 PM</p>
                    <h4 class="text-2xl font-serif mb-4">Siddha Gufa</h4>
                    <p class="text-sm text-gray-200 leading-relaxed">A short trek to Nepal's largest cave. A must for
                        thrill-seekers and nature lovers.</p>
                </div>
                <div
                    class="bg-white/5 p-10 rounded-2xl backdrop-blur-md border border-white/10 hover:bg-white/20 transition-all duration-500 reveal delay-400">
                    <p class="text-green-300 font-bold text-sm mb-4">07:00 PM</p>
                    <h4 class="text-2xl font-serif mb-4">Star Gazing</h4>
                    <p class="text-sm text-gray-200 leading-relaxed">Zero light pollution means the Milky Way is your roof.
                        Enjoy with a cup of local Himalayan tea.</p>
                </div>
            </div>
        </section>

        <section id="eco" class="py-28 bg-[#fdfbf7]">
            <div class="max-w-7xl mx-auto px-4">
                <div class="bg-[#0a7c15] rounded-3xl p-6 md:p-24 relative overflow-hidden shadow-2xl reveal">
                    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -mr-32 -mt-32"></div>
                    <div class="absolute bottom-0 left-0 w-64 h-64 bg-black/5 rounded-full -ml-20 -mb-20"></div>

                    <div class="relative z-10 grid lg:grid-cols-2 gap-16 items-center">
                        <div>
                            <h3 class="text-white text-4xl md:text-6xl font-serif mb-8 leading-tight">We don't just host
                                guests; we protect our home.</h3>
                            <p class="text-green-50 mb-10 text-xl leading-relaxed opacity-90">Our resort is designed to
                                leave a minimal footprint while providing maximal comfort. Every brick was laid by local
                                hands.</p>
                            <div class="grid grid-cols-2 gap-10">
                                <div class="border-l-2 border-white/30 pl-6">
                                    <h4 class="text-white text-2xl font-bold mb-1 italic">Rainwater</h4>
                                    <p class="text-white text-[10px] opacity-70 uppercase tracking-[0.2em] font-bold">
                                        Harvesting System</p>
                                </div>
                                <div class="border-l-2 border-white/30 pl-6">
                                    <h4 class="text-white text-2xl font-bold mb-1 italic">Waste-Free</h4>
                                    <p class="text-white text-[10px] opacity-70 uppercase tracking-[0.2em] font-bold">
                                        Composting Program</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-white/10 border border-white/20 p-6 md:p-12 rounded-3xl backdrop-blur-xl shadow-inner text-center">
                            <h4 class="text-white font-serif text-3xl mb-4">Join Our Mission</h4>
                            <p class="text-white/80 text-lg mb-10 leading-relaxed">Stay with us and contribute to the
                                reforestation of the Tanahun hills.</p>
                            <button
                                class="w-full bg-[#6d6d18] text-white py-5 rounded-xl font-bold hover:bg-white hover:text-[#0a7c15] transition-all duration-500 shadow-xl uppercase tracking-widest text-sm">
                                Learn About Our Eco-Projects
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-28 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid lg:grid-cols-2 gap-20 items-center">
                    <div class="reveal">
                        <h2 class="text-[#0a7c15] font-bold uppercase tracking-[0.3em] text-xs mb-4">Living History</h2>
                        <h3 class="text-4xl md:text-5xl font-serif mb-8 text-gray-900 leading-tight">The Heart of Newari
                            Culture</h3>
                        <p class="text-gray-600 mb-10 leading-relaxed text-lg">
                            Bandipur is a "living museum"—a preserved 18th-century trading post where motorized vehicles are
                            prohibited. Our resort is built using the same red-brick and carved-wood techniques that have
                            defined this ridge for centuries.
                        </p>
                        <div class="space-y-10">
                            <div class="flex gap-6 group">
                                <div
                                    class="flex-shrink-0 w-14 h-14 bg-[#fdfbf7] flex items-center justify-center rounded-2xl text-[#6d6d18] font-bold text-xl group-hover:bg-[#6d6d18] group-hover:text-white transition-all duration-500">
                                    01
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-xl mb-1">Authentic Architecture</h4>
                                    <p class="text-gray-500 leading-relaxed">Every window frame is hand-carved by local
                                        master craftsmen.</p>
                                </div>
                            </div>
                            <div class="flex gap-6 group">
                                <div
                                    class="flex-shrink-0 w-14 h-14 bg-[#fdfbf7] flex items-center justify-center rounded-2xl text-[#6d6d18] font-bold text-xl group-hover:bg-[#6d6d18] group-hover:text-white transition-all duration-500">
                                    02
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-xl mb-1">Local Traditions</h4>
                                    <p class="text-gray-500 leading-relaxed">Participate in seasonal festivals and evening
                                        "Dhan Naach" dances.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 reveal delay-200">
                        <img src="{{ asset('frontendimages/cusin.png') }}"
                            class="rounded-2xl h-[400px] w-full object-cover mt-12 shadow-xl" alt="Local Temple">
                        <img src="{{ asset('frontendimages/tempels.png') }}"
                            class="rounded-2xl h-[400px] w-full object-cover shadow-xl" alt="Newari Woodwork">
                    </div>
                </div>
            </div>
        </section>

        <section class="py-28 bg-[#fdfbf7] overflow-hidden">
            <div class="max-w-[1600px] mx-auto px-4">
                <div class="text-center mb-20 reveal">
                    <h3 class="text-4xl md:text-5xl font-serif italic text-gray-900">Moments from the Ridge</h3>
                </div>
                <div class="flex flex-wrap -m-2 reveal delay-200">
                    <div class="flex flex-wrap w-1/2">
                        <div class="w-full p-2">
                            <img alt="Mountain View"
                                class="block object-cover object-center w-full h-[500px] rounded-2xl hover:brightness-75 transition-all duration-700 cursor-pointer"
                                src="{{ asset('frontendimages/tempels.png') }}">
                        </div>
                        <div class="w-1/2 p-2">
                            <img alt="Resort Exterior"
                                class="block object-cover object-center w-full h-[300px] rounded-2xl hover:brightness-75 transition-all duration-700 cursor-pointer"
                                src="{{ asset('frontendimages/dinning.png') }}">
                        </div>
                        <div class="w-1/2 p-2">
                            <img alt="Food"
                                class="block object-cover object-center w-full h-[300px] rounded-2xl hover:brightness-75 transition-all duration-700 cursor-pointer"
                                src="{{ asset('frontendimages/cusin.png') }}">
                        </div>
                    </div>
                    <div class="flex flex-wrap w-1/2">
                        <div class="w-1/2 p-2">
                            <img alt="Yoga"
                                class="block object-cover object-center w-full h-[300px] rounded-2xl hover:brightness-75 transition-all duration-700 cursor-pointer"
                                src="{{ asset('frontendimages/bandipur1.png') }}">
                        </div>
                        <div class="w-1/2 p-2">
                            <img alt="Sunset"
                                class="block object-cover object-center w-full h-[300px] rounded-2xl hover:brightness-75 transition-all duration-700 cursor-pointer"
                                src="{{ asset('frontendimages/bandipureco.png') }}">
                        </div>
                        <div class="w-full p-2">
                            <img alt="Guest Relaxing"
                                class="block object-cover object-center w-full h-[500px] rounded-2xl hover:brightness-75 transition-all duration-700 cursor-pointer"
                                src="{{ asset('frontendimages/hotel_entrance.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-28 bg-white px-4">
            <div class="max-w-7xl mx-auto">
                <div class="bg-gray-50 overflow-hidden flex flex-col lg:flex-row shadow-sm border border-gray-100">
                    <div class="p-6 md:p-20 aspect-4/3 reveal">
                        @if ($locationContent)
                            {{-- <h3 class="text-4xl font-serif mb-8 text-gray-900">Getting to Paradise</h3> --}}
                            <h3 class="text-4xl font-serif mb-8 text-gray-900">
                                {{ $locationContent->heading }}
                            </h3>
                            {{-- <p class="text-gray-600 mb-12 text-lg">Located halfway between Kathmandu and Pokhara, Bandipur is the perfect midpoint for your Nepal journey.</p> --}}
                            <p class="text-gray-600 mb-12 text-lg">
                                {{ $locationContent->description }}
                            </p>

                            <div class="space-y-8">
                                <div class="flex items-start gap-6">
                                    {{-- <span class="text-[#6d6d18] font-bold tracking-widest text-sm pt-1">BY CAR:</span> --}}
                                    <span class="text-[#6d6d18] font-bold tracking-widest text-sm pt-1">
                                        {{ $locationContent->car_label }}:
                                    </span>
                                    {{-- <span class="text-gray-600 leading-relaxed">4 hours from Kathmandu / 2.5 hours from Pokhara via Prithvi Highway.</span> --}}
                                    <span class="text-gray-600 leading-relaxed">
                                        {{ $locationContent->car_text }}
                                    </span>
                                </div>
                                <div class="flex items-start gap-6 border-t border-gray-200 pt-8">
                                    {{-- <span class="text-[#6d6d18] font-bold tracking-widest text-sm pt-1">PICKUP:</span> --}}
                                    <span class="text-[#6d6d18] font-bold tracking-widest text-sm pt-1">
                                        {{ $locationContent->pickup_label }}:
                                    </span>
                                    {{-- <span class="text-gray-600 leading-relaxed">We provide private luxury transfers from Dumre (the gateway to Bandipur).</span> --}}
                                    <span class="text-gray-600 leading-relaxed">
                                        {{ $locationContent->pickup_text }}
                                    </span>
                                </div>
                            </div>
                        @endif

                        <button
                            class="mt-16 group flex items-center gap-3 text-[#0a7c15] font-bold hover:gap-6 transition-all duration-500 uppercase tracking-widest text-xs">
                            Get directions on Google Maps <span
                                class="text-2xl transition-transform group-hover:translate-x-2">→</span>
                        </button>
                    </div>
                    <div class=" w-full bg-gray-200  aspect-4/3 overflow-hidden relative reveal delay-200">
                        <iframe class="absolute inset-0 w-full h-full rounded-xl transition-all duration-1000"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14092.34863261642!2d84.4069!3d27.93!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399502909477610f%3A0x6b490f2b3e89569!2sBandipur!5e0!3m2!1sen!2snp!4v1625000000000"
                            allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </section>

        <section class="relative py-32 bg-[#0a7c15] overflow-hidden text-center">
            <div class="absolute inset-0 opacity-20 mix-blend-overlay">
                <img src="{{ asset('frontendimages/bandipur1.png') }}" alt="pattern"
                    class='object-cover w-full h-full scale-125'>
            </div>
            <div class="relative z-10 max-w-4xl mx-auto px-4">
                <h2 class="text-white text-5xl md:text-7xl font-serif mb-10 reveal" data-aos="fade-up">Ready for the
                    Sunrise?</h2>
                <p class="text-green-50 text-xl mb-12 max-w-2xl mx-auto leading-relaxed reveal delay-100">
                    Book directly with us for complimentary breakfast and late check-out.
                    Experience Bandipur the eco-friendly way.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6 reveal delay-200">
                    <a onclick="openBookingModal()"
                        class="bg-[#6d6d18] text-white px-12 py-5 rounded-full font-bold text-lg hover:bg-white hover:text-[#6d6d18] transition-all duration-500 shadow-2xl uppercase tracking-widest">
                        Book Now
                    </a>
                    <a href="{{ $firstPhone ? 'tel:' . $firstPhone : '#' }}"
                        class="bg-transparent border-2 border-white text-white px-12 py-5 rounded-full font-bold text-lg hover:bg-white hover:text-[#0a7c15] transition-all duration-500 uppercase tracking-widest">
                        Call Reservations
                    </a>
                </div>
            </div>
        </section>

    </main>
    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/9779812345678" target="_blank"
        class="fixed bottom-8 right-8 z-50 bg-[#25D366] text-white w-16 h-16 rounded-full flex items-center justify-center shadow-2xl hover:bg-[#128C7E] transition-all duration-300 hover:scale-110 animate-bounce">
        <i class="fab fa-whatsapp text-4xl"></i>
    </a>

    @push('script')
        {{-- // main --}}
        <script>
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal').forEach((el) => observer.observe(el));
        </script>

        {{-- carousel --}}
        <script>
            document.addEventListener('scroll', () => {
                const scrollValue = window.scrollY;
                const windowHeight = window.innerHeight;
                const heroBg = document.getElementById('hero-bg');
                const heroText = document.getElementById('hero-text');

                // Calculate progress (0 to 1)
                const scrollRatio = Math.min(scrollValue / windowHeight, 1);

                if (scrollRatio <= 1) {
                    const translateY = scrollRatio * -150; // Shifts up 150px
                    const scale = 1 - (scrollRatio * 0); // Scale from 1 to 0.85

                    // Hero Background Animation
                    heroBg.style.transform = `translateY(${translateY}px) scale(${scale})`;

                    // Hero Text Animation (Move up faster and fade out)
                    const textTranslateY = scrollRatio * -100;
                    heroText.style.transform = `translateY(${textTranslateY}px)`;
                    heroText.style.opacity = 1 - (scrollRatio * 1); // Fades out faster
                }
            });


            // Carousel Functionality - Seamless Loop
            const slides = document.querySelectorAll('.carousel-slide');
            const dots = document.querySelectorAll('.slide-dot');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const currentSlideDisplay = document.getElementById('currentSlide');

            let currentIndex = 0;
            let previousIndex = 0;
            let autoPlayInterval;
            const intervalTime = 6000;

            function updateSlide(newIndex) {
                // Store previous index for smooth crossfade
                previousIndex = currentIndex;
                currentIndex = newIndex;

                // Update all slides
                slides.forEach((slide, i) => {
                    slide.classList.remove('active', 'prev');

                    if (i === currentIndex) {
                        slide.classList.add('active');
                    } else if (i === previousIndex) {
                        slide.classList.add('prev');
                        // Remove prev class after transition completes
                        setTimeout(() => {
                            slide.classList.remove('prev');
                        }, 1200);
                    }
                });

                // Update progress bars
                dots.forEach((dot, i) => {
                    const progressBar = dot.querySelector('.progress-bar');
                    progressBar.classList.remove('progress-active');
                    progressBar.style.width = '0%';

                    if (i === currentIndex) {
                        // Small delay to restart animation
                        setTimeout(() => {
                            progressBar.classList.add('progress-active');
                        }, 50);
                    }
                });

                // Update counter
                currentSlideDisplay.textContent = String(currentIndex + 1).padStart(2, '0');
            }

            function nextSlide() {
                const newIndex = (currentIndex + 1) % slides.length;
                updateSlide(newIndex);
            }

            function prevSlide() {
                const newIndex = (currentIndex - 1 + slides.length) % slides.length;
                updateSlide(newIndex);
            }

            function goToSlide(index) {
                if (index !== currentIndex) {
                    updateSlide(index);
                    resetAutoPlay();
                }
            }

            function startAutoPlay() {
                autoPlayInterval = setInterval(nextSlide, intervalTime);
            }

            function resetAutoPlay() {
                clearInterval(autoPlayInterval);
                startAutoPlay();
            }

            // Event Listeners
            nextBtn.addEventListener('click', () => {
                nextSlide();
                resetAutoPlay();
            });

            prevBtn.addEventListener('click', () => {
                prevSlide();
                resetAutoPlay();
            });

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => goToSlide(index));
            });

            // Keyboard Navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowRight') {
                    nextSlide();
                    resetAutoPlay();
                } else if (e.key === 'ArrowLeft') {
                    prevSlide();
                    resetAutoPlay();
                }
            });

            // Touch/Swipe Support
            let touchStartX = 0;
            let touchEndX = 0;

            document.getElementById('hero').addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
            }, {
                passive: true
            });

            document.getElementById('hero').addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                const diff = touchStartX - touchEndX;

                if (Math.abs(diff) > 50) {
                    if (diff > 0) {
                        nextSlide();
                    } else {
                        prevSlide();
                    }
                    resetAutoPlay();
                }
            }, {
                passive: true
            });

            // Pause on hover (desktop only)
            const heroSection = document.getElementById('hero');

            heroSection.addEventListener('mouseenter', () => {
                clearInterval(autoPlayInterval);
            });

            heroSection.addEventListener('mouseleave', () => {
                startAutoPlay();
            });

            // Initialize
            updateSlide(0);
            startAutoPlay();
        </script>
    @endpush
@endsection
