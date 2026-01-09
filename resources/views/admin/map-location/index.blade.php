@extends('admin.layouts.app')

@section('title', 'Map Locations')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-map-marked-alt mr-2 text-primary"></i> Map Locations
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage the physical office locations and map coordinates displayed on
                    your contact page.</p>
            </div>

            {{-- Uncomment if you want the Add button --}}
            {{-- <a href="{{ route('map-location.create') }}"
                class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#9a9a1e] shadow-lg shadow-indigo-100">
                <i class="fas fa-plus text-xs"></i>
                <span>Add Location</span>
            </a> --}}
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm animate-fadeIn">
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
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Location Title</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-32">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($locations as $location)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- SN --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-400">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- Title --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $location->title }}</div>
                                    <div class="text-[10px] text-gray-400 uppercase tracking-tighter">Office Coordinates Set
                                    </div>
                                </td>

                                {{-- Status Badge --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    @if ($location->is_active)
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-700 border border-green-200 uppercase tracking-tighter">
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gray-100 text-gray-500 border border-gray-200 uppercase tracking-tighter">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-2">
                                        {{-- Edit --}}
                                        <a href="{{ route('map-location.edit', $location) }}"
                                            class="p-2 text-secondary hover:bg-green-400 hover:text-white rounded-lg transition-all"
                                            title="Edit Location">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Delete (Optional) --}}
                                        {{-- <form action="{{ route('map-location.destroy', $location) }}" method="POST"
                                              class="inline-block" onsubmit="return confirm('Delete this map location?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" 
                                                class="p-2 text-red-400 hover:bg-red-500 hover:text-white rounded-lg transition-all">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-map-marker-alt text-5xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-500 font-medium">No map locations found.</p>
                                        <p class="text-xs text-gray-400">Please add a location to display on the contact
                                            page.</p>
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
