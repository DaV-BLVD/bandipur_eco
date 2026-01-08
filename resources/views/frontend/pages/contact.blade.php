@extends('frontend.app')

@section('content')
    @push('style')
        <style>
            /* --- Animations --- */

            /* 1. Slow Zoom for Hero Background */
            @keyframes zoomSlow {
                0% {
                    transform: scale(1);
                }

                100% {
                    transform: scale(1.15);
                }
            }

            .animate-slow-zoom {
                animation: zoomSlow 20s ease-in-out infinite alternate;
            }

            /* 2. Professional Scroll Reveal */
            .reveal-on-scroll {
                opacity: 0;
                transform: translateY(40px);
                transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
            }

            .reveal-on-scroll.is-visible {
                opacity: 1;
                transform: translateY(0);
            }

            /* Stagger delays for grid items */
            .delay-100 {
                transition-delay: 100ms;
            }

            .delay-200 {
                transition-delay: 200ms;
            }

            .delay-300 {
                transition-delay: 300ms;
            }

            /* --- Form Styling --- */
            .input-group {
                position: relative;
                margin-bottom: 2.5rem;
                /* More breathing room */
            }

            .input-field {
                width: 100%;
                border-bottom: 1px solid #d1d5db;
                padding: 0.75rem 0;
                background: transparent;
                outline: none;
                transition: all 0.4s ease;
                font-family: 'Lato', sans-serif;
                color: #1f2937;
            }

            .input-field:focus {
                border-bottom-color: #0a7c15;
                box-shadow: 0 1px 0 0 #0a7c15;
                /* Glow effect on line */
            }

            .input-label {
                position: absolute;
                top: 0.75rem;
                left: 0;
                color: #9ca3af;
                transition: all 0.4s ease;
                pointer-events: none;
                font-size: 0.95rem;
            }

            .input-field:focus~.input-label,
            .input-field:valid~.input-label {
                top: -1.4rem;
                font-size: 0.75rem;
                color: #6d6d18;
                font-weight: 700;
                letter-spacing: 0.05em;
            }

            /* --- Map Styling --- */
            .custom-map {
                filter: grayscale(100%) invert(0%);
                transition: filter 0.7s ease;
            }

            .custom-map:hover {
                filter: grayscale(0%);
            }
        </style>
    @endpush

    <section class="bg-[#fcfcfc] min-h-screen">

        <!-- HERO SECTION -->
        <header class="relative h-[60vh] min-h-[500px] flex items-center justify-center overflow-hidden bg-[#1a1a1a]">
            <!-- Background with Zoom Animation -->
            <div class="absolute inset-0 w-full h-full overflow-hidden">
                {{-- <div class="w-full h-full bg-cover bg-center animate-slow-zoom"
                    style="background-image: url('{{ asset('frontendimages/people.png') }}');">
                </div> --}}
                @if ($hero)
                    <div class="w-full h-full bg-cover bg-center animate-slow-zoom"
                        style="background-image: url('{{ asset('storage/' . $hero->image) }}');">
                    </div>
                @endif
            </div>

            <!-- Elegant Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-black/60"></div>

            <div class="relative z-10 text-center text-white px-6 reveal-on-scroll">
                {{-- <span
                    class="inline-block py-1 px-4 border border-[#cdcd2e] text-[#cdcd44] bg-black/30 backdrop-blur-sm font-bold tracking-[0.2em] text-xs uppercase mb-6 rounded-2xl">
                    Get in Touch
                </span>
                <h1 class="text-5xl md:text-7xl font-['Playfair_Display'] font-bold mb-6 drop-shadow-xl">Start Your Journey
                </h1>
                <p class="font-light text-gray-200 max-w-xl mx-auto text-lg md:text-xl leading-relaxed">
                    Have questions about the roads, the weather, or special requests? We are here to help you plan your perfect escape.
                </p> --}}

                @if ($header)
                    <span
                        class="inline-block py-1 px-4 border border-[#cdcd2e] text-[#cdcd44] bg-black/30 backdrop-blur-sm font-bold tracking-[0.2em] text-xs uppercase mb-6 rounded-2xl">
                        {{ $header->badge_text }}
                    </span>

                    <h1 class="text-5xl md:text-7xl font-['Playfair_Display'] font-bold mb-6 drop-shadow-xl">
                        {{ $header->title }}
                    </h1>

                    <p class="font-light text-gray-200 max-w-xl mx-auto text-lg md:text-xl leading-relaxed">
                        {{ $header->description }}
                    </p>
                @endif
            </div>
        </header>

        <!-- CONTACT INFO GRID -->
        <section class="container mx-auto px-6 -mt-24 relative z-20 mb-24">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Card 1: Phone -->
                <div
                    class="reveal-on-scroll delay-100 bg-white p-10 shadow-lg  hover:shadow-2xl border-t-4 border-[#0a7c15] text-center group hover:-translate-y-2 transition-all duration-500 rounded-2xl">
                    <div
                        class="w-20 h-20 mx-auto bg-[#0a7c15]/5 rounded-full flex items-center justify-center text-[#0a7c15] mb-6 group-hover:bg-[#0a7c15] group-hover:text-white transition-all duration-500 scale-100 group-hover:scale-110">
                        <i class="fas fa-phone-alt text-2xl"></i>
                    </div>
                    <h3 class="font-['Playfair_Display'] font-bold text-2xl mb-2 text-gray-800">Call Us</h3>
                    <p class="text-gray-500 text-sm mb-6 font-light">Available 24/7 for bookings</p>
                    <a href="tel:+9779812345678"
                        class="text-[#6d6d18] font-bold text-lg hover:text-[#0a7c15] transition-colors block mb-1">+977 9869083625</a>
                    <a href="tel:+977065520123"
                        class="text-[#6d6d18] font-bold text-lg hover:text-[#0a7c15] transition-colors block">+977 065-520125</a>
                </div>

                <!-- Card 2: Email -->
                <div
                    class="reveal-on-scroll delay-200 bg-white p-10 shadow-lg hover:shadow-2xl border-t-4 border-[#6d6d18] text-center group hover:-translate-y-2 transition-all duration-500 rounded-2xl">
                    <div
                        class="w-20 h-20 mx-auto bg-[#6d6d18]/5 rounded-full flex items-center justify-center text-[#6d6d18] mb-6 group-hover:bg-[#6d6d18] group-hover:text-white transition-all duration-500 scale-100 group-hover:scale-110">
                        <i class="fas fa-envelope text-2xl"></i>
                    </div>
                    <h3 class="font-['Playfair_Display'] font-bold text-2xl mb-2 text-gray-800">Email Us</h3>
                    <p class="text-gray-500 text-sm mb-6 font-light">We usually reply within 24 hours</p>

                    <a href="mailto:bandipureco@gmail.com"
                        class="text-[#0a7c15] font-bold text-lg hover:text-[#6d6d18] transition-colors block">bandipureco@gmail.com</a>
                </div>

                <!-- Card 3: Location -->
                <div
                    class="reveal-on-scroll delay-300 bg-white p-10 shadow-lg hover:shadow-2xl border-t-4 border-[#0a7c15] text-center group hover:-translate-y-2 transition-all duration-500 rounded-2xl">
                    <div
                        class="w-20 h-20 mx-auto bg-[#0a7c15]/5 rounded-full flex items-center justify-center text-[#0a7c15] mb-6 group-hover:bg-[#0a7c15] group-hover:text-white transition-all duration-500 scale-100 group-hover:scale-110">
                        <i class="fas fa-map-marker-alt text-2xl"></i>
                    </div>
                    <h3 class=" font-bold text-2xl mb-2 text-gray-800">Visit Us</h3>
                    <p class="text-gray-500 text-sm mb-6 font-light">Towards the Old Bazaar</p>
                    <p class="text-[#6d6d18] font-medium text-lg leading-relaxed">Tudikhel,Bandipur,Nepal</p>
                </div>

@foreach($contactInfos as $info)
<div
    class="reveal-on-scroll bg-white p-10 shadow-lg hover:shadow-2xl
           border-t-4 text-center group hover:-translate-y-2
           transition-all duration-500 rounded-2xl"
    style="border-color: {{ $info->theme_color }}">

    <div
        class="w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-6
               transition-all duration-500 group-hover:text-white"
        style="background-color: {{ $info->theme_color }}15; color: {{ $info->theme_color }}">
        <i class="fas {{ $info->icon }} text-2xl"></i>
    </div>

    <h3 class="font-bold text-2xl mb-2 text-gray-800">
        {{ $info->title }}
    </h3>

    <p class="text-gray-500 text-sm mb-6 font-light">
        {{ $info->subtitle }}
    </p>

    @if($info->link)
        <a href="{{ $info->link }}"
           class="font-bold text-lg block transition-colors"
           style="color: {{ $info->theme_color }}">
            {{ $info->value }}
        </a>
    @else
        <p class="font-medium text-lg">
            {{ $info->value }}
        </p>
    @endif
</div>
@endforeach

            </div>
        </section>

        <!-- FORM & MAP SPLIT SECTION -->
        <section class="container mx-auto px-6 pb-24">
            <div
                class="reveal-on-scroll flex flex-col lg:flex-row bg-white shadow-2xl overflow-hidden rounded-lg border border-gray-100">

                <!-- Left: Contact Form -->
                <!-- Form Section -->
                <div class="w-full lg:w-1/2 bg-white p-10 md:p-14 relative overflow-hidden shadow-2xl rounded-sm">

                    <!-- Background Decor: Subtle Leaf/Organic Shape -->
                    <div
                        class="absolute -top-16 -right-16 w-40 h-40 bg-[#0a7c15] opacity-[0.03] rounded-full blur-2xl pointer-events-none">
                    </div>
                    <div
                        class="absolute bottom-10 left-10 w-20 h-20 bg-[#6d6d18] opacity-[0.03] rounded-full blur-xl pointer-events-none">
                    </div>

                    <!-- Header -->
                    <div class="relative z-10 mb-10">
                        <span class="text-[#6d6d18] font-bold text-xs tracking-[0.2em] uppercase mb-2 block">Contact
                            Us</span>
                        <h2 class="text-3xl md:text-4xl font-['Playfair_Display'] font-bold text-[#0a7c15] mb-4">
                            Send a Message
                        </h2>
                        <div class="w-16 h-1 bg-[#6d6d18] mb-4"></div>
                        <p class="text-gray-400 text-sm font-light leading-relaxed max-w-md">
                            Have a question about your stay? Fill out the form below and our reception team will get
                            back to you shortly.
                        </p>
                    </div>

                    <form action="#" method="POST" class="relative z-10 space-y-8">

                        <!-- Grid for Name & Email -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                            <!-- Name Input (Floating Label) -->
                            <div class="relative z-0 w-full group">
                                <input type="text" name="name" id="name"
                                    class="block py-3 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#0a7c15] peer"
                                    placeholder=" " required />
                                <label for="name"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-[#0a7c15] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Your Name
                                </label>
                            </div>

                            <!-- Email Input (Floating Label) -->
                            <div class="relative z-0 w-full group">
                                <input type="email" name="email" id="email"
                                    class="block py-3 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#0a7c15] peer"
                                    placeholder=" " required />
                                <label for="email"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-[#0a7c15] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Your Email
                                </label>
                            </div>
                        </div>

                        <!-- Phone Input -->
                        <div class="relative z-0 w-full group">
                            <input type="tel" name="phone" id="phone"
                                class="block py-3 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#0a7c15] peer"
                                placeholder=" " required />
                            <label for="phone"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-[#0a7c15] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                Phone Number
                            </label>
                        </div>

                        <!-- Message Input -->
                        <div class="relative z-0 w-full group">
                            <textarea name="message" id="message" rows="3"
                                class="block py-3 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#0a7c15] peer resize-none"
                                placeholder=" " required></textarea>
                            <label for="message"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-[#0a7c15] peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                How can we help you?
                            </label>
                        </div>

                        <!-- Action Button -->
                        <div class="pt-4">
                            <button type="submit"
                                class="group relative w-full md:w-auto overflow-hidden bg-[#0a7c15] px-12 py-4 shadow-lg transition-all duration-300 hover:shadow-xl active:scale-95">

                                <!-- Sliding Background Layer -->
                                <div
                                    class="absolute inset-0 h-full w-full bg-[#6d6d18] transition-transform duration-300 ease-out transform translate-y-full group-hover:translate-y-0">
                                </div>

                                <!-- Button Text -->
                                <span
                                    class="relative z-10 flex items-center justify-center gap-3 font-bold uppercase tracking-widest text-white text-xs">
                                    Send Message
                                    <i
                                        class="fas fa-paper-plane text-xs transition-transform duration-300 group-hover:translate-x-1 group-hover:-translate-y-1"></i>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>


                <!-- Right: Google Map -->
                <div class="w-full lg:w-1/2 h-[500px] lg:h-auto relative group">
                    <!-- Google Map Iframe -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3523.5471649718446!2d84.41724431500366!3d27.935105982702115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399505a74e503387%3A0xe5a37172c91839e2!2sBandipur%2C%20Nepal!5e0!3m2!1sen!2snp!4v1684321234567!5m2!1sen!2snp"
                        class="absolute inset-0 w-full h-full custom-map" style="border:0;" allowfullscreen=""
                        loading="lazy">
                    </iframe>

                    <!-- Overlay Info -->
                    <div
                        class="absolute bottom-8 left-8 bg-white/95 backdrop-blur-md p-6 rounded shadow-2xl max-w-xs border-l-4 border-[#6d6d18] transform translate-y-4 opacity-90 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
                        <p class="text-[#0a7c15] font-bold text-xs uppercase mb-2 tracking-wide">Getting Here</p>
                        <p class="text-sm text-gray-600 leading-relaxed">We are 145km from Kathmandu (approx 4-5 hrs) and
                            75km from Pokhara
                            (2.5 hrs).</p>
                    </div>
                </div>

            </div>
        </section>

        <!-- FAQ SECTION -->
        <section class="container mx-auto px-6 pb-24 text-center">
            <h2 class="reveal-on-scroll text-3xl md:text-4xl font-['Playfair_Display'] font-bold text-[#1a1a1a] mb-12">
                Frequently Asked Questions</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left max-w-4xl mx-auto">
                <!-- FAQ Item 1 -->
                <div
                    class="reveal-on-scroll delay-100 bg-white p-8 rounded-lg shadow-sm hover:shadow-md border border-gray-100 transition-all duration-300">
                    <h4 class="font-bold text-[#0a7c15] mb-3 text-lg flex items-center">
                        <i class="fas fa-car mr-3 text-[#6d6d18]"></i> Is there parking available?
                    </h4>
                    <p class="text-gray-600 text-sm leading-relaxed pl-8">Yes, we have secure private parking for both cars
                        and motorbikes located 5 minutes from the main reception.</p>
                </div>
                <!-- FAQ Item 2 -->
                <div
                    class="reveal-on-scroll delay-200 bg-white p-8 rounded-lg shadow-sm hover:shadow-md border border-gray-100 transition-all duration-300">
                    <h4 class="font-bold text-[#0a7c15] mb-3 text-lg flex items-center">
                        <i class="fas fa-dog mr-3 text-[#6d6d18]"></i> Are pets allowed?
                    </h4>
                    <p class="text-gray-600 text-sm leading-relaxed pl-8">We are a pet-friendly resort! Please inform us in
                        advance so we can prepare a ground-floor cottage for you.</p>
                </div>
                <!-- FAQ Item 3 -->
                <div
                    class="reveal-on-scroll delay-300 bg-white p-8 rounded-lg shadow-sm hover:shadow-md border border-gray-100 transition-all duration-300">
                    <h4 class="font-bold text-[#0a7c15] mb-3 text-lg flex items-center">
                        <i class="fas fa-wifi mr-3 text-[#6d6d18]"></i> Is the Wi-Fi reliable?
                    </h4>
                    <p class="text-gray-600 text-sm leading-relaxed pl-8">We have dedicated fiber internet suitable for
                        remote work, though speeds may vary during storms.</p>
                </div>
                <!-- FAQ Item 4 -->
                <div
                    class="reveal-on-scroll delay-100 bg-white p-8 rounded-lg shadow-sm hover:shadow-md border border-gray-100 transition-all duration-300">
                    <h4 class="font-bold text-[#0a7c15] mb-3 text-lg flex items-center">
                        <i class="fas fa-snowflake mr-3 text-[#6d6d18]"></i> Is there heating?
                    </h4>
                    <p class="text-gray-600 text-sm leading-relaxed pl-8">All rooms are equipped with electric heaters
                        during winter, and thick woolen blankets are provided.</p>
                </div>
            </div>
        </section>

        <!-- Floating WhatsApp Button -->
        <a href="https://wa.me/9779812345678" target="_blank"
            class="fixed bottom-8 right-8 z-50 bg-[#25D366] text-white w-16 h-16 rounded-full flex items-center justify-center shadow-2xl hover:bg-[#128C7E] transition-all duration-300 hover:scale-110 animate-bounce">
            <i class="fab fa-whatsapp text-4xl"></i>
        </a>

    </section>

    <!-- JS for Scroll Animations -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.reveal-on-scroll').forEach(el => observer.observe(el));
        });
    </script>
@endsection
