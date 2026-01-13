@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-map-marker-alt mr-2 text-primary"></i> Home Location Content
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage the heading and descriptive text for your primary location
                    section.</p>
            </div>

            @if (!$content)
                <a href="{{ route('home-location-content.create') }}"
                    class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#9a9a1e] shadow-lg shadow-indigo-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                    <i class="fas fa-plus text-xs"></i>
                    <span>Create Content</span>
                </a>
            @endif
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm animate-fadeIn">
                <i class="fas fa-check-circle mr-2 text-green-500"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Content Display --}}
        @if ($content)
            <div class="overflow-hidden shadow-xl rounded-2xl border border-gray-200 bg-white">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-4">
                        <span
                            class="text-[10px] font-black bg-gray-100 text-gray-500 px-2 py-1 rounded uppercase tracking-widest">
                            Current Active Content
                        </span>
                        <a href="{{ route('home-location-content.edit', $content->id) }}"
                            class="p-2 text-secondary hover:bg-green-400 hover:text-white rounded-lg transition-all"
                            title="Edit Content">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>

                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $content->heading }}</h2>
                    <div class="prose max-w-none text-gray-600 leading-relaxed">
                        {{ $content->description }}
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-between">
                        <div class="text-xs text-gray-400">
                            Last updated: {{ $content->updated_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- Empty State --}}
            <div class="overflow-hidden shadow-xl rounded-2xl border border-gray-200 bg-white">
                <div class="px-6 py-16 text-center">
                    <div class="flex flex-col items-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-map-marked-alt text-3xl text-gray-200"></i>
                        </div>
                        <p class="text-gray-500 font-medium">No Location Content found.</p>
                        <p class="text-gray-400 text-xs mt-1">Start by adding your location details for the homepage.</p>
                        <a href="{{ route('home-location-content.create') }}"
                            class="mt-4 text-primary hover:underline text-sm font-bold uppercase tracking-widest">
                            + Add Content
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
