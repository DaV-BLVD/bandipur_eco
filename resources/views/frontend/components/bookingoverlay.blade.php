<!-- BOOKING MODAL OVERLAY -->
<div id="booking-modal" class="fixed inset-0 z-[100] hidden pointer-events-auto" aria-labelledby="modal-title"
    role="dialog" aria-modal="true">

    <!-- Backdrop (Blur & Darken) -->
    <div class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity opacity-0 duration-300 ease-out"
        id="booking-backdrop" onclick="closeBookingModal()"></div>

    <!-- Modal Panel -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">

            <div id="booking-panel"
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-2xl transition-all duration-300 ease-out sm:my-8 sm:w-full sm:max-w-4xl opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

                <!-- Close Button -->
                <button onclick="closeBookingModal()"
                    class="absolute top-4 right-4 z-20 text-black/80 hover:text-stone-600 hover:rotate-90 transition-all duration-300 focus:outline-none">
                    <i class="fas fa-times text-2xl "></i>
                </button>

                <div class="flex flex-col md:flex-row h-full">

                    <!-- Left Side: Image & Info (Desktop Only) -->
                    <div class="hidden md:block md:w-1/3 bg-transparnt relative">
                        <!-- Image -->
                        <img src="{{ asset('frontendimages/hotel_entrance.png') }}"
                            class="absolute inset-0 w-full h-full object-cover  ">
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/40 to-black/80 opacity-90"></div>

                        <div class="relative z-10 p-8 text-white h-full flex flex-col justify-between">
                            <div>
                                <h3 class="font-['Playfair_Display'] font-bold text-3xl mb-2">Book Your Stay</h3>
                                <p class="text-white/80 text-sm font-light">Experience the serenity of Bandipur.</p>
                            </div>

                            <!-- Trust Signals -->
                            <div class="space-y-4 text-sm text-white/90">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-[#6d6d18]"></i> <span>Best Rate Guarantee</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-[#6d6d18]"></i> <span>No Booking Fees</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-[#6d6d18]"></i> <span>Flexible
                                        Cancellation</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Form -->
                    <div class="w-full md:w-2/3 bg-white p-8 md:p-10">
                        <!-- Mobile Header -->
                        <div class="md:hidden mb-6 border-b border-gray-100 pb-4">
                            <h3 class="font-['Playfair_Display'] font-bold text-2xl text-[#0a7c15]">Book Your Stay</h3>
                        </div>

                        <form action="{{ route('booking.submit') }}" method="POST" class="space-y-6">
                            @csrf

                            <!-- Date Selection -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div class="relative">
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Check-in</label>
                                    <div class="relative">
                                        <i class="fas fa-calendar-alt absolute left-3 top-3 text-[#6d6d18]"></i>
                                        <input type="date" name="check_in" required
                                            class="w-full pl-10 pr-4 py-2 border-b-2 border-gray-200 focus:border-[#0a7c15] outline-none bg-gray-50/50 transition-colors text-gray-700 font-medium">
                                    </div>
                                </div>
                                <div class="relative">
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Check-out</label>
                                    <div class="relative">
                                        <i class="fas fa-calendar-check absolute left-3 top-3 text-[#6d6d18]"></i>
                                        <input type="date" name="check_out" required
                                            class="w-full pl-10 pr-4 py-2 border-b-2 border-gray-200 focus:border-[#0a7c15] outline-none bg-gray-50/50 transition-colors text-gray-700 font-medium">
                                    </div>
                                </div>
                            </div>

                            <!-- Guests & Room -->
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Guests</label>
                                    <div class="relative">
                                        <i class="fas fa-user-friends absolute left-3 top-3 text-[#6d6d18]"></i>
                                        <select name="guests"
                                            class="w-full pl-10 pr-4 py-2 border-b-2 border-gray-200 focus:border-[#0a7c15] outline-none bg-gray-50/50 transition-colors text-gray-700 appearance-none cursor-pointer">
                                            <option value="1 Adult">1 Adult</option>
                                            <option value="2 Adults" selected>2 Adults</option>
                                            <option value="3 Adults">3 Adults</option>
                                            <option value="4 Adults">4 Adults</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Room
                                        Type</label>
                                    <div class="relative">
                                        <i class="fas fa-bed absolute left-3 top-3 text-[#6d6d18]"></i>
                                        <select name="room_type"
                                            class="w-full pl-10 pr-4 py-2 border-b-2 border-gray-200 focus:border-[#0a7c15] outline-none bg-gray-50/50 transition-colors text-gray-700 appearance-none cursor-pointer">
                                            <option value="Deluxe Room">Deluxe Room</option>
                                            <option value="Royal Suite">Royal Suite</option>
                                            <option value="Heritage Cottage">Heritage Cottage</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Info -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Full
                                        Name</label>
                                    <input type="text" name="full_name" required placeholder="John Doe"
                                        class="w-full px-4 py-2 border-b-2 border-gray-200 focus:border-[#0a7c15] outline-none bg-gray-50/50 transition-colors">
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Phone</label>
                                    <input type="tel" name="phone" required placeholder="+977"
                                        class="w-full px-4 py-2 border-b-2 border-gray-200 focus:border-[#0a7c15] outline-none bg-gray-50/50 transition-colors">
                                </div>
                            </div>

                            <!-- Submit Action -->
                            <div
                                class="pt-4 flex flex-col sm:flex-row gap-4 items-center justify-between border-t border-gray-100 mt-6">
                                <div class="text-xs text-gray-400 text-center sm:text-left">
                                    <i class="fas fa-lock text-[#0a7c15] mr-1"></i> Secure Booking
                                </div>
                                <button type="submit"
                                    class="w-full sm:w-auto bg-[#6d6d18] text-white px-8 py-3 rounded-sm font-bold uppercase tracking-widest text-sm hover:bg-[#0a7c15] transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                                    Check Availability
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        // --- Booking Modal Logic ---
        const bookingModal = document.getElementById('booking-modal');
        const bookingBackdrop = document.getElementById('booking-backdrop');
        const bookingPanel = document.getElementById('booking-panel');

        function openBookingModal() {
            // 1. Show the modal container
            bookingModal.classList.remove('hidden');

            // 2. Animate in (fade backdrop, slide/fade panel)
            // We use a tiny timeout to ensure the browser registers the display:block change first
            setTimeout(() => {
                bookingBackdrop.classList.remove('opacity-0');
                bookingPanel.classList.remove('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
                bookingPanel.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
            }, 10);
        }

        function closeBookingModal() {
            // 1. Animate out
            bookingBackdrop.classList.add('opacity-0');
            bookingPanel.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
            bookingPanel.classList.add('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');

            // 2. Hide container after animation finishes (300ms matches CSS duration)
            setTimeout(() => {
                bookingModal.classList.add('hidden');
            }, 300);
        }

        // Close on Escape Key
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeBookingModal();
            }
        });
    </script>
@endpush
