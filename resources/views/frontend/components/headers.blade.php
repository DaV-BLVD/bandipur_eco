<nav id="navbar"
    class="fixed w-full z-50 px-6 left-0 right-0 py-4 flex justify-between items-center bg-transparent text-white">
    <a href="{{ url('/') }}" class="flex items-center gap-2">
        <div class="">
            <img src="{{ asset('frontendimages/logo.png') }}" alt="" class='w-22'>
        </div>

    </a>

    <div class="hidden lg:flex gap-8 font-medium  ">
        <a href="{{ url('/') }}"
            class="hover:text-white hover:bg-[#0a7c15] py-1 px-3 rounded-full transition  {{ Request::is('/') ? 'bg-[#0a7c15] py-1 px-3 rounded-full text-white ' : '' }}">Home</a>
        <a href="{{ route('about') }}"
            class="hover:text-white hover:bg-[#0a7c15] py-1 px-3 rounded-full transition  {{ Request::is('about') ? 'bg-[#0a7c15] py-1 px-3 rounded-full text-white ' : '' }}">About</a>
        <a href="{{ route('accommodation') }}"
            class="hover:text-white hover:bg-[#0a7c15] py-1 px-3 rounded-full transition {{ Request::is('accommodation') ? 'bg-[#0a7c15] py-1 px-3 rounded-full  text-white' : '' }}">
            Accommodation</a>
        <a href="{{ route('tare') }}"
            class="hover:text-white hover:bg-[#0a7c15] py-1 px-3 rounded-full transition {{ Request::is('tare') ? 'bg-[#0a7c15] py-1 px-5 rounded-full text-white' : '' }}">Tare</a>
        <a href="{{ route('gallery') }}"
            class="hover:text-white hover:bg-[#0a7c15] py-1 px-3 rounded-full transition  {{ Request::is('gallery') ? 'bg-[#0a7c15] py-1 px-3 rounded-full text-white' : '' }}">Gallery</a>
        <a href="{{ route('contact') }}"
            class="hover:text-white hover:bg-[#0a7c15] py-1 px-3 rounded-full transition  {{ Request::is('contact') ? 'bg-[#0a7c15] py-1 px-3 rounded-full text-white' : '' }}">Contact
            Us</a>
    </div>

    <div class="hidden lg:block">
        <a href="javascript:void(0)" onclick="openBookingModal()"
            class="bg-[#6d6d18] hover:bg-[#0a7c15] text-white px-6 py-2 rounded-full transition duration-300">
            Book Now
        </a>
    </div>

    <button class="lg:hidden text-2xl focus:outline-none text-stone-400" id="menu-toggle">
        <i class="fas fa-bars" id="menu-icon"></i>
    </button>
</nav>

<div id="mobile-menu"
    class="fixed inset-0 bg-white bg-opacity-95 z-40 flex flex-col items-center justify-center gap-8 text-stone-500 text-2xl font-semibold -translate-y-full lg:hidden mobile-menu">
    <a href="{{ url('/') }}"
        class="hover:text-white hover:bg-[#0a7c15] py-1 px-3 rounded-full transition  {{ Request::is('/') ? 'bg-[#0a7c15] py-1 px-5 rounded-full text-white ' : '' }}">Home</a>
    <a href="{{ route('about') }}"
        class="hover:text-white hover:bg-[#0a7c15] py-1 px-3 rounded-full transition  {{ Request::is('about') ? 'bg-[#0a7c15] py-1 px-5 rounded-full text-white' : '' }}">About</a>
    <a href="{{ route('accommodation') }}"
        class="hover:text-white hover:bg-[#0a7c15] py-1 px-3 rounded-full transition {{ Request::is('accommodation') ? 'bg-[#0a7c15] py-1 px-5 rounded-full text-white' : '' }}">Accommodation</a>
    <a href="{{ route('tare') }}"
        class="hover:text-white hover:bg-[#0a7c15] py-1 px-3 rounded-full transition {{ Request::is('tare') ? 'bg-[#0a7c15] py-1 px-5 rounded-full text-white' : '' }}">Tare</a>
    <a href="{{ route('gallery') }}"
        class="hover:text-white hover:bg-[#0a7c15] py-1 px-3 rounded-full transition  {{ Request::is('gallery') ? 'bg-[#0a7c15] py-1 px-5 rounded-full text-white ' : '' }}">Gallery</a>
    <a href="{{ route('contact') }}"
        class="hover:text-white hover:bg-[#0a7c15] py-1 px-3 rounded-full transition  {{ Request::is('contact') ? 'bg-[#0a7c15] py-1 px-5 rounded-full text-white' : '' }}">Contact
        Us</a>
    <a href="javascript:void(0)" onclick="openBookingModal()"
        class="bg-[#6d6d18] px-8 py-3 rounded-full text-lg text-white ">Book Now</a>
</div>