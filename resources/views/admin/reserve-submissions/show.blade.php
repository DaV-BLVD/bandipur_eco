@extends('admin.layouts.app')

@section('title', 'Reservation Details')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">

        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                <i class="fas fa-info-circle mr-2 text-primary"></i> Reservation Details
            </h1>
            <a href="{{ route('reserve-submissions.index') }}"
                class="flex items-center text-sm font-bold text-gray-500 hover:text-primary transition-colors">
                <i class="fas fa-chevron-left mr-2"></i> Back to List
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-8 py-4 border-b border-gray-200 flex justify-between items-center">
                <span class="text-xs font-bold uppercase tracking-widest text-gray-400">Guest Information</span>
                <span class="text-xs font-mono text-gray-400">ID: #RE-{{ $reserveSubmission->id }}</span>
            </div>

            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Left Side --}}
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-gray-400 tracking-widest mb-1">Full
                            Name</label>
                        <p class="text-lg font-bold text-gray-900">{{ $reserveSubmission->full_name }}</p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-gray-400 tracking-widest mb-1">Phone
                            Number</label>
                        <p class="text-gray-700 font-medium flex items-center">
                            <i class="fas fa-phone-alt mr-2 text-primary/60"></i> {{ $reserveSubmission->phone }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-gray-400 tracking-widest mb-1">Total
                            Guests</label>
                        <p class="text-gray-700 font-medium flex items-center">
                            <i class="fas fa-users mr-2 text-primary/60"></i> {{ $reserveSubmission->guests }} Person(s)
                        </p>
                    </div>
                </div>

                {{-- Right Side --}}
                <div class="bg-primary/5 rounded-2xl p-6 space-y-6 border border-primary/10">
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-primary/60 tracking-widest mb-1">Room
                            Selection</label>
                        <p class="text-lg font-extrabold text-primary">{{ $reserveSubmission->room_type }}</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <div>
                            <label
                                class="block text-[10px] font-bold uppercase text-gray-400 tracking-widest mb-1">Check-in</label>
                            <p class="font-bold text-gray-800">{{ $reserveSubmission->check_in->format('D, M d, Y') }}</p>
                        </div>
                        <i class="fas fa-arrow-right text-gray-300"></i>
                        <div class="text-right">
                            <label
                                class="block text-[10px] font-bold uppercase text-gray-400 tracking-widest mb-1">Check-out</label>
                            <p class="font-bold text-gray-800">{{ $reserveSubmission->check_out->format('D, M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex justify-end space-x-3">
                {{-- Toggle Read/Unread Button --}}
                <form
                    action="{{ $reserveSubmission->is_read ? route('reserve-submissions.unread', $reserveSubmission) : route('reserve-submissions.read', $reserveSubmission) }}"
                    method="POST">
                    @csrf @method('PATCH')
                    <button
                        class="bg-white border border-gray-200 text-gray-600 px-6 py-2 rounded-xl text-sm font-bold hover:bg-gray-100 transition-all">
                        <i class="fas {{ $reserveSubmission->is_read ? 'fa-envelope' : 'fa-check-double' }} mr-2"></i>
                        Mark as {{ $reserveSubmission->is_read ? 'Unread' : 'Read' }}
                    </button>
                </form>

                {{-- Delete Button --}}
                <form action="{{ route('reserve-submissions.destroy', $reserveSubmission) }}" method="POST"
                    onsubmit="return confirm('Permanently delete this reservation?')">
                    @csrf @method('DELETE')
                    <button
                        class="bg-red-50 text-red-600 px-6 py-2 rounded-xl text-sm font-bold hover:bg-red-600 hover:text-white transition-all">
                        <i class="fas fa-trash-alt mr-2"></i> Delete Record
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
