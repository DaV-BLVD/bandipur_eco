@extends('frontend.app')

@section('content')
    @push('style')
        <style>
            /* Hero Parallax */
            .parallax-bg {
                background-attachment: fixed;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            /* Animations */
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

            @keyframes fadeInLeft {
                from {
                    opacity: 0;
                    transform: translateX(-40px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes fadeInRight {
                from {
                    opacity: 0;
                    transform: translateX(40px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes scaleIn {
                from {
                    opacity: 0;
                    transform: scale(0.9);
                }

                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0) rotate(0deg);
                }

                25% {
                    transform: translateY(-8px) rotate(2deg);
                }

                75% {
                    transform: translateY(-4px) rotate(-2deg);
                }
            }

            @keyframes pulse-glow {

                0%,
                100% {
                    box-shadow: 0 0 20px rgba(10, 124, 21, 0.3);
                }

                50% {
                    box-shadow: 0 0 40px rgba(10, 124, 21, 0.6);
                }
            }

            @keyframes shimmer {
                0% {
                    background-position: -200% 0;
                }

                100% {
                    background-position: 200% 0;
                }
            }

            @keyframes borderGlow {

                0%,
                100% {
                    border-color: var(--olive);
                }

                50% {
                    border-color: var(--green);
                }
            }

            @keyframes textGradient {

                0%,
                100% {
                    background-position: 0% 50%;
                }

                50% {
                    background-position: 100% 50%;
                }
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in-up {
                animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            }

            .animate-fade-in-left {
                animation: fadeInLeft 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            }

            .animate-fade-in-right {
                animation: fadeInRight 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            }

            .animate-scale-in {
                animation: scaleIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            }

            .animate-float {
                animation: float 4s ease-in-out infinite;
            }

            .animate-pulse-glow {
                animation: pulse-glow 2s ease-in-out infinite;
            }

            .animate-text-gradient {
                background-size: 200% auto;
                animation: textGradient 3s linear infinite;
            }

            .stagger-1 {
                animation-delay: 0.1s;
            }

            .stagger-2 {
                animation-delay: 0.2s;
            }

            .stagger-3 {
                animation-delay: 0.3s;
            }

            .stagger-4 {
                animation-delay: 0.4s;
            }

            .stagger-5 {
                animation-delay: 0.5s;
            }

            .stagger-6 {
                animation-delay: 0.6s;
            }

            /* Glassmorphism */
            .glass {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .glass-dark {
                background: rgba(0, 0, 0, 0.2);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            /* Gradient Text */
            .gradient-text {
                background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--primary) 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;

            }
        </style>

        {{-- rate section --}}
        <style>
            /* Custom Animation Keyframes */
            @keyframes float {
                0% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(-10px);
                }

                100% {
                    transform: translateY(0px);
                }
            }

            @keyframes float-delayed {
                0% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(-10px);
                }

                100% {
                    transform: translateY(0px);
                }
            }

            /* Apply animations */
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }

            .animate-float-delayed {
                animation: float 6s ease-in-out 2s infinite;
            }

            /* Add fade-in animation for table rows */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fadeIn 0.5s ease-out forwards;
                opacity: 0;
                animation-delay: var(--delay, 0ms);
            }

            /* Clip path for promo tags */
            .clip-path-promo {
                clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 15% 100%);
                border-bottom-left-radius: 6px;
            }
        </style>
    @endpush
    <!-- Hero Section -->
    <header
        style="background-image: url('{{ asset('frontendimages/bandipureco.png') }}');  background-size: cover; background-position: center; background-repeat: no-repeat;"
        class=" relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-black/90 via-[#1a2a1a]/70 to-black/90"></div>
        <div class="relative z-10 max-w-6xl mx-auto px-6 text-center pt-14 pb-20 ">
            <!-- Decorative Line -->
            <div class="flex items-center justify-center gap-4 mb-8 opacity-0 animate-fade-in-up">
                <div class="w-16 h-px bg-gradient-to-r from-transparent to-[#6d6d18]"></div>
                <div class="w-2 h-2 bg-[#6d6d18] rotate-45"></div>
                <span class="text-[#9d9d48] uppercase tracking-[0.3em] text-sm font-medium">Luxury Resort</span>
                <div class="w-2 h-2 bg-[#0a7c15] rotate-45"></div>
                <div class="w-16 h-px bg-gradient-to-l from-transparent to-[#0a7c15]"></div>
            </div>

            <h1
                class="font-display text-6xl md:text-7xl lg:text-8xl font-bold text-white mb-6 opacity-0 animate-fade-in-up stagger-1">
                Our <span class="gradient-text ">Rates</span>
            </h1>

            <p
                class="text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto mb-10 opacity-0 animate-fade-in-up stagger-2 leading-relaxed">
                Experience unparalleled luxury with transparent pricing designed for your perfect getaway
            </p>

            <!-- Stats -->
            <div class="flex flex-wrap justify-center gap-8 md:gap-16 mt-12 opacity-0 animate-fade-in-up stagger-3">
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2 counter" data-target="5">0</div>
                    <div class="text-[#9d9d48] uppercase tracking-wider text-sm">Room Types</div>
                </div>
                <div class="w-px h-16 bg-gradient-to-b from-transparent via-[#6d6d18] to-transparent hidden md:block">
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2"><span class="counter"
                            data-target="30">0</span>%</div>
                    <div class="text-[#9d9d48] uppercase tracking-wider text-sm">Off-Season Savings</div>
                </div>
                <div class="w-px h-16 bg-gradient-to-b from-transparent via-[#0a7c15] to-transparent hidden md:block">
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2 counter" data-target="24">0</div>
                    <div class="text-[#9d9d48] uppercase tracking-wider text-sm">Hour Service</div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 opacity-0 animate-fade-in-up stagger-4">
            <a href="#rates"
                class="flex flex-col items-center gap-2 text-stone-400 hover:text-(--primary) transition-colors group">
                <span class="text-sm uppercase font-bold tracking-widest animate-bounce">Explore</span>
                <i class='fa-solid fa-angle-down rounded-full text-4xl group-hover:text-(--primary) animate-bounce'></i>
            </a>
        </div>
    </header>


    <!-- Rate Section  -->
    <section class="py-16 px-4 bg-(--primary)/20 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-[#0a7c15]/30 rounded-full -translate-x-20 -translate-y-20 blur-3xl">
        </div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-[#6d6d18]/30 rounded-full translate-x-10 translate-y-20 blur-3xl">
        </div>

        <!-- Floating Elements for Visual Interest -->
        <div class="absolute left-10 top-40 w-8 h-8 bg-[#0a7c15]/70 drop-shadow-2xl rounded-full animate-float opacity-70">
        </div>
        <div
            class="absolute right-20 bottom-40 w-12 h-12 border-2 border-[#6d6d18]/30 rounded-full animate-float-delayed opacity-70">
        </div>
        <div class="absolute left-1/4 bottom-20 w-6 h-6 bg-[#0a7c15]/10 rounded-full animate-pulse opacity-70"></div>

        <div class="max-w-6xl mx-auto relative">
            <!-- Section Header with Enhanced Animation -->
            <div class="text-center mb-16 opacity-0 translate-y-10 transition-all duration-1000 ease-out"
                id="section-header">
                <span
                    class="inline-block px-4 py-1 bg-[#0a7c15]/10 text-[#0a7c15] rounded-full text-sm font-semibold mb-3 animate-pulse">RESORT
                    ACCOMMODATION</span>
                <h2
                    class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-[#6d6d18] to-[#0a7c15] bg-clip-text text-transparent">
                    Experience Luxury in Bandipur</h2>
                <div class="flex items-center justify-center mb-5">
                    <div class="h-1 w-10 bg-[#6d6d18] rounded-full"></div>
                    <div class="h-1 w-20 bg-[#0a7c15] mx-2 rounded-full"></div>
                    <div class="h-1 w-10 bg-[#6d6d18] rounded-full"></div>
                </div>
                <p class="text-gray-700 max-w-2xl mx-auto text-lg leading-relaxed">
                    Discover our exceptional accommodations nestled in the heart of Bandipur, Nepal. Choose from our
                    carefully curated selection of rooms with stunning Himalayan views.
                </p>
            </div>

            <!-- Enhanced Season Toggle with Animation -->
            <div class="flex justify-center mb-12 opacity scale-95 transition-all duration-700 delay-300 ease-out"
                id="season-toggle">
                <div
                    class="bg-(--primary)/50 rounded-full inline-flex shadow-lg border border-gray-100 relative overflow-hidden group">
                    <div id="toggleBackground"
                        class="absolute h-full w-1/2 bg-gradient-to-r from-[#0a7c15] to-[#6d6d18] rounded-full left-0 transition-all duration-500 ease-in-out">
                    </div>
                    <button id="seasonalBtn"
                        class="relative z-10 px-4 py-3 rounded-full font-medium transition-all duration-300 text-white">
                        Peak Season
                    </button>
                    <button id="offSeasonBtn"
                        class="relative z-10 px-4 py-3 rounded-full font-medium transition-all duration-300 text-gray-700">
                        Off Season
                    </button>
                </div>
            </div>

            <!-- Enhanced Rate Cards Container with Staggered Animations -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" id="rate-cards">

                <!-- Enhanced Rate Card 1 - Standard Room -->
                <div
                    class="relative bg-white rounded-2xl overflow-hidden shadow-xl group transition-all duration-500 card-animate">
                    <div
                        class="absolute inset-0 bg-gradient-to-b from-[#0a7c15]/0 via-[#0a7c15]/0 to-[#0a7c15]/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none">
                    </div>

                    <div
                        class="absolute top-0 inset-x-0 h-2 bg-gradient-to-r from-[#0a7c15] to-[#6d6d18] transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-500">
                    </div>

                    <div class="relative overflow-hidden aspect-[4/3]">
                        <img src="{{ asset('frontendimages/rooms/single.png') }}" alt="Standard Room"
                            class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110 group-hover:rotate-1">
                        <div
                            class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-[#0a7c15] px-3 py-1 rounded-full text-sm font-bold shadow-lg transform -translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 delay-100">
                            Most Popular
                        </div>
                    </div>

                    <div class="p-8 relative">


                        <span class="text-sm text-[#0a7c15] font-semibold tracking-wider uppercase">Standard</span>
                        <h3
                            class="text-2xl font-bold text-gray-800 mt-1 mb-3 group-hover:text-[#0a7c15] transition-colors duration-300">
                            Mountain View Suite</h3>

                        <div class="flex items-center mb-4">
                            <div class="flex text-[#6d6d18]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                            </div>
                            <span class="text-gray-600 ml-2 text-sm">128 reviews</span>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">1. LED
                                TV</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">2. En-suite
                                Bathroom</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">3. Include
                                Hotwater 24 Hours</span>
                        </div>

                        <div class="rate seasonal-rate block transform transition-all duration-500">
                            <div class="flex flex-col  justify-between items-start gap-6">
                                <div>
                                    <p class="text-sm text-gray-500">From</p>
                                    <div class="flex items-baseline">
                                        <p class="md:text-3xl text-base font-bold text-[#6d6d18]">$120</p>
                                        <p class="text-sm text-gray-500 ml-1">/ night</p>
                                    </div>
                                </div>
                                <a onclick="openBookingModal()"
                                    class="relative overflow-hidden bg-[#0a7c15] text-white px-4 py-2 lg:px-6 lg:py-3 rounded-lg shadow-lg transform transition-all duration-300 hover:translate-y-1 hover:shadow-none group-hover:bg-gradient-to-r group-hover:from-[#0a7c15] group-hover:to-[#6d6d18]">
                                    <span class="relative z-10">Book Now</span>
                                    <div
                                        class="absolute inset-0 h-full w-full bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-500 opacity-20">
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="rate off-seasonal-rate hidden transform transition-all duration-500">
                            <div class="flex justify-between items-start flex-col gap-6">
                                <div>
                                    <p class="text-sm text-gray-500">From</p>
                                    <div class="flex items-baseline">
                                        <p class="md:text-3xl text-base font-bold text-[#6d6d18]">$85</p>
                                        <p class="text-sm text-gray-500 ml-1">/ night</p>
                                    </div>
                                </div>
                                <a onclick="openBookingModal()"
                                    class="relative overflow-hidden bg-[#0a7c15] text-white px-4 py-2 lg:px-6 lg:py-3 rounded-lg shadow-lg transform transition-all duration-300 hover:translate-y-1 hover:shadow-none group-hover:bg-gradient-to-r group-hover:from-[#0a7c15] group-hover:to-[#6d6d18]">
                                    <span class="relative z-10">Book Now</span>
                                    <div
                                        class="absolute inset-0 h-full w-full bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-500 opacity-20">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Rate Card 2 - Deluxe Suite -->
                <div
                    class="relative bg-white rounded-2xl overflow-hidden shadow-xl group transition-all duration-500 card-animate">
                    <div
                        class="absolute inset-0 bg-gradient-to-b from-[#0a7c15]/0 via-[#0a7c15]/0 to-[#0a7c15]/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none">
                    </div>

                    <div
                        class="absolute top-0 inset-x-0 h-2 bg-gradient-to-r from-[#0a7c15] to-[#6d6d18] transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-500">
                    </div>

                    <div class="relative overflow-hidden aspect-[4/3]">
                        <img src="{{ asset('frontendimages/rooms/double.png') }}" alt="Couple"
                            class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110 group-hover:rotate-1">
                        <div
                            class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-[#6d6d18] px-3 py-1 rounded-full text-sm font-bold shadow-lg transform -translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 delay-100">
                            Premium
                        </div>
                    </div>

                    <div class="p-8 relative">


                        <span class="text-sm text-[#0a7c15] font-semibold tracking-wider uppercase">Couple</span>
                        <h3
                            class="text-2xl font-bold text-gray-800 mt-1 mb-3 group-hover:text-[#0a7c15] transition-colors duration-300">
                            Couple Room</h3>

                        <div class="flex items-center mb-4">
                            <div class="flex text-[#6d6d18]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                            </div>
                            <span class="text-gray-600 ml-2 text-sm">96 reviews</span>
                        </div>

                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">1. LED
                                TV</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">2. En-suite
                                Bathroom</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">3. Include
                                Hotwater 24 Hours</span>
                        </div>

                        <div class="rate seasonal-rate block transform transition-all duration-500">
                            <div class="flex justify-between items-start flex-col gap-6">
                                <div>
                                    <p class="text-sm text-gray-500">From</p>
                                    <div class="flex items-baseline">
                                        <p class="md:text-3xl text-base font-bold text-[#6d6d18]">Rs. 1950</p>
                                        <p class="text-sm text-gray-500 ml-1">/ night</p>
                                    </div>
                                </div>
                                <a onclick="openBookingModal()"
                                    class="relative overflow-hidden bg-[#0a7c15] text-white px-4 py-2 lg:px-6 lg:py-3 rounded-lg shadow-lg transform transition-all duration-300 hover:translate-y-1 hover:shadow-none group-hover:bg-gradient-to-r group-hover:from-[#0a7c15] group-hover:to-[#6d6d18]">
                                    <span class="relative z-10">Book Now</span>
                                    <div
                                        class="absolute inset-0 h-full w-full bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-500 opacity-20">
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="rate off-seasonal-rate hidden transform transition-all duration-500">
                            <div class="flex justify-between items-start flex-col gap-6">
                                <div>
                                    <p class="text-sm text-gray-500">From</p>
                                    <div class="flex items-baseline">
                                        <p class="md:text-3xl text-base font-bold text-[#6d6d18]">$145</p>
                                        <p class="text-sm text-gray-500 ml-1">/ night</p>
                                    </div>
                                </div>
                                <a onclick="openBookingModal()"
                                    class="relative overflow-hidden bg-[#0a7c15] text-white px-4 py-2 lg:px-6 lg:py-3 rounded-lg shadow-lg transform transition-all duration-300 hover:translate-y-1 hover:shadow-none group-hover:bg-gradient-to-r group-hover:from-[#0a7c15] group-hover:to-[#6d6d18]">
                                    <span class="relative z-10">Book Now</span>
                                    <div
                                        class="absolute inset-0 h-full w-full bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-500 opacity-20">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Rate Card 3 - Family Villa -->
                <div
                    class="relative bg-white rounded-2xl overflow-hidden shadow-xl group transition-all duration-500 card-animate">
                    <div
                        class="absolute inset-0 bg-gradient-to-b from-[#0a7c15]/0 via-[#0a7c15]/0 to-[#0a7c15]/80 opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10 pointer-events-none">
                    </div>

                    <div
                        class="absolute top-0 inset-x-0 h-2 bg-gradient-to-r from-[#0a7c15] to-[#6d6d18] transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-500">
                    </div>

                    <div class="relative overflow-hidden aspect-[4/3]">
                        <img src="{{ asset('frontendimages/rooms/triple.png') }}" alt="Family Villa"
                            class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110 group-hover:rotate-1">
                        <div
                            class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-[#0a7c15] px-3 py-1 rounded-full text-sm font-bold shadow-lg transform -translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 delay-100">
                            Family Friendly
                        </div>
                    </div>

                    <div class="p-8 relative">


                        <span class="text-sm text-[#0a7c15] font-semibold tracking-wider uppercase">Premium</span>
                        <h3
                            class="text-2xl font-bold text-gray-800 mt-1 mb-3 group-hover:text-[#0a7c15] transition-colors duration-300">
                            Triple Room</h3>

                        <div class="flex items-center mb-4">
                            <div class="flex text-[#6d6d18]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                </svg>
                            </div>
                            <span class="text-gray-600 ml-2 text-sm">72 reviews</span>
                        </div>

                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">1. LED
                                TV</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">2. En-suite
                                Bathroom</span>
                            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">3. Include
                                Hotwater 24 Hours</span>
                        </div>

                        <div class="rate seasonal-rate block transform transition-all duration-500">
                            <div class="flex justify-between items-start flex-col  gap-6">
                                <div>
                                    <p class="text-sm text-gray-500">From</p>
                                    <div class="flex items-baseline">
                                        <p class="text-3xl font-bold text-[#6d6d18]">$280</p>
                                        <p class="text-sm text-gray-500 ml-1">/ night</p>
                                    </div>
                                </div>
                                <a onclick="openBookingModal()"
                                    class="relative overflow-hidden bg-[#0a7c15] text-white px-4 py-2 lg:px-6 lg:py-3 rounded-lg shadow-lg transform transition-all duration-300 hover:translate-y-1 hover:shadow-none group-hover:bg-gradient-to-r group-hover:from-[#0a7c15] group-hover:to-[#6d6d18]">
                                    <span class="relative z-10">Book Now</span>
                                    <div
                                        class="absolute inset-0 h-full w-full bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-500 opacity-20">
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="rate off-seasonal-rate hidden transform transition-all duration-500">
                            <div class="flex justify-between items-start flex-col gap-6">
                                <div>
                                    <p class="text-sm text-gray-500">From</p>
                                    <div class="flex items-baseline">
                                        <p class="text-3xl font-bold text-[#6d6d18]">$210</p>
                                        <p class="text-sm text-gray-500 ml-1">/ night</p>
                                    </div>
                                </div>
                                <a onclick="openBookingModal()"
                                    class="relative overflow-hidden bg-[#0a7c15] text-white px-4 py-2 lg:px-6 lg:py-3 rounded-lg shadow-lg transform transition-all duration-300 hover:translate-y-1 hover:shadow-none group-hover:bg-gradient-to-r group-hover:from-[#0a7c15] group-hover:to-[#6d6d18]">
                                    <span class="relative z-10">Book Now</span>
                                    <div
                                        class="absolute inset-0 h-full w-full bg-white transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-500 opacity-20">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Detailed Rate Table Section with Animation -->
            <div class="mt-24 opacity-0 translate-y-10 transition-all duration-1000 delay-500 ease-out"
                id="rate-table-section">
                <div class="text-center mb-12">
                    <span
                        class="inline-block px-4 py-1 bg-[#6d6d18]/10 text-[#6d6d18] rounded-full text-sm font-semibold mb-3">FULL
                        PRICING</span>
                    <h3
                        class="text-3xl md:text-4xl font-bold mb-4 bg-gradient-to-r from-[#6d6d18] to-[#0a7c15] bg-clip-text text-transparent">
                        Detailed Rate Information</h3>
                    <div class="flex items-center justify-center mb-5">
                        <div class="h-1 w-6 bg-[#6d6d18] rounded-full"></div>
                        <div class="h-1 w-16 bg-[#0a7c15] mx-2 rounded-full"></div>
                        <div class="h-1 w-6 bg-[#6d6d18] rounded-full"></div>
                    </div>
                    <p class="text-gray-700 max-w-2xl mx-auto">
                        Our transparent pricing ensures you know exactly what to expect. Additional services can be arranged
                        upon request.
                    </p>
                </div>

                <!-- Enhanced Toggle Tabs for Table -->
                <div class="mb-10 flex justify-center">
                    <div
                        class="bg-(--primary)/50  rounded-full inline-flex shadow-md border border-gray-100 relative overflow-hidden">
                        <div id="tableToggleBackground"
                            class="absolute h-full w-1/2 bg-gradient-to-r from-[#0a7c15] to-[#6d6d18] rounded-full left-0 transition-all duration-500 ease-in-out">
                        </div>
                        <button id="tableSeasonalBtn"
                            class="relative  z-10 px-4 py-3 rounded-full font-medium transition-all duration-300 text-white">
                            Peak Season
                        </button>
                        <button id="tableOffSeasonBtn"
                            class="relative z-10 px-4 py-3 rounded-full font-medium transition-all duration-300 text-gray-700">
                            Off-Season
                        </button>
                    </div>
                </div>

                <!-- Enhanced Seasonal Rate Table -->
                <div id="seasonalTable"
                    class="overflow-hidden bg-white rounded-2xl shadow-xl seasonal-table block transform transition-all duration-500">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gradient-to-r from-[#0a7c15] to-[#6d6d18] text-white">
                                    <th class="py-4 px-6 text-left font-medium">Room Type</th>
                                    <th class="py-4 px-6 text-center font-medium">Single Occupancy</th>
                                    <th class="py-4 px-6 text-center font-medium">Double Occupancy</th>
                                    <th class="py-4 px-6 text-center font-medium">Extra Bed</th>
                                    <th class="py-4 px-6 text-center font-medium">Inclusions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-100 hover:bg-[#0a7c15]/5 transition-colors duration-300 animate-fade-in"
                                    style="--delay: 100ms">
                                    <td class="py-4 px-6 text-left font-medium">Standard Room</td>
                                    <td class="py-4 px-6 text-center">$120</td>
                                    <td class="py-4 px-6 text-center">$140</td>
                                    <td class="py-4 px-6 text-center">$35</td>
                                    <td class="py-4 px-6 text-center">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#0a7c15]/10 text-[#0a7c15]">
                                            Breakfast
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-100 hover:bg-[#0a7c15]/5 transition-colors duration-300 animate-fade-in"
                                    style="--delay: 200ms">
                                    <td class="py-4 px-6 text-left font-medium">Deluxe Room</td>
                                    <td class="py-4 px-6 text-center">$150</td>
                                    <td class="py-4 px-6 text-center">$170</td>
                                    <td class="py-4 px-6 text-center">$40</td>
                                    <td class="py-4 px-6 text-center">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#0a7c15]/10 text-[#0a7c15]">
                                            Breakfast
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-100 hover:bg-[#0a7c15]/5 transition-colors duration-300 animate-fade-in"
                                    style="--delay: 300ms">
                                    <td class="py-4 px-6 text-left font-medium">Deluxe Suite</td>
                                    <td class="py-4 px-6 text-center">$195</td>
                                    <td class="py-4 px-6 text-center">$220</td>
                                    <td class="py-4 px-6 text-center">$50</td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex justify-center gap-1 flex-wrap">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#0a7c15]/10 text-[#0a7c15]">
                                                Breakfast
                                            </span>
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#6d6d18]/10 text-[#6d6d18]">
                                                Dinner
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-[#0a7c15]/5 transition-colors duration-300 animate-fade-in"
                                    style="--delay: 400ms">
                                    <td class="py-4 px-6 text-left font-medium">Family Villa</td>
                                    <td class="py-4 px-6 text-center">N/A</td>
                                    <td class="py-4 px-6 text-center">$280</td>
                                    <td class="py-4 px-6 text-center">$60</td>
                                    <td class="py-4 px-6 text-center">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#6d6d18]/20 text-[#6d6d18]">
                                            All Meals
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Enhanced Off-Season Rate Table -->
                <div id="offSeasonTable"
                    class="overflow-hidden bg-white rounded-2xl shadow-xl seasonal-table hidden transform transition-all duration-500">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gradient-to-r from-[#0a7c15] to-[#6d6d18] text-white">
                                    <th class="py-4 px-6 text-left font-medium">Room Type</th>
                                    <th class="py-4 px-6 text-center font-medium">Single Occupancy</th>
                                    <th class="py-4 px-6 text-center font-medium">Double Occupancy</th>
                                    <th class="py-4 px-6 text-center font-medium">Extra Bed</th>
                                    <th class="py-4 px-6 text-center font-medium">Inclusions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-100 hover:bg-[#0a7c15]/5 transition-colors duration-300 animate-fade-in"
                                    style="--delay: 100ms">
                                    <td class="py-4 px-6 text-left font-medium">Standard Room</td>
                                    <td class="py-4 px-6 text-center">$85</td>
                                    <td class="py-4 px-6 text-center">$100</td>
                                    <td class="py-4 px-6 text-center">$25</td>
                                    <td class="py-4 px-6 text-center">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#0a7c15]/10 text-[#0a7c15]">
                                            Breakfast
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-100 hover:bg-[#0a7c15]/5 transition-colors duration-300 animate-fade-in"
                                    style="--delay: 200ms">
                                    <td class="py-4 px-6 text-left font-medium">Deluxe Room</td>
                                    <td class="py-4 px-6 text-center">$110</td>
                                    <td class="py-4 px-6 text-center">$125</td>
                                    <td class="py-4 px-6 text-center">$30</td>
                                    <td class="py-4 px-6 text-center">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#0a7c15]/10 text-[#0a7c15]">
                                            Breakfast
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-100 hover:bg-[#0a7c15]/5 transition-colors duration-300 animate-fade-in"
                                    style="--delay: 300ms">
                                    <td class="py-4 px-6 text-left font-medium">Deluxe Suite</td>
                                    <td class="py-4 px-6 text-center">$145</td>
                                    <td class="py-4 px-6 text-center">$160</td>
                                    <td class="py-4 px-6 text-center">$35</td>
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex justify-center gap-1 flex-wrap">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#0a7c15]/10 text-[#0a7c15]">
                                                Breakfast
                                            </span>
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#6d6d18]/10 text-[#6d6d18]">
                                                Dinner
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-[#0a7c15]/5 transition-colors duration-300 animate-fade-in"
                                    style="--delay: 400ms">
                                    <td class="py-4 px-6 text-left font-medium">Family Villa</td>
                                    <td class="py-4 px-6 text-center">N/A</td>
                                    <td class="py-4 px-6 text-center">$210</td>
                                    <td class="py-4 px-6 text-center">$45</td>
                                    <td class="py-4 px-6 text-center">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#6d6d18]/20 text-[#6d6d18]">
                                            All Meals
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Enhanced Special Offers Section with Animation -->
            <div class="mt-24 translate-y-10 transition-all duration-1000 delay-700 ease-out" id="special-offers">
                <div class="text-center mb-12">
                    <span
                        class="inline-block px-4 py-1 bg-[#0a7c15]/10 text-[#0a7c15] rounded-full text-sm font-semibold mb-3">LIMITED
                        TIME</span>
                    <h3
                        class="text-3xl md:text-4xl font-bold mb-4 bg-gradient-to-r from-[#6d6d18] to-[#0a7c15] bg-clip-text text-transparent">
                        Exclusive Special Offers</h3>
                    <div class="flex items-center justify-center mb-5">
                        <div class="h-1 w-6 bg-[#6d6d18] rounded-full"></div>
                        <div class="h-1 w-16 bg-[#0a7c15] mx-2 rounded-full"></div>
                        <div class="h-1 w-6 bg-[#6d6d18] rounded-full"></div>
                    </div>
                    <p class="text-gray-700 max-w-2xl mx-auto">
                        Enhance your Bandipur experience with our exclusive packages and special offers designed to make
                        your stay unforgettable.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-5xl mx-auto" id="offers-container">
                    <!-- Special Offer 1 - Enhanced Design -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-xl relative group special-offer-card">
                        <div
                            class="absolute -right-16 -top-16 w-32 h-32 bg-gradient-to-br from-[#0a7c15] to-[#6d6d18] rounded-full opacity-10 group-hover:scale-150 transition-transform duration-500">
                        </div>
                        <div
                            class="absolute right-0 top-0 bg-gradient-to-l from-[#0a7c15] to-[#6d6d18] text-white px-5 py-2 font-bold text-sm clip-path-promo">
                            POPULAR
                        </div>

                        <div class="p-8 relative">
                            <div class="flex items-center mb-6">
                                <div
                                    class="bg-[#6d6d18]/70 p-4 rounded-full mr-5 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="h-8 w-8 text-[#6d6d18]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4
                                        class="text-2xl font-bold text-gray-800 mb-1 group-hover:text-[#0a7c15] transition-colors duration-300">
                                        Stay 3, Pay 2 Nights</h4>
                                    <div class="flex items-center">
                                        <span class="text-sm font-semibold text-[#0a7c15]">Limited time offer</span>
                                        <div class="flex items-center ml-3 text-amber-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=" mb-8">
                                <p class="text-gray-600 leading-relaxed">
                                    Extend your Bandipur adventure! Stay for three consecutive nights but only pay for two.
                                    Valid during off-season periods and includes daily breakfast and a complimentary guided
                                    village tour.
                                </p>
                            </div>

                            <div class="relative z-10 ">
                                <div class="flex flex-col gap-8 md:flex-row items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="text-sm font-bold mr-2 text-[#6d6d18]">Valid until:</span>
                                        <span class="text-sm text-gray-700">May 31, 2026</span>
                                    </div>
                                    <button
                                        class="relative overflow-hidden bg-white border-2 border-[#0a7c15] text-[#0a7c15] px-6 py-2 rounded-full font-medium group-hover:bg-[#0a7c15] group-hover:text-white transition-all duration-300">
                                        View Details
                                    </button>
                                </div>
                            </div>

                            <div
                                class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0a7c15] to-[#6d6d18] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                            </div>
                        </div>
                    </div>

                    <!-- Special Offer 2 - Enhanced Design -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-xl relative group special-offer-card">
                        <div
                            class="absolute -right-16 -top-16 w-32 h-32 bg-gradient-to-br from-[#0a7c15] to-[#6d6d18] rounded-full opacity-10 group-hover:scale-150 transition-transform duration-500">
                        </div>
                        <div
                            class="absolute right-0 top-0 bg-gradient-to-l from-[#0a7c15] to-[#6d6d18] text-white px-5 py-2 font-bold text-sm clip-path-promo">
                            EXCLUSIVE
                        </div>

                        <div class="p-8 relative">
                            <div class="flex items-center mb-6">
                                <div
                                    class="bg-[#6d6d18]/10 p-4 rounded-full mr-5 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="h-8 w-8 text-[#6d6d18]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h4
                                        class="text-2xl font-bold text-gray-800 mb-1 group-hover:text-[#0a7c15] transition-colors duration-300">
                                        Honeymoon Package</h4>
                                    <div class="flex items-center">
                                        <span class="text-sm font-semibold text-[#0a7c15]">15% discount</span>
                                        <div class="flex items-center ml-3 text-amber-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-8">
                                <p class="text-gray-600 leading-relaxed">
                                    Celebrate your love in the heart of Nepal with our romantic package. Includes candlelit
                                    dinner under the stars, couple's massage with Himalayan herbs, special room decoration,
                                    and a private sunset viewpoint excursion.
                                </p>
                            </div>

                            <div class="relative z-10 ">
                                <div class="flex flex-col md:flex-row gap-8 items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex flex-wrap gap-2">
                                            <span
                                                class="px-3 py-1 bg-[#0a7c15]/10 text-[#0a7c15] rounded-full text-xs font-medium">3-night
                                                minimum</span>
                                        </div>
                                    </div>
                                    <button
                                        class="relative overflow-hidden bg-white border-2 border-[#0a7c15] text-[#0a7c15] px-6 py-2 rounded-full font-medium group-hover:bg-[#0a7c15] group-hover:text-white transition-all duration-300">
                                        View Details
                                    </button>
                                </div>
                            </div>

                            <div
                                class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0a7c15] to-[#6d6d18] transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Policy Information with Animated Cards -->
            <div class="mt-24 opacity-0 translate-y-10 transition-all duration-1000 delay-900 ease-out" id="policy-section">
                <div class="text-center mb-12">
                    <span
                        class="inline-block px-4 py-1 bg-[#6d6d18]/10 text-[#6d6d18] rounded-full text-sm font-semibold mb-3">RESORT
                        POLICIES</span>
                    <h3
                        class="text-3xl md:text-4xl font-bold mb-4 bg-gradient-to-r from-[#6d6d18] to-[#0a7c15] bg-clip-text text-transparent">
                        Important Information</h3>
                    <div class="flex items-center justify-center mb-5">
                        <div class="h-1 w-6 bg-[#6d6d18] rounded-full"></div>
                        <div class="h-1 w-16 bg-[#0a7c15] mx-2 rounded-full"></div>
                        <div class="h-1 w-6 bg-[#6d6d18] rounded-full"></div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div
                        class="bg-white rounded-xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 policy-card">
                        <div
                            class="rounded-full bg-gradient-to-r from-[#0a7c15] to-[#0a7c15]/70 p-4 inline-flex text-white mb-6">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold mb-4 text-gray-800">Check-in & Check-out</h4>
                        <ul class="text-gray-700 space-y-3">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 mr-2 text-[#0a7c15] mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Check-in: 2:00 PM</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 mr-2 text-[#0a7c15] mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Check-out: 12:00 PM</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 mr-2 text-[#0a7c15] mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Early check-in and late check-out available upon request (fees may apply)</span>
                            </li>
                        </ul>
                    </div>

                    <div
                        class="bg-white rounded-xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 policy-card">
                        <div
                            class="rounded-full bg-gradient-to-r from-[#6d6d18] to-[#6d6d18]/70 p-4 inline-flex text-white mb-6">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold mb-4 text-gray-800">Cancellation Policy</h4>
                        <ul class="text-gray-700 space-y-3">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 mr-2 text-[#0a7c15] mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Free cancellation up to 7 days before arrival during off-season</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 mr-2 text-[#0a7c15] mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Free cancellation up to 14 days before arrival during peak season</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 mr-2 text-[#0a7c15] mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Late cancellations are subject to a one-night charge</span>
                            </li>
                        </ul>
                    </div>

                    <div
                        class="bg-white rounded-xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 policy-card">
                        <div
                            class="rounded-full bg-gradient-to-r from-[#0a7c15] to-[#6d6d18] p-4 inline-flex text-white mb-6">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold mb-4 text-gray-800">Payment Information</h4>
                        <ul class="text-gray-700 space-y-3">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 mr-2 text-[#0a7c15] mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>20% deposit required at time of booking</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 mr-2 text-[#0a7c15] mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Full payment collected 7 days prior to arrival</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 mr-2 text-[#0a7c15] mt-0.5 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>We accept major credit cards, bank transfers, and cash</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Enhanced Contact CTA with Advanced Animation -->
            <div class="mt-24 opacity-0 translate-y-10 transition-all duration-1000 delay-1000 ease-out" id="contact-cta">
                <div
                    class="relative bg-gradient-to-r from-[#0a7c15] to-[#6d6d18] p-8 md:p-12 rounded-2xl text-white shadow-2xl overflow-hidden transform transition-transform duration-500 hover:scale-[1.01] group">
                    <!-- Animated Background Elements -->
                    <div
                        class="absolute -right-12 -top-12 w-64 h-64 bg-white rounded-full opacity-10 group-hover:scale-125 transition-transform duration-700">
                    </div>
                    <div
                        class="absolute left-1/3 -bottom-24 w-64 h-64 bg-white rounded-full opacity-10 group-hover:scale-125 transition-transform duration-700 delay-100">
                    </div>

                    <!-- Floating Elements -->
                    <div class="absolute right-1/4 top-1/4 w-6 h-6 rounded-full bg-white opacity-20 animate-float"></div>
                    <div
                        class="absolute left-1/3 bottom-1/3 w-8 h-8 rounded-full bg-white opacity-20 animate-float-delayed">
                    </div>

                    <div class="relative z-10 text-center max-w-3xl mx-auto">
                        <h3 class="text-2xl md:text-4xl font-bold mb-4">Need More Information?</h3>
                        <p class="text-lg md:text-xl text-white/80 mb-8 max-w-2xl mx-auto">
                            Our friendly staff are available to answer any questions about rates, availability, or special
                            requirements for your stay in Bandipur.
                        </p>
                        <a href='{{ route('contact') }}'>
                            <button
                                class="bg-white text-[#0a7c15] px-8 py-4 rounded-full font-bold shadow-lg transform transition-all duration-300 hover:scale-105 hover:shadow-xl group-hover:bg-opacity-100">
                                <div class="flex items-center">
                                    <span>Contact Us</span>
                                    <svg class="ml-2 h-5 w-5 transform group-hover:translate-x-1 transition-transform duration-300"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </div>
                            </button>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/9779812345678" target="_blank"
        class="fixed bottom-8 right-8 z-50 bg-[#25D366] text-white w-16 h-16 rounded-full flex items-center justify-center shadow-2xl hover:bg-[#128C7E] transition-all duration-300 hover:scale-110 animate-bounce">
        <i class="fab fa-whatsapp text-4xl"></i>
    </a>

    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Reveal animations on scroll
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = "1";
                            entry.target.style.transform = "translateY(0)";
                        }
                    });
                }, {
                    threshold: 0.1
                });

                // Observe all sections that should animate on scroll
                observer.observe(document.getElementById('section-header'));
                observer.observe(document.getElementById('season-toggle'));
                observer.observe(document.getElementById('rate-table-section'));
                observer.observe(document.getElementById('special-offers'));
                observer.observe(document.getElementById('policy-section'));
                observer.observe(document.getElementById('contact-cta'));

                // Staggered animation for cards
                const cards = document.querySelectorAll('.card-animate');
                cards.forEach((card, index) => {
                    card.style.opacity = "0";
                    card.style.transform = "translateY(40px)";
                    card.style.transition = "opacity 0.6s ease, transform 0.6s ease";
                    card.style.transitionDelay = `${index * 200}ms`;

                    setTimeout(() => {
                        card.style.opacity = "1";
                        card.style.transform = "translateY(0)";
                    }, 500);
                });

                const policyCards = document.querySelectorAll('.policy-card');
                policyCards.forEach((card, index) => {
                    card.style.opacity = "1";
                    card.style.transform = "translateY(20px)";
                    card.style.transition = "opacity 0.5s ease, transform 0.5s ease";
                    card.style.transitionDelay = `${index * 150}ms`;
                });

                const offerCards = document.querySelectorAll('.special-offer-card');
                offerCards.forEach((card, index) => {
                    card.style.opacity = "1";
                    card.style.transform = "translateY(20px)";
                    card.style.transition = "opacity 0.5s ease, transform 0.5s ease";
                    card.style.transitionDelay = `${index * 200}ms`;
                });

                // Enhanced Seasonal Toggle functionality
                const seasonalBtn = document.getElementById('seasonalBtn');
                const offSeasonBtn = document.getElementById('offSeasonBtn');
                const toggleBackground = document.getElementById('toggleBackground');
                const seasonalRates = document.querySelectorAll('.seasonal-rate');
                const offSeasonalRates = document.querySelectorAll('.off-seasonal-rate');

                // Card toggle with enhanced slider effect
                seasonalBtn.addEventListener('click', function () {
                    toggleBackground.style.transform = 'translateX(0)';
                    seasonalBtn.classList.add('text-white');
                    seasonalBtn.classList.remove('text-gray-700');
                    offSeasonBtn.classList.remove('text-white');
                    offSeasonBtn.classList.add('text-gray-700');

                    seasonalRates.forEach(rate => {
                        rate.classList.remove('hidden');
                        rate.classList.add('block');
                    });
                    offSeasonalRates.forEach(rate => {
                        rate.classList.add('hidden');
                        rate.classList.remove('block');
                    });
                });

                offSeasonBtn.addEventListener('click', function () {
                    toggleBackground.style.transform = 'translateX(100%)';
                    offSeasonBtn.classList.add('text-white');
                    offSeasonBtn.classList.remove('text-gray-700');
                    seasonalBtn.classList.remove('text-white');
                    seasonalBtn.classList.add('text-gray-700');

                    offSeasonalRates.forEach(rate => {
                        rate.classList.remove('hidden');
                        rate.classList.add('block');
                    });
                    seasonalRates.forEach(rate => {
                        rate.classList.add('hidden');
                        rate.classList.remove('block');
                    });
                });

                // Enhanced Table Toggle functionality
                const tableSeasonalBtn = document.getElementById('tableSeasonalBtn');
                const tableOffSeasonBtn = document.getElementById('tableOffSeasonBtn');
                const tableToggleBackground = document.getElementById('tableToggleBackground');
                const seasonalTable = document.getElementById('seasonalTable');
                const offSeasonTable = document.getElementById('offSeasonTable');

                tableSeasonalBtn.addEventListener('click', function () {
                    tableToggleBackground.style.transform = 'translateX(0)';
                    tableSeasonalBtn.classList.add('text-white');
                    tableSeasonalBtn.classList.remove('text-gray-700');
                    tableOffSeasonBtn.classList.remove('text-white');
                    tableOffSeasonBtn.classList.add('text-gray-700');

                    seasonalTable.classList.remove('hidden');
                    seasonalTable.classList.add('block');
                    offSeasonTable.classList.add('hidden');
                    offSeasonTable.classList.remove('block');

                    // Animate rows
                    animateTableRows(seasonalTable);
                });

                tableOffSeasonBtn.addEventListener('click', function () {
                    tableToggleBackground.style.transform = 'translateX(100%)';
                    tableOffSeasonBtn.classList.add('text-white');
                    tableOffSeasonBtn.classList.remove('text-gray-700');
                    tableSeasonalBtn.classList.remove('text-white');
                    tableSeasonalBtn.classList.add('text-gray-700');

                    offSeasonTable.classList.remove('hidden');
                    offSeasonTable.classList.add('block');
                    seasonalTable.classList.add('hidden');
                    seasonalTable.classList.remove('block');

                    // Animate rows
                    animateTableRows(offSeasonTable);
                });

                // Function to animate table rows when shown
                function animateTableRows(table) {
                    const rows = table.querySelectorAll('tbody tr');
                    rows.forEach((row, index) => {
                        row.style.animationDelay = `${index * 100}ms`;
                        row.style.animationPlayState = 'running';
                    });
                }

                // Initialize first table animation
                animateTableRows(seasonalTable);
            });
        </script>
    @endpush
@endsection