<!-- sidebar.blade.php -->
<div x-data="{ sidebarOpen: false }" class="relative">

    <!-- Mobile Toggle Button -->
    <button @click="sidebarOpen = true"
        class="md:hidden fixed top-4 left-4 z-40 p-2 bg-secondary text-white rounded shadow-lg">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
        class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="bg-primary text-white w-[270px] h-full flex flex-col transition-transform duration-300 fixed z-40 md:relative md:translate-x-0">

        <!-- Logo -->
        <div class="h-16 flex items-center justify-center bg-primary shadow-xl">
            <img src="{{ asset('frontendimages/logo.png') }}" alt="" class="w-[90px] bg-white rounded-md px-2">
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-2 py-4 space-y-2 overflow-y-auto styled-scrollbar" x-data="{ activeDropdown: null }">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}" @click="sidebarOpen = false"
                class="flex items-center px-4 py-3 hover:bg-[#38CE3C] hover:text-black hover:rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-secondary text-black font-semibold rounded-lg' : '' }}">
                <i class="fas fa-tachometer-alt w-6"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            {{-- Users (Super Admin Only) --}}
            @if (auth()->user()->role === 'super_admin')
                <a href="{{ route('users.index') }}" @click="sidebarOpen = false"
                    class="flex items-center px-4 py-3 hover:bg-[#38CE3C] hover:text-black hover:rounded-lg
                    {{ request()->routeIs('users.*') ? 'bg-secondary text-black font-semibold rounded-lg' : '' }}">
                    <i class="fa-solid fa-users w-6"></i>
                    <span class="font-medium">Users</span>
                </a>
            @endif

            {{-- @php
                $dropdowns = [
                    [
                        'title' => 'Home Page',
                        'icon' => 'fa-solid fa-house-chimney',
                        'routes' => [
                            'home-first-hero.*',
                            'about-features.*',
                            'home-highlight.*',
                            'services.*',
                            'rooms.*',
                            'carousel.*',
                        ],
                        'links' => [
                            [
                                'route' => 'home-first-hero.index',
                                'icon' => 'fa-solid fa-image',
                                'text' => 'First Hero Section',
                            ],
                            [
                                'route' => 'about-features.index',
                                'icon' => 'fa-solid fa-address-card',
                                'text' => 'About Section',
                            ],
                            [
                                'route' => 'home-highlight.index',
                                'icon' => 'fa-solid fa-star',
                                'text' => 'Home Highlight',
                            ],
                            ['route' => 'services.index', 'icon' => 'fa-solid fa-bell-concierge', 'text' => 'Services'],
                            ['route' => 'rooms.index', 'icon' => 'fa-solid fa-bed', 'text' => 'Rooms'],
                            ['route' => 'carousel.index', 'icon' => 'fa-solid fa-images', 'text' => 'Carousels'],
                        ],
                    ],
                    [
                        'title' => 'About Page',
                        'icon' => 'fa-solid fa-circle-info',
                        'routes' => [
                            'aboutHero.*',
                            'aboutDescription.*',
                            'about-highlight.*',
                            'aboutprovide.*',
                            'aboutquote.*',
                        ],
                        'links' => [
                            [
                                'route' => 'aboutHero.index',
                                'icon' => 'fa-solid fa-mountain-sun',
                                'text' => 'Hero Section',
                            ],
                            [
                                'route' => 'aboutDescription.index',
                                'icon' => 'fa-solid fa-align-left',
                                'text' => 'About Description',
                            ],
                            [
                                'route' => 'about-highlight.index',
                                'icon' => 'fa-solid fa-highlighter',
                                'text' => 'About Highlight',
                            ],
                            [
                                'route' => 'aboutprovide.index',
                                'icon' => 'fa-solid fa-hand-holding-heart',
                                'text' => 'We Provide',
                            ],
                            ['route' => 'aboutquote.index', 'icon' => 'fa-solid fa-quote-left', 'text' => 'Quote'],
                        ],
                    ],
                    [
                        'title' => 'Accommodation Page',
                        'icon' => 'fa-solid fa-hotel',
                        'routes' => [
                            'accommodation-hero-first-image.*',
                            'accommodation-hero-header.*',
                            'accommodation-rooms.*',
                            'accommodation-amenities.*',
                            'guest-experiences.*',
                            'accommodation-policies.*',
                            'faqs.*',
                        ],
                        'links' => [
                            [
                                'route' => 'accommodation-hero-first-image.index',
                                'icon' => 'fa-solid fa-panorama',
                                'text' => 'Hero Page',
                            ],
                            [
                                'route' => 'accommodation-hero-header.index',
                                'icon' => 'fa-solid fa-heading',
                                'text' => 'Hero Header',
                            ],
                            [
                                'route' => 'accommodation-rooms.index',
                                'icon' => 'fa-solid fa-door-open',
                                'text' => 'Rooms',
                            ],
                            [
                                'route' => 'accommodation-amenities.index',
                                'icon' => 'fa-solid fa-wifi',
                                'text' => 'Amenities',
                            ],
                            [
                                'route' => 'guest-experiences.index',
                                'icon' => 'fa-solid fa-comment-dots',
                                'text' => 'Reviews',
                            ],
                            [
                                'route' => 'accommodation-policies.index',
                                'icon' => 'fa-solid fa-file-contract',
                                'text' => 'Policies',
                            ],
                            ['route' => 'faqs.index', 'icon' => 'fa-solid fa-circle-question', 'text' => 'FAQs'],
                        ],
                    ],
                    [
                        'title' => 'Gallery Page',
                        'icon' => 'fa-solid fa-camera-retro',
                        'routes' => ['gallery-hero-images.*', 'gallery-headers.*', 'gallery-grid.*', 'gallery-views.*'],
                        'links' => [
                            [
                                'route' => 'gallery-hero-images.index',
                                'icon' => 'fa-solid fa-image',
                                'text' => 'Hero Section',
                            ],
                            ['route' => 'gallery-headers.index', 'icon' => 'fa-solid fa-font', 'text' => 'Hero Header'],
                            [
                                'route' => 'gallery-grid.index',
                                'icon' => 'fa-solid fa-border-all',
                                'text' => 'Gallery Grid',
                            ],
                            ['route' => 'gallery-views.index', 'icon' => 'fa-solid fa-eye', 'text' => 'Gallery Views'],
                        ],
                    ],
                    [
                        'title' => 'Contact Us Page',
                        'icon' => 'fa-solid fa-envelope-open-text',
                        'routes' => ['contact-hero.*', 'contact-info.*', 'contact-message.*', 'partners.*', 'map.*'],
                        'links' => [
                            [
                                'route' => 'contact-hero.index',
                                'icon' => 'fa-solid fa-clapperboard',
                                'text' => 'Hero Section',
                            ],
                            [
                                'route' => 'contact-info.index',
                                'icon' => 'fa-solid fa-address-book',
                                'text' => 'Contact Info',
                            ],
                            [
                                'route' => 'contact-message.index',
                                'icon' => 'fa-solid fa-paper-plane',
                                'text' => 'Contact Message',
                            ],
                            [
                                'route' => 'partners.index',
                                'icon' => 'fa-solid fa-handshake',
                                'text' => 'Trusting Partners',
                            ],
                            [
                                'route' => 'map.index',
                                'icon' => 'fa-solid fa-map-location-dot',
                                'text' => 'Map Location',
                            ],
                        ],
                    ],
                ];
            @endphp --}}

            {{-- Dropdown Loop --}}
            {{-- @foreach ($dropdowns as $dropdown)
                @php
                    $isActive = false;
                    foreach ($dropdown['routes'] as $pattern) {
                        if (request()->routeIs($pattern)) {
                            $isActive = true;
                            break;
                        }
                    }
                @endphp

                <div class="mb-2" x-init="{{ $isActive ? 'activeDropdown = \'' . $dropdown['title'] . '\'' : '' }}">

                    <button
                        @click="activeDropdown === '{{ $dropdown['title'] }}'
                    ? activeDropdown = null
                    : activeDropdown = '{{ $dropdown['title'] }}'"
                        class="flex items-center justify-between w-full px-4 py-3 hover:bg-[#38CE3C] hover:text-black hover:rounded-lg transition
                    {{ $isActive ? 'bg-[#38CE3C] text-black font-semibold rounded-lg' : '' }}">

                        <span class="flex items-center space-x-2">
                            <i class="{{ $dropdown['icon'] }} w-6"></i>
                            <span class="font-medium">{{ $dropdown['title'] }}</span>
                        </span>

                        <i :class="activeDropdown === '{{ $dropdown['title'] }}'
                            ?
                            'fa-solid fa-chevron-up' :
                            'fa-solid fa-chevron-down'"
                            class="transition-transform duration-300"></i>
                    </button>

                    <div x-show="activeDropdown === '{{ $dropdown['title'] }}'" x-transition
                        class="mt-1 space-y-1 pl-6">

                        @foreach ($dropdown['links'] as $link)
                            <a href="{{ route($link['route']) }}" @click="sidebarOpen = false"
                                class="flex items-center px-4 py-2 rounded-lg hover:bg-[#38CE3C] hover:text-black
                                                        {{ request()->routeIs(explode('.', $link['route'])[0] . '.*')
                                                            ? 'bg-[#38CE3C]  text-black font-semibold'
                                                            : 'text-white' }}">
                                <i class="{{ $link['icon'] }} w-6"></i>
                                <span class="font-medium">{{ $link['text'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach --}}
        </nav>

        <!-- Logout -->
        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex w-full items-center px-4 py-2 text-gray-300 hover:text-white transition-colors">
                    <i class="fas fa-sign-out-alt w-6"></i>
                    <span class="font-medium ml-2">Logout</span>
                </button>
            </form>
        </div>
    </aside>
</div>