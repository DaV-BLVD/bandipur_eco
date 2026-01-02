@extends('frontend.app')

@section('content')
    @push('style')
        <style>
            /* Custom Animation Classes since we aren't using external libs */
            .fade-in-section {
                opacity: 0;
                transform: translateY(40px);
                transition: opacity 0.8s ease-out, transform 0.8s ease-out;
                will-change: opacity, visibility;
            }

            .fade-in-section.is-visible {
                opacity: 1;
                transform: none;
            }

            /* Image Zoom on Hover */
            .room-img-wrapper img {
                transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }

            .group:hover .room-img-wrapper img {
                transform: scale(1.1);
            }
        </style>
    @endpush

    <section class="font-['Lato'] bg-gray-50 text-gray-800 antialiased">

        <!-- Hero Section -->
        <header class="relative h-[85vh] min-h-[500px] flex items-center justify-center overflow-hidden">
            <!-- Background Image -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('frontendimages/way_to_room.png') }}" alt="Bandipur Architecture"
                    class="w-full h-full object-cover brightness-[0.7]">
            </div>
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#0a7c15]/40 via-transparent to-black/70"></div>

            <!-- Content -->
            <div class="relative z-10 text-center px-4 fade-in-section">
                <span
                    class="inline-block py-1 px-3 border border-[#6d6d18] text-[#6d6d18] bg-white/90 uppercase tracking-[0.2em] text-xs font-bold mb-4 rounded-sm shadow-lg">
                    The Heritage Experience
                </span>
                <h1 class="text-5xl md:text-7xl font-['Playfair_Display'] text-white font-bold mb-6 drop-shadow-2xl">
                    Rest in Nature's Lap
                </h1>
                <p class="text-gray-100 text-lg md:text-xl max-w-2xl mx-auto font-light leading-relaxed">
                    Traditional Newari aesthetics meet modern hillside luxury. Choose your perfect sanctuary.
                </p>
            </div>
        </header>

        <!-- Filter Buttons -->
        <section class="py-12 bg-white sticky top-[70px] z-40 shadow-sm border-b border-gray-100">
            <div class="container mx-auto px-6">
                <div class="flex flex-wrap justify-center gap-3 md:gap-6 fade-in-section">
                    <button onclick="filterRooms('all')"
                        class="filter-btn active px-6 py-2 rounded-full border border-[#0a7c15] bg-[#0a7c15] text-white font-semibold text-sm tracking-wide hover:shadow-lg transition-all duration-300">All
                        Rooms</button>
                    <button onclick="filterRooms('single')"
                        class="filter-btn px-6 py-2 rounded-full border border-[#0a7c15] text-[#0a7c15] bg-transparent hover:bg-[#0a7c15] hover:text-white font-semibold text-sm tracking-wide hover:shadow-lg transition-all duration-300">Single</button>
                    <button onclick="filterRooms('double')"
                        class="filter-btn px-6 py-2 rounded-full border border-[#0a7c15] text-[#0a7c15] bg-transparent hover:bg-[#0a7c15] hover:text-white font-semibold text-sm tracking-wide hover:shadow-lg transition-all duration-300">Double</button>
                    <button onclick="filterRooms('others')"
                        class="filter-btn px-6 py-2 rounded-full border border-[#0a7c15] text-[#0a7c15] bg-transparent hover:bg-[#0a7c15] hover:text-white font-semibold text-sm tracking-wide hover:shadow-lg transition-all duration-300">Others</button>
                </div>
            </div>
        </section>

        <!-- Room Grid -->
        <section class="py-20 bg-[#f9f9f9]">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" id="room-grid">

                    <!-- Room 1: solo -->
                    <div
                        class="room-card single group bg-white rounded-lg shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden fade-in-section border-t-4 border-transparent hover:border-[#6d6d18]">
                        <div class="relative h-64 overflow-hidden room-img-wrapper">
                            <img src="{{ asset('frontendimages/rooms/single.png') }}" class="w-full h-full object-cover"
                                alt="Deluxe Room">
                            <div
                                class="absolute bottom-0 left-0 bg-[#0a7c15] text-white text-xs px-4 py-1 font-bold uppercase tracking-wider">
                                Mountain View</div>
                        </div>
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-4">
                                <h3
                                    class="text-2xl font-['Playfair_Display'] font-bold text-gray-900 group-hover:text-[#0a7c15] transition-colors">
                                    Single</h3>
                                <div class="text-right">
                                    <p class="text-xl font-bold text-[#6d6d18]">$90</p>
                                    <p class="text-xs text-gray-400">/ night</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6">Experience the sunrise over the Himalayas
                                from your private balcony. Features local wood furnishings and modern amenities.</p>

                            <div class="flex items-center gap-4 text-[#6d6d18] text-sm mb-6 border-t border-gray-100 pt-4">
                                <span title="solo"><i class="fas fa-user"></i> solo</span>
                                <span title="solo"><i class="fas fa-bed"></i> solo</span>
                                <span title="Wifi"><i class="fas fa-wifi"></i> Wifi</span>
                            </div>


                        </div>
                    </div>

                    <!-- Room 2: couple -->
                    <div
                        class="room-card single group bg-white rounded-lg shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden fade-in-section border-t-4 border-transparent hover:border-[#6d6d18]">
                        <div class="relative h-64 overflow-hidden room-img-wrapper">
                            <img src="{{ asset('frontendimages/rooms/double.png') }}" class="w-full h-full object-cover"
                                alt="Suite">
                            <div
                                class="absolute top-4 right-4 bg-[#6d6d18] text-white rounded-full w-12 h-12 flex items-center justify-center font-['Playfair_Display'] text-lg shadow-lg">
                                ★</div>
                        </div>
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-4">
                                <h3
                                    class="text-2xl font-['Playfair_Display'] font-bold text-gray-900 group-hover:text-[#0a7c15] transition-colors">
                                    Couple Room</h3>
                                <div class="text-right">
                                    <p class="text-xl font-bold text-[#6d6d18]">$180</p>
                                    <p class="text-xs text-gray-400">/ night</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6">Our most luxurious offering featuring a
                                separate living area, bathtub with view, and traditional Newari decor.</p>

                            <div class="flex items-center gap-4 text-[#6d6d18] text-sm mb-6 border-t border-gray-100 pt-4">
                                <span title="2 Guests"><i class="fas fa-user-friends"></i> couple</span>
                                <span title="King Bed"><i class="fas fa-bed"></i> king</span>
                                <span title="Wifi"><i class="fas fa-wifi"></i> Wifi</span>
                            </div>


                        </div>
                    </div>

                    <!-- Room 3: twin -->
                    <div
                        class="room-card double group bg-white rounded-lg shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden fade-in-section border-t-4 border-transparent hover:border-[#6d6d18]">
                        <div class="relative h-64 overflow-hidden room-img-wrapper">
                            <img src="{{ asset('frontendimages/rooms/twin.png') }}" class="w-full h-full object-cover"
                                alt="Cottage">
                            <div
                                class="absolute bottom-0 left-0 bg-[#6d6d18] text-white text-xs px-4 py-1 font-bold uppercase tracking-wider">
                                Garden Access</div>
                        </div>
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-4">
                                <h3
                                    class="text-2xl font-['Playfair_Display'] font-bold text-gray-900 group-hover:text-[#0a7c15] transition-colors">
                                    Twin</h3>
                                <div class="text-right">
                                    <p class="text-xl font-bold text-[#6d6d18]">$140</p>
                                    <p class="text-xs text-gray-400">/ night</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6">A standalone stone house surrounded by our
                                organic gardens. Perfect for privacy and connecting with nature.</p>

                            <div class="flex items-center gap-4 text-[#6d6d18] text-sm mb-6 border-t border-gray-100 pt-4">
                                <span title="2 Guests"><i class="fas fa-user-friends"></i> 2 person</span>
                                <span title="King Bed"><i class="fas fa-bed"></i> solo</span>
                                <span title="Wifi"><i class="fas fa-wifi"></i> Wifi</span>
                            </div>



                        </div>
                    </div>

                    <!-- Room 4: Deluxe Twin -->
                    <div
                        class="room-card others group bg-white rounded-lg shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden fade-in-section border-t-4 border-transparent hover:border-[#6d6d18]">
                        <div class="relative h-64 overflow-hidden room-img-wrapper">
                            <img src="{{ asset('frontendimages/rooms/triple.png') }}" class="w-full h-full object-cover"
                                alt="Deluxe Twin">
                        </div>
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-4">
                                <h3
                                    class="text-2xl font-['Playfair_Display'] font-bold text-gray-900 group-hover:text-[#0a7c15] transition-colors">
                                    Triple</h3>
                                <div class="text-right">
                                    <p class="text-xl font-bold text-[#6d6d18]">$90</p>
                                    <p class="text-xs text-gray-400">/ night</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6">Spacious room with two single beds, ideal
                                for friends or trekking partners passing through Bandipur.</p>

                            <div class="flex items-center gap-4 text-[#6d6d18] text-sm mb-6 border-t border-gray-100 pt-4">
                                <span><i class="fas fa-users"></i> Multiple</span>
                                <span><i class="fas fa-bed"></i> Triple</span>
                                <span title="Wifi"><i class="fas fa-wifi"></i> Wifi</span>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Detailed Amenities / Banner -->
        <section class="py-24 bg-[#1a1a1a] text-white relative">
            <div class="absolute inset-0 opacity-10 bg-[url('{{ asset('frontendimages/cusin.png') }}')]"></div>
            <div class="container mx-auto px-6 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center fade-in-section">
                    <div>
                        <h4 class="text-[#6d6d18] font-bold uppercase tracking-widest mb-2">Amenities</h4>
                        <h2 class="text-4xl md:text-5xl font-['Playfair_Display'] mb-6">Included in Your Stay</h2>
                        <p class="text-gray-400 mb-8 leading-relaxed">
                            At Bandipur Resort, we believe in providing a seamless blend of rustic charm and modern
                            convenience. Every booking includes:
                        </p>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-[#0a7c15]/20 flex items-center justify-center text-[#0a7c15]">
                                    <i class="fas fa-coffee"></i></div>
                                <span>Organic Breakfast with local produce</span>
                            </li>
                            <li class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-[#0a7c15]/20 flex items-center justify-center text-[#0a7c15]">
                                    <i class="fas fa-wifi"></i></div>
                                <span>High-speed Fiber Internet</span>
                            </li>
                            <li class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-[#0a7c15]/20 flex items-center justify-center text-[#0a7c15]">
                                    <i class="fas fa-om"></i></div>
                                <span>Morning Yoga Session</span>
                            </li>
                            <li class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-[#0a7c15]/20 flex items-center justify-center text-[#0a7c15]">
                                    <i class="fas fa-hiking"></i></div>
                                <span>Guided Village Walk</span>
                            </li>
                        </ul>
                    </div>
                    <div class="relative">
                        <div class="border-4 border-[#6d6d18] rounded-lg p-2">
                            <img src="{{ asset('frontendimages/hotel_entrance.png')}}" alt="Breakfast View"
                                class="w-full rounded shadow-2xl">
                        </div>
                        <div class="absolute -bottom-10 -left-10 bg-[#0a7c15] p-6 rounded-lg shadow-xl hidden md:block">
                            <p class="text-3xl font-bold font-['Playfair_Display']">4.9/5</p>
                            <p class="text-sm uppercase tracking-wide">Guest Rating</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>




    </section>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/9779812345678" target="_blank"
        class="fixed bottom-8 right-8 z-50 bg-[#25D366] text-white w-16 h-16 rounded-full flex items-center justify-center shadow-2xl hover:bg-[#128C7E] transition-all duration-300 hover:scale-110 animate-bounce">
        <i class="fab fa-whatsapp text-4xl"></i>
    </a>
    @push('script')
        <!-- Scripts -->
        <script>
            // --- 1. Animation Logic (Intersection Observer) ---
            // This watches elements and triggers the animation when they scroll into view
            document.addEventListener('DOMContentLoaded', () => {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            // Stop observing once animated to save resources
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.15 // Trigger when 15% of element is visible
                });

                const elements = document.querySelectorAll('.fade-in-section');
                elements.forEach(el => observer.observe(el));
            });

            // --- 2. Filtering Logic ---
            function filterRooms(category) {
                const cards = document.querySelectorAll('.room-card');
                const buttons = document.querySelectorAll('.filter-btn');

                // Button Styles: Reset all, then activate clicked
                buttons.forEach(btn => {
                    // Remove active styles (Solid Green)
                    btn.classList.remove('bg-[#0a7c15]', 'text-white');
                    btn.classList.add('bg-transparent', 'text-[#0a7c15]');

                    // If this is the button clicked
                    if (btn.getAttribute('onclick').includes(category)) {
                        btn.classList.remove('bg-transparent', 'text-[#0a7c15]');
                        btn.classList.add('bg-[#0a7c15]', 'text-white');
                    }
                });

                // Card Filtering
                cards.forEach(card => {
                    // Check if card has the category class (deluxe, suite, etc)
                    if (category === 'all' || card.classList.contains(category)) {
                        card.style.display = 'block';
                        // Small delay to allow display:block to render before adding animation class
                        setTimeout(() => {
                            card.classList.add('is-visible');
                        }, 50);
                    } else {
                        card.style.display = 'none';
                        card.classList.remove('is-visible');
                    }
                });
            }
        </script>
    @endpush
@endsection