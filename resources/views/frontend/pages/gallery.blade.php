@extends('frontend.app')

@section('content')
    @push('style')
        <style>
            /* --- Masonry Layout Logic (Preserved) --- */
            .masonry-grid {
                column-count: 1;
                column-gap: 1.5rem;
            }

            @media (min-width: 640px) {
                .masonry-grid {
                    column-count: 2;
                }
            }

            @media (min-width: 1024px) {
                .masonry-grid {
                    column-count: 3;
                }
            }

            /* Prevent items from splitting */
            .gallery-item {
                break-inside: avoid;
                margin-bottom: 1.5rem;
            }

            /* --- Animations --- */

            /* 1. Ken Burns Effect for Hero */
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

            /* 2. Fade Up Reveal on Scroll */
            .reveal-on-scroll {
                opacity: 0;
                transform: translateY(30px);
                transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
            }

            .reveal-on-scroll.is-visible {
                opacity: 1;
                transform: translateY(0);
            }

            /* 3. Image Loading Fade In */
            @keyframes fadeInImage {
                from {
                    opacity: 0;
                    transform: scale(0.95);
                }

                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            .gallery-item-loaded {
                animation: fadeInImage 0.6s ease-out forwards;
            }

            /* Custom Scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }

            ::-webkit-scrollbar-track {
                background: #1a1a1a;
            }

            ::-webkit-scrollbar-thumb {
                background: #6d6d18;
                border-radius: 4px;
            }
        </style>
    @endpush

    <section class="bg-[#fcfcfc] text-gray-800 antialiased selection:bg-[#6d6d18] selection:text-white">

        <!-- HERO SECTION -->
        <!-- Added flex layout for perfect centering and overflow-hidden for the zoom effect -->
        <header class="relative h-[70vh] min-h-[500px] flex items-center justify-center overflow-hidden bg-[#1a1a1a]">
            <!-- Background Image Container with Animation -->
            <div class="absolute inset-0 w-full h-full overflow-hidden">
                {{-- <div class="w-full h-full bg-cover bg-center animate-slow-zoom"
                    style="background-image: url('{{ asset('frontendimages/hospitality.png') }}');">
                </div> --}}
                @if ($hero)
                    <div class="w-full h-full bg-cover bg-center animate-slow-zoom"
                        style="background-image: url('{{ asset('storage/' . $hero->image) }}');">
                    </div>
                @endif
            </div>

            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-black/80"></div>

            <!-- Content -->
            <div class="relative z-10 container mx-auto px-6 text-center reveal-on-scroll">
                {{-- <span
                    class="inline-block py-1 px-4 border border-[#6d6d18] text-[#6d6d18] bg-black/20 backdrop-blur-sm uppercase tracking-[0.2em] text-[10px] md:text-xs font-bold mb-6 rounded-sm">
                    Bandipur Heritage
                </span>
                <h1 class="text-5xl md:text-7xl font-['Playfair_Display'] font-bold text-white mb-6 drop-shadow-xl">
                    Visual Journey
                </h1>
                <p class="text-gray-200 text-lg md:text-xl max-w-lg mx-auto font-light leading-relaxed">
                    Glimpses of life above the clouds.
                </p> --}}

                @if ($header)
                    <span
                        class="inline-block py-1 px-4 border border-[#6d6d18] text-[#6d6d18]
                        bg-black/20 backdrop-blur-sm uppercase tracking-[0.2em]
                        text-[10px] md:text-xs font-bold mb-6 rounded-sm">
                        {{ $header->badge_text }}
                    </span>

                    <h1
                        class="text-5xl md:text-7xl font-['Playfair_Display']
                        font-bold text-white mb-6 drop-shadow-xl">
                        {{ $header->title }}
                    </h1>

                    <p
                        class="text-gray-200 text-lg md:text-xl max-w-lg mx-auto
                        font-light leading-relaxed">
                        {{ $header->subtitle }}
                    </p>
                @endif
            </div>
        </header>

        <!-- INTRO TEXT SECTION -->
        <section class="mx-auto container px-6 py-20 md:py-28 text-center bg-white relative">
            <!-- Decorative Background Element -->
            <div
                class="absolute top-0 left-1/2 -translate-x-1/2 w-[1px] h-20 bg-gradient-to-b from-transparent to-[#6d6d18]">
            </div>

            <div class="reveal-on-scroll">
                <span class="block text-[#6d6d18] font-bold tracking-[0.2em] text-xs uppercase mb-4">
                    The Collection
                </span>

                <h1 class="text-4xl md:text-6xl font-['Playfair_Display'] font-bold text-[#0a7c15] mb-8">
                    Framed by Nature
                </h1>

                <p class="text-gray-500 text-lg md:text-xl font-['Lato'] font-light max-w-2xl mx-auto leading-relaxed">
                    A curated collection of <span class="text-[#6d6d18] font-medium italic font-serif">golden
                        sunsets</span>, green valleys, and heritage living.
                </p>
            </div>
        </section>

        <!-- MAIN GALLERY GRID -->
        <section class="pb-24 bg-white min-h-screen">
            <div class="container mx-auto px-6">
                <div class="masonry-grid" id="gallery-container">
                    <!-- Javascript will insert images here -->
                </div>
            </div>
        </section>

        <!-- LIGHTBOX MODAL -->
        <div id="lightbox"
            class="fixed inset-0 z-[60] bg-black/95 hidden flex justify-center items-center backdrop-blur-md opacity-0 transition-opacity duration-300">

            <!-- Close Button -->
            <button onclick="closeLightbox()"
                class="absolute top-6 right-6 text-white/70 hover:text-[#6d6d18] text-4xl transition-colors z-50 focus:outline-none transform hover:rotate-90 duration-300">
                <i class="fas fa-times"></i>
            </button>

            <!-- Nav Left -->
            <button onclick="changeImage(-1)"
                class="absolute left-4 md:left-8 text-white/70 hover:text-[#6d6d18] text-3xl md:text-5xl p-4 transition-all z-50 hover:-translate-x-1 focus:outline-none">
                <i class="fas fa-chevron-left"></i>
            </button>

            <!-- Image Wrapper -->
            <div class="relative w-full h-full flex justify-center items-center p-4 md:p-12">
                <img id="lightbox-img" src=""
                    class="max-h-[85vh] max-w-[90vw] rounded-sm shadow-2xl transform scale-95 transition-all duration-500">

                <!-- Caption -->
                <div id="lightbox-caption"
                    class="absolute bottom-10 bg-black/60 backdrop-blur-sm text-white px-8 py-3 rounded-full font-['Playfair_Display'] italic tracking-wide border border-white/10">
                </div>
            </div>

            <!-- Nav Right -->
            <button onclick="changeImage(1)"
                class="absolute right-4 md:right-8 text-white/70 hover:text-[#6d6d18] text-3xl md:text-5xl p-4 transition-all z-50 hover:translate-x-1 focus:outline-none">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

    </section>
    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/9779812345678" target="_blank"
        class="fixed bottom-8 right-8 z-50 bg-[#25D366] text-white w-16 h-16 rounded-full flex items-center justify-center shadow-2xl hover:bg-[#128C7E] transition-all duration-300 hover:scale-110 animate-bounce">
        <i class="fab fa-whatsapp text-4xl"></i>
    </a>

    @push('script')
        <script>
            // --- 1. JSON DATA CONFIGURATION ---
            const galleryData = [{
                    src: "{{ asset('frontendimages/hotel_entrance.png') }}",
                    category: "exterior",
                    title: "The Main Lodge"
                },
                {
                    src: "{{ asset('frontendimages/rooms/double.png') }}",
                    category: "interiors",
                    title: "Deluxe Suite"
                },
                {
                    src: "{{ asset('frontendimages/tempels.png') }}",
                    category: "culture",
                    title: "Newari Architecture"
                },
                {
                    src: "{{ asset('frontendimages/cusin.png') }}",
                    category: "dining",
                    title: "Morning Coffee"
                },
                {
                    src: "{{ asset('frontendimages/site_view.png') }}",
                    category: "exterior",
                    title: "Sunrise View"
                },
                {
                    src: "{{ asset('frontendimages/bath.png') }}",
                    category: "interiors",
                    title: "Royal Bathroom"
                },
                {
                    src: "{{ asset('frontendimages/cusin.png') }}",
                    category: "culture",
                    title: "Bandipur Streets"
                },
                {
                    src: "{{ asset('frontendimages/bandipureco.png') }}",
                    category: "dining",
                    title: "Traditional Dinner"
                },
                {
                    src: "{{ asset('frontendimages/order.png') }}",
                    category: "exterior",
                    title: "The Terrace"
                }
            ];

            // --- 2. RENDER LOGIC (Enhanced for Style) ---
            function renderGallery() {
                const container = document.getElementById('gallery-container');
                let html = '';

                galleryData.forEach((item, index) => {
                    // Added animation delay based on index for cascading effect
                    const delay = index * 100;

                    html += `
            <div class="gallery-item gallery-item-loaded group relative overflow-hidden rounded-md cursor-pointer shadow-md hover:shadow-xl transition-all duration-500" 
                 data-category="${item.category}" 
                 onclick="openLightbox(${index})"
                 style="animation-delay: ${delay}ms">
                
                <!-- Image with Zoom on Hover -->
                <img src="${item.src}" 
                     class="w-full h-auto transform transition-transform duration-700 ease-in-out group-hover:scale-110 grayscale-[10%] group-hover:grayscale-0" 
                     alt="${item.title}">
                
                <!-- Overlay with Gradient & Text Slide Up -->
                <div class="absolute inset-0 bg-gradient-to-t from-[#0a7c15]/90 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end items-center pb-8">
                    
                    <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-100">
                        <i class="fas fa-expand text-white text-2xl mb-2 opacity-80"></i>
                    </div>
                    
                    <span class="font-['Playfair_Display'] font-bold text-xl text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-150 relative">
                        ${item.title}
                        <span class="block w-full h-[1px] bg-[#6d6d18] mt-2 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 delay-200"></span>
                    </span>
                    
                    <span class="text-[#6d6d18] text-[10px] uppercase tracking-widest mt-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-200 bg-white/90 px-2 py-1 rounded-sm">
                        ${item.category}
                    </span>
                </div>
            </div>
            `;
                });

                container.innerHTML = html;

                // Trigger scroll observer after rendering
                initScrollObserver();
            }

            // --- 3. SCROLL REVEAL OBSERVER ---
            function initScrollObserver() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                        }
                    });
                }, {
                    threshold: 0.15
                });

                document.querySelectorAll('.reveal-on-scroll').forEach(el => observer.observe(el));
            }

            // --- 4. LIGHTBOX LOGIC (Preserved) ---
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            const lightboxCaption = document.getElementById('lightbox-caption');
            let currentIndex = 0;
            let visibleImages = [];

            function updateVisibleImages() {
                const allItems = Array.from(document.querySelectorAll('.gallery-item'));
                visibleImages = allItems.filter(item => !item.classList.contains('hidden-item'));
            }

            function openLightbox(dataIndex) {
                updateVisibleImages();
                const sourceUrl = galleryData[dataIndex].src;
                const targetItem = visibleImages.find(item => item.querySelector('img').src === sourceUrl);

                if (targetItem) {
                    currentIndex = visibleImages.indexOf(targetItem);
                    showImage(currentIndex);
                    lightbox.classList.remove('hidden');
                    setTimeout(() => {
                        lightbox.classList.remove('opacity-0');
                        lightboxImg.classList.remove('scale-95');
                        lightboxImg.classList.add('scale-100');
                    }, 50);
                }
            }

            function closeLightbox() {
                lightbox.classList.add('opacity-0');
                lightboxImg.classList.remove('scale-100');
                lightboxImg.classList.add('scale-95');
                setTimeout(() => {
                    lightbox.classList.add('hidden');
                    lightboxImg.src = "";
                }, 300);
            }

            function showImage(index) {
                if (index < 0) index = visibleImages.length - 1;
                if (index >= visibleImages.length) index = 0;
                currentIndex = index;
                const item = visibleImages[index];
                const img = item.querySelector('img');
                const captionText = galleryData.find(d => d.src === img.getAttribute('src')).title;

                // Smooth transition inside lightbox
                lightboxImg.style.opacity = '0.7';
                setTimeout(() => {
                    lightboxImg.src = img.src;
                    lightboxCaption.innerText = captionText;
                    lightboxImg.style.opacity = '1';
                }, 200);
            }

            function changeImage(direction) {
                showImage(currentIndex + direction);
            }

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowLeft') changeImage(-1);
                if (e.key === 'ArrowRight') changeImage(1);
            });

            document.addEventListener('DOMContentLoaded', renderGallery);
        </script>
    @endpush
@endsection
