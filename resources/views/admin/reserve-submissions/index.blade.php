@extends('admin.layouts.app')

@section('title', 'Reservations')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-calendar-check mr-2 text-primary"></i> Reservations
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage room bookings and check-in schedules from guests.</p>
            </div>

            <div class="flex items-center space-x-3">
                <span
                    class="bg-gray-100 text-gray-600 px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-widest border border-gray-200 shadow-sm">
                    Total: {{ $reservations->count() }}
                </span>
            </div>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm animate-fadeIn">
                <i class="fas fa-check-circle mr-2 text-green-500"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Table Section --}}
        <div class="overflow-hidden shadow-xl rounded-2xl border border-gray-200 bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-16">SN</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Guest</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Room Type</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-center">Dates
                                (In/Out)</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-32">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($reservations as $r)
                            <tr class="hover:bg-gray-50/50 transition-colors {{ !$r->is_read ? 'bg-primary/5' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-400">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">{{ $r->full_name }}</div>
                                    <div class="text-[10px] text-gray-400 font-medium uppercase tracking-tighter">
                                        {{ $r->created_at->diffForHumans() }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2.5 py-1 bg-blue-50 text-blue-700 text-xs font-semibold rounded-lg border border-blue-100">
                                        {{ $r->room_type }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div
                                        class="flex items-center justify-center space-x-2 text-xs font-medium text-gray-600">
                                        <span
                                            class="bg-gray-50 px-2 py-1 rounded border border-gray-100">{{ $r->check_in->format('M d, Y') }}</span>
                                        <i class="fas fa-long-arrow-alt-right text-gray-300"></i>
                                        <span
                                            class="bg-gray-50 px-2 py-1 rounded border border-gray-100">{{ $r->check_out->format('M d, Y') }}</span>
                                    </div>
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-2">
                                        {{-- View --}}
                                        <a href="{{ route('reserve-submissions.show', $r) }}"
                                            class="p-2 text-primary hover:bg-green-700 hover:text-white rounded-lg transition-all"
                                            title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        {{-- Toggle Read Status --}}
                                        <form
                                            action="{{ $r->is_read ? route('reserve-submissions.unread', $r) : route('reserve-submissions.read', $r) }}"
                                            method="POST" class="inline-block">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                class="p-2 {{ $r->is_read ? 'text-gray-400' : 'text-green-600' }} hover:bg-gray-500 hover:text-white rounded-lg transition-all"
                                                title="{{ $r->is_read ? 'Mark as Unread' : 'Mark as Read' }}">
                                                <i class="fas {{ $r->is_read ? 'fa-envelope-open' : 'fa-envelope' }}"></i>
                                            </button>
                                        </form>

                                        {{-- Delete --}}
                                        <form action="{{ route('reserve-submissions.destroy', $r) }}" method="POST"
                                            onsubmit="return confirm('Delete this reservation?')" class="inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-400 hover:bg-red-500 hover:text-white rounded-lg transition-all"
                                                title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-calendar-times text-5xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-500 font-medium">No reservations found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
