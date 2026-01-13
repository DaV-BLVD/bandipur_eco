@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-utensils mr-2 text-primary"></i> Home Taste Section
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage the storytelling text and bullet points for the taste/experience
                    section.</p>
            </div>

            @if (!$content)
                <a href="{{ route('home-taste.create') }}"
                    class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#9a9a1e] shadow-lg shadow-indigo-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                    <i class="fas fa-plus text-xs"></i>
                    <span>Create Content</span>
                </a>
            @endif
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm">
                <i class="fas fa-check-circle mr-2 text-green-500"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Content Display --}}
        @if ($content)
            <div class="overflow-hidden shadow-xl rounded-2xl border border-gray-200 bg-white">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <span
                                class="text-[10px] font-black bg-primary/10 text-primary px-3 py-1 rounded-full uppercase tracking-widest">
                                {{ $content->subtitle ?? 'TASTE' }}
                            </span>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('home-taste.edit', $content->id) }}"
                                class="flex items-center space-x-2 bg-gray-900 text-white px-4 py-2 rounded-lg font-bold hover:bg-black transition-all shadow-md">
                                <i class="fas fa-edit text-xs"></i>
                                <span class="text-sm">Edit Section</span>
                            </a>
                        </div>
                    </div>

                    <h2 class="text-3xl font-serif text-gray-900 mb-4">{{ $content->title }}</h2>

                    <div class="prose max-w-none text-gray-600 leading-relaxed mb-8">
                        {{ $content->description }}
                    </div>

                    {{-- Taste Items / Features --}}
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-[0.2em] mb-4 flex items-center">
                            <i class="fas fa-list-ul mr-2 text-primary"></i> Highlighted Features
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @forelse ($content->items as $item)
                                <div
                                    class="flex items-center space-x-3 bg-white p-3 rounded-xl border border-gray-100 shadow-sm">
                                    <div class="w-2 h-2 rounded-full bg-primary"></div>
                                    <span class="text-gray-700 font-medium">{{ $item->text }}</span>
                                </div>
                            @empty
                                <p class="text-gray-400 text-sm italic">No items added yet.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-between">
                        <div class="text-xs text-gray-400">
                            <i class="far fa-clock mr-1"></i>
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
                            <i class="fas fa-utensils text-3xl text-gray-200"></i>
                        </div>
                        <p class="text-gray-500 font-medium">No Taste Section content found.</p>
                        <p class="text-gray-400 text-xs mt-1">Create the storytelling part of your homepage here.</p>
                        <a href="{{ route('home-taste.create') }}"
                            class="mt-4 text-primary hover:underline text-sm font-bold uppercase tracking-widest">
                            + Create Section
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
