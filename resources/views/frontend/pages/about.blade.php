@extends('frontend.app')
{{-- background-image: linear-gradient(135deg, #0a7c15 0%, #1a1a0a 50%, #6d6d18 100%); --}}
@section('content')
    @push('style')
        <style>
            .font-playfair {
                font-family: 'Playfair Display', serif;
            }

            .font-poppins {
                font-family: 'Poppins', sans-serif;
            }

            /* Ken Burns Effect for Hero */
            @keyframes zoomSlow {
                0% {
                    transform: scale(1);
                }

                100% {
                    transform: scale(1.1);
                }
            }

            .animate-ken-burns {
                animation: zoomSlow 20s ease-in-out infinite alternate;
            }

            /* Custom Reveal Animation */
            .reveal-up {
                opacity: 0;
                transform: translateY(50px);
                transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
            }

            .reveal-up.active {
                opacity: 1;
                transform: translateY(0);
            }

            /* Accordion Expansion Animation */
            .activity-card {
                flex: 1;
                transition: flex 0.7s cubic-bezier(0.25, 1, 0.5, 1);
            }

            .activity-card:hover {
                flex: 3;
            }

            /* Hide text when compressed, show when expanded */
            .activity-content {
                opacity: 0;
                transform: translateY(20px);
                transition: all 0.5s ease;
                transition-delay: 0.1s;
            }

            .activity-card:hover .activity-content {
                opacity: 1;
                transform: translateY(0);
            }

            /* Vertical Text Utility */
            .writing-vertical {
                writing-mode: vertical-rl;
                text-orientation: mixed;
            }
        </style>
    @endpush
    {{-- --}}
    {{-- hero --}}
    <section class="relative h-screen flex items-center justify-center overflow-hidden bg-black">
        <div class="absolute inset-0 z-0">
            {{-- <img src="{{ asset('frontendimages/location.png') }}" alt="Bandipur mountains at sunrise"
                class="w-full h-full object-cover animate-ken-burns filter brightness-[0.6]"> --}}
            @if ($hero)
                <img src="{{ asset('storage/' . $hero->image) }}" alt="Bandipur mountains at sunrise"
                    class="w-full h-full object-cover animate-ken-burns filter brightness-[0.6]">
            @endif
        </div>
        <div class="absolute inset-0 z-10 bg-gradient-to-t from-(--primary)/40 via-transparent to-black/80"></div>

        <div class="relative z-20 text-center px-6 max-w-5xl">
            <div class="reveal-up overflow-hidden mb-4">
                @if ($header)
                    {{-- <span
                    class="text-slate-200 font-semibold uppercase tracking-[0.4em] text-[9px] md:text-base block bg-white/20 backdrop-blur-md py-2 px-6 inline-block rounded-full border border-[#6d6d18]/30">
                    The Hidden Treasure of Gurung Hill
                </span> --}}
                    <span
                        class="text-slate-200 font-semibold uppercase tracking-[0.4em] text-[9px] md:text-base block bg-white/20 backdrop-blur-md py-2 px-6 inline-block rounded-full border border-[#6d6d18]/30">
                        {{ $header->badge_text }}
                    </span>
            </div>
            {{-- <h1
                class="reveal-up delay-200 text-5xl md:text-7xl lg:text-8xl font-serif text-white leading-tight mb-8 drop-shadow-lg">
                A Sanctuary Suspended in <span class="italic ">Time</span>
            </h1> --}}
            <h1
                class="reveal-up delay-200 text-5xl md:text-7xl lg:text-8xl font-serif text-white leading-tight mb-8 drop-shadow-lg">
                {!! $header->heading !!}
            </h1>
            {{-- <p class="reveal-up delay-400 text-stone-100 text-lg md:text-2xl max-w-3xl mx-auto leading-relaxed font-light">
                Experience the Living Museum of Nepal. Where 18th-century Newari elegance meets the breathtaking
                panorama of the Himalayas.
            </p> --}}
            <p class="reveal-up delay-400 text-stone-100 text-lg md:text-2xl max-w-3xl mx-auto leading-relaxed font-light">
                {{ $header->description }}
            </p>
            @endif

        </div>

        <a href='#about'
            class="absolute bottom-10 -translate-x-1/2 z-20 flex flex-col text-center mx-auto items-center gap-2 opacity-60 cursor-pointer animate-bounce">
            <span class="text-white text-xs uppercase tracking-widest">Scroll to Discover</span>
            <i class="fa-solid fa-angles-down text-3xl text-white"></i>
        </a>
    </section>
    {{-- end hero --}}

    <!-- ABOUT DESCRIPTION SECTION -->
    <section id="about" class="py-[70px]"></section>
    <section class="pb-24 bg-white overflow-hidden relative">
        <!-- Decorative background leaf pattern (Subtle) -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-[#0a7c15]/5 rounded-bl-full -z-10"></div>

        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center">

                <!-- Left Side: Image Composition -->
                <div class="w-full lg:w-1/2 relative mb-16 lg:mb-0 pr-0 lg:pr-10 fade-in-section">
                    <!-- Decorative Border Box behind main image -->
                    <div
                        class="absolute top-4 left-4 w-full h-full border-2 border-[#6d6d18] rounded-lg -z-10 transform translate-x-4 translate-y-4">
                    </div>

                    <!-- Main Image (Resort/Architecture) -->
                    @foreach ($photos as $photo)
                        <div class="relative overflow-hidden rounded-lg shadow-xl group">
                            {{-- <img src="{{ asset('frontendimages/location.png') }}" alt="Bandipur Architecture"
                            class="w-full h-[500px] object-cover transition-transform duration-700 group-hover:scale-105"> --}}
                            <img src="{{ asset('storage/' . $photo->image_primary) }}"
                                alt="{{ $photo->title ?? 'Who We Are' }}"
                                class="w-full h-[500px] object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/80"></div>
                            <!-- Floating Badge -->
                            <div
                                class="absolute top-6 left-6 bg-white/95 backdrop-blur-sm px-6 py-3 shadow-lg border-l-4 border-[#0a7c15]">
                                {{-- <p class="font-['Playfair_Display'] font-bold text-[#1a1a1a] text-xl">1,030m</p> --}}
                                @if ($photo->title)
                                    <p class="font-['Playfair_Display'] font-bold text-[#1a1a1a] text-xl mt-2">
                                        {{ $photo->title }}</p>
                                @endif
                                {{-- <p class="text-xs uppercase tracking-widest text-[#6d6d18]">Elevation</p> --}}
                                @if ($photo->subtitle)
                                    <p class="text-xs uppercase tracking-widest text-[#6d6d18]">{{ $photo->subtitle }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Secondary Overlapping Image (Detail/Nature) -->
                        <div
                            class="absolute -bottom-10 -right-6 w-2/5 border-8 border-white rounded-lg shadow-2xl hidden md:block">
                            <img src="{{ asset('storage/' . $photo->image_secondary) }}" alt="Detail Image"
                                class="w-full h-auto object-cover">
                        </div>
                    @endforeach

                </div>

                <!-- Right Side: Text Content -->
                <div class="w-full lg:w-1/2 lg:pl-12 fade-in-section" style="transition-delay: 200ms;">
                    @if ($whoWeAre)
                        <h5
                            class="text-[#0a7c15] font-bold uppercase tracking-[0.2em] text-sm mb-4 flex items-center gap-3">
                            {{-- <span class="w-8 h-[2px] bg-[#0a7c15]"></span> Who We Are --}}
                            <span class="w-8 h-[2px] bg-[#0a7c15]"></span> {{ $whoWeAre->badge_text }}
                        </h5>

                        <h2
                            class="text-4xl md:text-5xl font-['Playfair_Display'] font-bold text-[#1a1a1a] mb-6 leading-tight">
                            {{-- The Soul of Bandipur, <br>
                        <span class="text-[#6d6d18] italic">The Heart of Nature.</span> --}}
                            {!! $whoWeAre->heading !!}
                        </h2>

                        {{-- <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        Bandipur, an ancient Newari mountain town, is a treasure waiting to be discovered by travelers.
                        Situated 7 kilometers above Dumbre Bazaar at an altitude of 1,005 meters, this ancient trading post
                        lies cradled in the saddle of some of the country’s most peculiar-shaped hills. Untouched by
                        modernization, and laced with an abundance of ancient houses, temples of great significance, and
                        historical architecture, this medieval-era town boasts of festivals all year around besides offering
                        a plethora of cultures.
                        </p> --}}
                        <p class="text-gray-600 text-lg leading-relaxed mb-6">
                            {{ $whoWeAre->description }}
                        </p>

                        <!-- Icon Highlights -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 border-t border-gray-100 pt-8">
                            {{-- <div class="flex flex-col gap-2">
                                <i class="fas fa-leaf text-[#0a7c15] text-2xl mb-1"></i>
                                <h4 class="font-bold font-['Playfair_Display'] text-lg">Eco-First</h4>
                                <p class="text-xs text-gray-500 leading-snug">Sustainable energy & plastic-free zones.</p>
                            </div>
                            <div class="flex flex-col gap-2">
                                <i class="fas fa-gopuram text-[#6d6d18] text-2xl mb-1"></i> <!-- Heritage Icon -->
                                <h4 class="font-bold font-['Playfair_Display'] text-lg">Heritage</h4>
                                <p class="text-xs text-gray-500 leading-snug">Authentic Newari brick & wood design.</p>
                            </div>
                            <div class="flex flex-col gap-2">
                                <i class="fas fa-cloud-sun text-[#0a7c15] text-2xl mb-1"></i>
                                <h4 class="font-bold font-['Playfair_Display'] text-lg">Serenity</h4>
                                <p class="text-xs text-gray-500 leading-snug">Uninterrupted views of the Annapurnas.</p>
                            </div> --}}
                            {{-- Feature 1 --}}
                            <div class="flex flex-col gap-2">
                                <i class="{{ $whoWeAre->f1_icon }} text-[#0a7c15] text-2xl mb-1"></i>
                                <h4 class="font-bold font-['Playfair_Display'] text-lg">{{ $whoWeAre->f1_title }}</h4>
                                <p class="text-xs text-gray-500 leading-snug">{{ $whoWeAre->f1_desc }}</p>
                            </div>
                            {{-- Feature 2 --}}
                            <div class="flex flex-col gap-2">
                                <i class="{{ $whoWeAre->f2_icon }} text-[#6d6d18] text-2xl mb-1"></i>
                                <h4 class="font-bold font-['Playfair_Display'] text-lg">{{ $whoWeAre->f2_title }}</h4>
                                <p class="text-xs text-gray-500 leading-snug">{{ $whoWeAre->f2_desc }}</p>
                            </div>
                            {{-- Feature 3 --}}
                            <div class="flex flex-col gap-2">
                                <i class="{{ $whoWeAre->f3_icon }} text-[#0a7c15] text-2xl mb-1"></i>
                                <h4 class="font-bold font-['Playfair_Display'] text-lg">{{ $whoWeAre->f3_title }}</h4>
                                <p class="text-xs text-gray-500 leading-snug">{{ $whoWeAre->f3_desc }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <main class="bg-[#f8f5f2] text-[#1a1a1a] overflow-x-hidden ">
        <!-- SECTION 1: ABOUT THE RESORT (Architectural Hero) -->
        <section class="relative  mx-auto container flex flex-col md:flex-row">
            <!-- Text Column -->
            <div class="w-full md:w-5/12 bg-[#0a7c15] text-white flex flex-col justify-center p-12 md:p-20 relative z-20">
                <span
                    class="text-neutral-50 bg-[#6d6d18] px-4 py-1 inline-block w-max text-xs uppercase tracking-widest mb-6">Since
                    1998</span>
                <h1 class="text-5xl md:text-7xl font-['Playfair_Display'] font-medium leading-none mb-8 reveal-up">
                    The Estate <br> <span class="italic bg-[#6d6d18] font-serif">in the Clouds</span>
                </h1>
                <p class="text-white/80 font-light text-lg leading-relaxed mb-10 reveal-up"
                    style="transition-delay: 100ms;">
                    We are not just a hotel; we are a restoration project. Located 1,030m above sea level, our property is a
                    living museum of Newari craftsmanship, surrounded by the silence of the Himalayas.
                </p>
                <div class="flex gap-4 reveal-up" style="transition-delay: 200ms;">
                    <div class="text-center">
                        <span class="block text-3xl font-['Playfair_Display']">25</span>
                        <span class="text-xs uppercase text-neutral-50">Suites</span>
                    </div>
                    <div class="w-px bg-white/20"></div>
                    <div class="text-center">
                        <span class="block text-3xl font-['Playfair_Display']">4</span>
                        <span class="text-xs uppercase text-neutral-50">Acres</span>
                    </div>
                    <div class="w-px bg-white/20"></div>
                    <div class="text-center">
                        <span class="block text-3xl font-['Playfair_Display']">360°</span>
                        <span class="text-xs uppercase text-neutral-50  ">Views</span>
                    </div>
                </div>
            </div>
            <!-- Image Column -->
            <div class="w-full md:w-7/12 h-[50vh] md:h-auto overflow-hidden relative">
                <img src="{{ asset('frontendimages/garden.png') }}"
                    class="absolute inset-0 w-full h-full object-cover animate-ken-burns">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-black/80"></div>
                <div
                    class="absolute bottom-10 left-10 bg-white/90 p-4 max-w-xs backdrop-blur-sm border-l-4 border-[#6d6d18] hidden md:block">
                    <p class="text-[#0a7c15] font-['Playfair_Display'] italic">"A masterpiece of preservation."</p>
                </div>
            </div>
        </section>



        <!-- SECTION 3: CUISINE (Clean & Organic) -->
        <section class="py-24 bg-[#f8f5f2] relative">
            <div class="container mx-auto px-6">
                <div class="flex flex-col md:flex-row items-center gap-20">
                    <!-- Text -->
                    <div class="w-full md:w-1/2 order-2 md:order-1 reveal-up">
                        <h4 class="text-[#0a7c15] uppercase tracking-[0.3em] text-sm font-bold mb-4">Farm to Fork</h4>
                        <h2 class="text-5xl font-['Playfair_Display'] text-[#1a1a1a] mb-6">Flavors of the Hills</h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Our cuisine is a tribute to the fertile lands of Tanahun. We don't just cook; we harvest. 70% of
                            the vegetables on your plate come from our organic gardens located right behind the kitchen.
                        </p>
                        <p class="text-gray-600 leading-relaxed mb-8">
                            Experience the traditional <span class="text-[#0a7c15] font-bold">Samay Baji</span> set or
                            indulge in continental classics infused with Himalayan herbs.
                        </p>

                        <div class="grid grid-cols-2 gap-8 mt-8">
                            <div>
                                <i class="fas fa-leaf text-4xl text-[#0a7c15] mb-3"></i>
                                <h5 class="font-['Playfair_Display'] font-bold text-xl">Organic</h5>
                                <p class="text-sm text-gray-500">Pesticide-free garden</p>
                            </div>
                            <div>
                                <i class="fas fa-wine-glass-alt text-4xl text-[#0a7c15] mb-3"></i>
                                <h5 class="font-['Playfair_Display'] font-bold text-xl">Cellar</h5>
                                <p class="text-sm text-gray-500">Curated wine selection</p>
                            </div>
                        </div>
                    </div>

                    <!-- Image (Arch Shape) -->
                    <div class="w-full md:w-1/2 order-1 md:order-2 relative reveal-up">
                        <div class="relative z-10 border-8 border-[#6d6d18]">
                            <img src="{{ asset('frontendimages/site_view.png') }}"
                                class="w-full mx-auto  shadow-2xl h-[500px] object-cover ">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/60"></div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 4: WHAT WE DO (Interactive Accordion) -->
        <section class="bg-white py-20">
            <div class="container mx-auto px-6 mb-12 text-center">
                <h2 class="text-4xl font-['Playfair_Display'] text-[#0a7c15] italic">Curated Experiences</h2>
                <p class="text-[#6d6d18] uppercase tracking-widest text-xs mt-2">Beyond the room</p>
            </div>

            <!-- Accordion Container -->
            <div
                class="h-[500px] md:h-[600px] w-full flex flex-col md:flex-row overflow-hidden border-y border-[#6d6d18]/20">

                <!-- Item 1 -->
                <div
                    class="activity-card relative bg-black overflow-hidden cursor-pointer group border-b md:border-b-0 md:border-r border-white/20">
                    <img src="{{ asset('frontendimages/garden2.png') }}"
                        class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity duration-500">
                    <div
                        class="absolute inset-0  group-hover:bg-gradient-to-t from-black/80 via-transparent to-black/80 transition-colors">
                    </div>

                    <div class="absolute bottom-0 left-0 w-full p-8 text-white z-10">
                        <h3
                            class="text-2xl font-['Playfair_Display'] font-bold mb-2 text-neutral-50 group-hover:text-white transition-colors">
                            Morning Yoga</h3>
                        <div class="activity-content h-0 md:h-auto overflow-hidden">
                            <p class="text-sm font-light leading-relaxed max-w-xs">Greet the sun rising over the Himalayas.
                                Complimentary sessions every morning at our deck.</p>
                        </div>
                    </div>
                    <!-- Mobile Label -->
                    <div class="absolute top-4 right-4 md:hidden text-white"><i class="fas fa-chevron-down"></i></div>
                </div>

                <!-- Item 2 -->
                <div
                    class="activity-card relative bg-black overflow-hidden cursor-pointer group border-b md:border-b-0 md:border-r border-white/20">
                    <img src="{{ asset('frontendimages/bandipur1.png') }}"
                        class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity duration-500">
                    <div
                        class="absolute inset-0 group-hover:bg-gradient-to-t from-black/80 via-transparent to-black/80 transition-colors">
                    </div>

                    <div class="absolute bottom-0 left-0 w-full p-8 text-white z-10">
                        <h3
                            class="text-2xl font-['Playfair_Display'] font-bold mb-2 text-neutral-50 group-hover:text-white transition-colors">
                            Village Walk</h3>
                        <div class="activity-content h-0 md:h-auto overflow-hidden">
                            <p class="text-sm font-light leading-relaxed max-w-xs">Guided cultural tours through the
                                cobbled
                                streets of Old Bandipur bazaar.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 3 -->
                <div
                    class="activity-card relative bg-black overflow-hidden cursor-pointer group border-b md:border-b-0 md:border-r border-white/20">
                    <img src="{{ asset('frontendimages/garden.png') }}"
                        class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity duration-500">
                    <div
                        class="absolute inset-0 group-hover:bg-gradient-to-t from-black/80 via-transparent to-black/80 transition-colors">
                    </div>

                    <div class="absolute bottom-0 left-0 w-full p-8 text-white z-10">
                        <h3
                            class="text-2xl font-['Playfair_Display'] font-bold mb-2 text-neutral-50 group-hover:text-white transition-colors">
                            Hiking</h3>
                        <div class="activity-content h-0 md:h-auto overflow-hidden">
                            <p class="text-sm font-light leading-relaxed max-w-xs">Trek to the Siddha Gufa (Cave) or the
                                Ramkot village for an authentic rural experience.</p>
                        </div>
                    </div>
                </div>

                <!-- Item 4 -->
                <div class="activity-card relative bg-black overflow-hidden cursor-pointer group">
                    <img src="{{ asset('frontendimages/cusin.png') }}"
                        class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-100 transition-opacity duration-500">
                    <div
                        class="absolute inset-0 group-hover:bg-gradient-to-t from-black/80 via-transparent to-black/80 transition-colors">
                    </div>

                    <div class="absolute bottom-0 left-0 w-full p-8 text-white z-10">
                        <h3
                            class="text-2xl font-['Playfair_Display'] font-bold mb-2 text-neutral-50 group-hover:text-white transition-colors">
                            Stargazing</h3>
                        <div class="activity-content h-0 md:h-auto overflow-hidden">
                            <p class="text-sm font-light leading-relaxed max-w-xs">With minimal light pollution, our
                                terrace
                                offers a spectacular view of the Milky Way.</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        {{-- SECTION QUOTE 5 --}}
        <section class="relative py-24 px-6 overflow-hidden bg-white">
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-50 rounded-full blur-3xl opacity-50 -z-10">
            </div>

            <div class="max-w-5xl mx-auto text-center">
                <div class="mb-8 animate-bounce transition-all duration-1000">
                    <i class="fa-solid fa-mountain-sun text-4xl text-[#0a7c15] opacity-60"></i>
                </div>

                <div class="space-y-8">
                    <p class="text-slate-500 uppercase tracking-[0.3em] text-sm font-poppins font-light">The Spirit of
                        Bandipur</p>

                    <h2 class="font-playfair text-3xl md:text-5xl text-slate-800 leading-tight italic px-4">
                        "Unlike the busy streets of Kathmandu or Pokhara, Bandipur is a place for <span
                            class="text-[#6d6d18] not-italic font-bold">slow travel</span>, where peace is not the absence
                        of noise, but the presence of serenity."
                    </h2>
                </div>


            </div>
        </section>
    </main>
    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/9779812345678" target="_blank"
        class="fixed bottom-8 right-8 z-50 bg-[#25D366] text-white w-16 h-16 rounded-full flex items-center justify-center shadow-2xl hover:bg-[#128C7E] transition-all duration-300 hover:scale-110 animate-bounce">
        <i class="fab fa-whatsapp text-4xl"></i>
    </a>
    {{-- --}}
    @push('script')
        <script>
            // --- Javascript Intersection Observer for Animations ---

            const observerOptions = {
                root: null, // viewport
                threshold: 0.2, // Trigger when 20% of the element is visible
                rootMargin: "0px"
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    // If element is in view
                    if (entry.isIntersecting) {
                        // Add 'active' class to trigger CSS transitions
                        entry.target.classList.add('active');
                        // Optional: Stop observing once animated (for performance)
                        // observer.unobserve(entry.target); 
                    }
                    // Optional: Remove 'active' if you want them to re-animate on scroll up
                    // else {
                    //    entry.target.classList.remove('active');
                    // }
                });
            }, observerOptions);

            // Target all elements with reveal classes
            document.querySelectorAll('.reveal-up, .curtain-reveal').forEach(el => {
                observer.observe(el);
            });
        </script>

        <!-- Scripts -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('active');
                        }
                    });
                }, {
                    threshold: 0.1
                });

                document.querySelectorAll('.reveal-up').forEach(el => observer.observe(el));
            });
        </script>
    @endpush
@endsection
