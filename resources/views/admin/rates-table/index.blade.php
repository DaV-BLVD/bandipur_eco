@extends('admin.layouts.app')

@section('title', 'Room Rates Management')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">
        
        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-bed mr-2 text-primary"></i> Room Rates Table
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage pricing, occupancy rates, and inclusions for all room categories.</p>
            </div>

            <a href="{{ route('rates-table.create') }}"
                class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#9a9a1e] shadow-lg shadow-indigo-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                <i class="fas fa-plus text-xs"></i>
                <span>Add New Rate</span>
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm">
                <i class="fas fa-check-circle mr-2 text-green-500"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Table Section (Card Layout) --}}
        <div class="overflow-hidden shadow-xl rounded-2xl border border-gray-200 bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    {{-- Table Header --}}
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-16">SN</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Room Type</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest">Single</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest">Double</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest">Extra Bed</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest">Currency</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Inclusions</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100">
                        @forelse($rates as $rate)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- SN --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-400">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- Room Type --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">{{ $rate->room_type }}</div>
                                </td>

                                {{-- Single Price --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <span class="text-sm font-semibold text-gray-700">
                                        {{ $rate->currency == 'USD' ? '$' : 'रु' }}{{ number_format($rate->single_price) ?? '—' }}
                                    </span>
                                </td>

                                {{-- Double Price --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <span class="text-sm font-semibold text-gray-700">
                                        {{ $rate->currency == 'USD' ? '$' : 'रु' }}{{ number_format($rate->double_price) ?? '—' }}
                                    </span>
                                </td>

                                {{-- Extra Bed --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap text-sm text-gray-500">
                                    {{ $rate->currency == 'USD' ? '$' : 'रु' }}{{ number_format($rate->extra_bed) ?? '0' }}
                                </td>

                                {{-- Currency --}}
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2 py-0.5 bg-indigo-50 text-indigo-600 text-[10px] font-black rounded border border-indigo-100 uppercase">
                                        {{ $rate->currency }}
                                    </span>
                                </td>

                                {{-- Inclusions --}}
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1 max-w-xs">
                                        @foreach ($rate->inclusions ?? [] as $inc)
                                            <span class="px-2 py-0.5 bg-[#0a7c15]/5 text-[#0a7c15] text-[11px] font-bold rounded-md border border-[#0a7c15]/10">
                                                {{ $inc }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-2">
                                        {{-- Edit --}}
                                        <a href="{{ route('rates-table.edit', $rate) }}"
                                            class="p-2 text-secondary hover:bg-green-400 hover:text-white rounded-lg transition-all"
                                            title="Edit Rate">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('rates-table.destroy', $rate) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this room rate?');"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all"
                                                title="Delete Rate">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-receipt text-5xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-500 font-medium">No room rates defined yet.</p>
                                        <a href="{{ route('rates-table.create') }}"
                                            class="mt-2 text-primary hover:underline text-sm font-semibold">Add your first rate</a>
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