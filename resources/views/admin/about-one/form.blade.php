@extends('admin.layouts.app')

@section('title', isset($aboutOne) ? 'Edit About Section' : 'Add About Section')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('about-one.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to About List</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6 text-white">
                <h1 class="text-2xl font-bold tracking-tight flex items-center">
                    <i class="fas {{ isset($aboutOne) ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ isset($aboutOne) ? 'Edit About Section' : 'Add New About Section' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Update the introductory details, statistics, and main image for
                    the about section.</p>
            </div>

            <div class="p-8">
                <form action="{{ isset($aboutOne) ? route('about-one.update', $aboutOne->id) : route('about-one.store') }}"
                    method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if (isset($aboutOne))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Since Field --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Since
                                (Year)</label>
                            <input type="text" name="since" value="{{ old('since', $aboutOne->since ?? '') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                placeholder="e.g. 1992">
                        </div>

                        {{-- Title Field --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Title</label>
                            <input type="text" name="title" value="{{ old('title', $aboutOne->title ?? '') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                placeholder="Section Title">
                        </div>
                    </div>

                    {{-- Subtitle Field --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Subtitle</label>
                        <input type="text" name="subtitle" value="{{ old('subtitle', $aboutOne->subtitle ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                            placeholder="Enter subtitle...">
                    </div>

                    {{-- Description Field --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                            placeholder="Detailed description...">{{ old('description', $aboutOne->description ?? '') }}</textarea>
                    </div>

                    {{-- Stats Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-5 bg-gray-50 rounded-2xl border border-gray-100">
                        <div class="space-y-1">
                            <label class="block text-xs font-black text-gray-400 uppercase">Suites</label>
                            <input type="number" name="suites" value="{{ old('suites', $aboutOne->suites ?? '') }}"
                                class="w-full p-2.5 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/10 outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-xs font-black text-gray-400 uppercase">Acres</label>
                            <input type="number" name="acres" value="{{ old('acres', $aboutOne->acres ?? '') }}"
                                class="w-full p-2.5 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/10 outline-none">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-xs font-black text-gray-400 uppercase">Views</label>
                            <input type="text" name="views" value="{{ old('views', $aboutOne->views ?? '') }}"
                                class="w-full p-2.5 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/10 outline-none"
                                placeholder="e.g. Mountain">
                        </div>
                    </div>

                    {{-- Image Upload --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Section Image</label>
                        <div class="flex items-start space-x-4">
                            <div class="flex-1">
                                <input type="file" name="image"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-primary file:text-white hover:file:bg-[#9a9a1e] transition-all cursor-pointer">
                                <p class="text-[10px] text-gray-400 mt-2 uppercase font-bold tracking-widest">Recommended
                                    size: 800x600px (JPG/PNG)</p>
                            </div>
                            @if (isset($aboutOne) && $aboutOne->image)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $aboutOne->image) }}"
                                        class="w-32 h-20 object-cover rounded-xl shadow-md border-2 border-white">
                                    <div
                                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                                        <span class="text-[10px] text-white font-bold uppercase">Current</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Quote Field --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Quote</label>
                        <div class="relative">
                            <span class="absolute top-3 left-3 text-primary opacity-30 text-xl font-serif">"</span>
                            <input type="text" name="quote" value="{{ old('quote', $aboutOne->quote ?? '') }}"
                                class="w-full pl-8 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 italic"
                                placeholder="Enter a feature quote...">
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('about-one.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ isset($aboutOne) ? 'Update Section' : 'Create Section' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
