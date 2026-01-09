@push('style')
    <style>
        /* Smooth transition for the link hover effect */
        .hover-slide {
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .hover-slide:hover {
            transform: translateX(5px);
        }
    </style>
@endpush

<!-- FOOTER SECTION -->
<!-- Primary Color Background: #6d6d18 -->
<footer class="bg-[#6d6d18] text-gray-100 font-sans relative">

    <!-- Decorative Top Border using Secondary Color #0a7c15 -->
    <div class="w-full h-1 bg-[#0a7c15]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-7">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            <!-- COLUMN 1: BRAND & SOCIAL -->
            <div class="space-y-6">
                <div>
                    <img src="{{ asset('frontendimages/logo.png') }}" alt=""
                        class="bg-white py-1 px-3 rounded-lg my-2">
                    <h2 class="text-2xl font-bold uppercase tracking-widest text-white">Bandipur Eco</h2>
                    <p class="mt-4 text-gray-300 text-sm leading-relaxed">
                        Experience authentic hospitality and nature at its finest. Your perfect getaway in the hills of
                        Bandipur.
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold uppercase tracking-wider mb-4 text-white">Connect With Us</h3>
                    <div class="flex space-x-3">
                        <!-- Social Buttons: Secondary Color Background -->
                        {{-- <a href="#"
                            class="w-10 h-10 rounded-full bg-[#0a7c15] flex items-center justify-center text-white hover:bg-white hover:text-[#0a7c15] transition-all duration-300 shadow-md group">
                            <i class="fab fa-facebook-f group-hover:scale-110 transition-transform"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-[#0a7c15] flex items-center justify-center text-white hover:bg-white hover:text-[#0a7c15] transition-all duration-300 shadow-md group">
                            <i class="fab fa-instagram group-hover:scale-110 transition-transform"></i>
                        </a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-[#0a7c15] flex items-center justify-center text-white hover:bg-white hover:text-[#0a7c15] transition-all duration-300 shadow-md group">
                            <i class="fab fa-twitter group-hover:scale-110 transition-transform"></i>
                        </a> --}}

                        @foreach ($footerSocialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank"
                                class="w-10 h-10 rounded-full bg-[{{ $link->color }}] flex items-center justify-center text-white hover:bg-white hover:text-[#0a7c15] transition-all duration-300 shadow-md group">
                                <i class="{{ $link->icon }} group-hover:scale-110 transition-transform"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- COLUMN 2: QUICK MENU -->
            <div>
                {{-- Header with stylized underline --}}
                <h3 class="text-xl font-bold text-white mb-8 relative inline-block tracking-wide">
                    Quick Menu
                    <span class="absolute -bottom-2 left-0 w-12 h-1 bg-white"></span>
                </h3>

                <ul class="space-y-4">
                    @php
                        $menuItems = [
                            'Home' => '/',
                            'About Us' => '/about',
                            'Rooms' => '/accommodation',
                            'Gallery' => '/gallery',
                            'Rate' => '/tare',
                            'Contact' => '/contact',
                        ];
                    @endphp

                    @foreach ($menuItems as $label => $link)
                        <li>
                            <a href="{{ $link }}"
                                class="group flex items-center text-gray-200 hover:text-white transition-all duration-300 ease-in-out">

                                {{-- Icon/Marker: Changes from a line to a chevron on hover --}}
                                <span class="relative flex items-center justify-center mr-3">
                                    {{-- Static Line --}}
                                    <span
                                        class="w-2 h-[2px] bg-white group-hover:w-4 group-hover:bg-white transition-all duration-300"></span>
                                    {{-- Hidden Chevron that slides in --}}
                                    <i
                                        class="fas fa-chevron-right text-[8px] absolute opacity-0 -left-2 group-hover:opacity-100 group-hover:left-0 transition-all duration-300"></i>
                                </span>

                                <span
                                    class="text-sm font-medium tracking-wide transform group-hover:translate-x-1 transition-transform duration-300">
                                    {{ $label }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- COLUMN 3: CONTACT INFO -->
            {{-- <div>
                    <h3 class="text-lg font-bold text-white mb-6 relative inline-block">
                        Contact Us
                        <span class="absolute -bottom-2 left-0 w-12 h-1 bg-neutral-50"></span>
                    </h3>
                    <div class="space-y-4 text-sm text-gray-300">
                        <!-- Address -->
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded bg-white/10 flex items-center justify-center flex-shrink-0 mt-1 mr-3 text-neutral">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <span>
                                GPO Box: 2154<br>
                                Bandipur, Tudikhel
                            </span>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded bg-white/10 flex items-center justify-center flex-shrink-0 mr-3 text-neutral-50">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <a href="tel:065520125" class="hover:text-white transition-colors">065-520125</a>
                        </div>

                        <!-- Mobile -->
                        <div class="flex items-start">
                            <div class="w-8 h-8 rounded bg-white/10 flex items-center justify-center flex-shrink-0 mt-1 mr-3 text-neutral-50">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="flex flex-col">
                                <a href="tel:9869083625" class="hover:text-white transition-colors">9869083625</a>
                                <a href="tel:9802344765" class="hover:text-white transition-colors">9802344765</a>
                            </div>
                        </div>

                        <!-- Fax -->
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded bg-white/10 flex items-center justify-center flex-shrink-0 mr-3 text-neutral-50">
                                <i class="fas fa-fax"></i>
                            </div>
                            <span>+977-1-5325615</span>
                        </div>

                        <!-- Email -->
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded bg-white/10 flex items-center justify-center flex-shrink-0 mr-3 text-neutral-50">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="mailto:bandipureco@gmail.com" class="hover:text-white transition-colors break-all">bandipureco@gmail.com</a>
                        </div>
                    </div>
                </div> --}}
            <div>
                {{-- Section Title with high contrast --}}
                <h3 class="text-xl font-bold text-white mb-8 relative inline-block">
                    Contact Us
                    <span class="absolute -bottom-2 left-0 w-12 h-1 bg-white"></span>
                </h3>

                <div class="space-y-6">
                    @foreach ($footerContactInfo as $info)
                        <div class="flex items-start group">
                            {{-- Icon: Using a brighter white-transparent background for high visibility --}}
                            <div
                                class="w-10 h-10 rounded-xl bg-white/20 hover:bg-white flex items-center justify-center flex-shrink-0 mr-4 shadow-sm transition-all">
                                <i class="fas {{ $info->icon }} text-lg text-white hover:text-[#6d6d18]"></i>
                            </div>

                            <div class="flex flex-col">
                                {{-- Title: Using a bright minty-white for visibility against the olive background --}}
                                <span class="text-[11px] uppercase tracking-[0.15em] text-white/70 font-black mb-1">
                                    {{ $info->title }}
                                </span>

                                <div class="flex flex-col space-y-1">
                                    @php
                                        $values = $info->value ?? [];
                                        $links = $info->link ?? [];
                                    @endphp

                                    @foreach ($values as $index => $text)
                                        @if (!empty($links[$index]))
                                            {{-- Link with hover state: pure white --}}
                                            <a href="{{ $links[$index] }}"
                                                class="text-gray-100 hover:text-white font-medium transition-all break-all leading-tight border-b border-transparent hover:border-white/30 inline-block w-fit">
                                                {{ $text }}
                                            </a>
                                        @else
                                            {{-- Plain Text: pure white --}}
                                            <span class="text-white font-medium leading-tight">
                                                {!! nl2br(e($text)) !!}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- COLUMN 4: MAP -->
            {{-- <div>
                <h3 class="text-lg font-bold text-white mb-6 relative inline-block">
                    Find Us
                    <span class="absolute -bottom-2 left-0 w-12 h-1 bg-white"></span>
                </h3>
                <!-- Map Container with Secondary Color Border -->
                <div class="rounded-lg overflow-hidden shadow-lg border-2 border-[#0a7c15] h-56 w-full bg-gray-300">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3522.684347787355!2d84.41097631506456!3d27.93333398270118!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39951ca8e42f9b1b%3A0x6d6d18!2sBandipur%20Tundikhel!5e0!3m2!1sen!2snp!4v1625634212345!5m2!1sen!2snp"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div> --}}
            @if ($footerMap)
    <div class="mx-auto rounded-lg overflow-hidden shadow-lg border-2 w-full lg:w-[110%]"
        style="border-color: {{ $footerMap->primary_color }}; height: 18rem; background-color: #e5e7eb;">
        <iframe 
            src="{{ $footerMap->embed_url }}" 
            class="w-full h-full border-0"
            allowfullscreen="" 
            loading="lazy">
         Bram
        </iframe>
    </div>
@endif
        </div>
    </div>

    <!-- COPYRIGHT AREA -->
    <!-- Used a black overlay with opacity to create a darker shade of the primary color -->
    <div class="bg-black/20 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
                <p class="text-center md:text-left">
                    &copy; <span id="currentYear"></span> Bandipur Eco. All Rights Reserved.
                </p>
                <div class="mt-4 md:mt-0 space-x-6">
                    <a href="#" class="hover:text-white transition-colors">Privacy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms</a>
                </div>
            </div>
        </div>
    </div>
</footer>
@push('script')
    <!-- DYNAMIC YEAR SCRIPT -->
    <script>
        document.getElementById('currentYear').textContent = new Date().getFullYear();
    </script>
@endpush
