@extends('admin.layouts.app')

@section('title', isset($aboutTwo) ? 'Edit About Section' : 'Add About Section')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('about-two.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to About List</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6 text-white">
                <h1 class="text-2xl font-bold tracking-tight flex items-center">
                    <i class="fas {{ isset($aboutTwo) ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ isset($aboutTwo) ? 'Edit About Section Two' : 'Add New About Section Two' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Configure the secondary about layout with dual descriptions and
                    custom features.</p>
            </div>

            <div class="p-8">
                <form action="{{ isset($aboutTwo) ? route('about-two.update', $aboutTwo->id) : route('about-two.store') }}"
                    method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if (isset($aboutTwo))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Tagline Field --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Tagline</label>
                            <input type="text" name="tagline" value="{{ old('tagline', $aboutTwo->tagline ?? '') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                placeholder="e.g. LUXURY AMENITIES">
                        </div>

                        {{-- Title Field --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Title</label>
                            <input type="text" name="title" value="{{ old('title', $aboutTwo->title ?? '') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                placeholder="Section Title">
                        </div>
                    </div>

                    {{-- Description 1 --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Primary
                            Description</label>
                        <textarea name="description1" rows="3"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                            placeholder="First paragraph of text...">{{ old('description1', $aboutTwo->description1 ?? '') }}</textarea>
                    </div>

                    {{-- Description 2 --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Secondary
                            Description</label>
                        <textarea name="description2" rows="3"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                            placeholder="Second paragraph of text...">{{ old('description2', $aboutTwo->description2 ?? '') }}</textarea>
                    </div>

                    {{-- Image Upload --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Featured Image</label>
                        <div class="flex items-start space-x-4">
                            <div class="flex-1">
                                <input type="file" name="image"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-black file:text-white hover:file:bg-[#9a9a1e] transition-all cursor-pointer">
                            </div>
                            @if (isset($aboutTwo) && $aboutTwo->image)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $aboutTwo->image) }}"
                                        class="w-32 h-20 object-cover rounded-xl shadow-md border-2 border-white">
                                    <div
                                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex items-center justify-center">
                                        <span class="text-[10px] text-white font-bold uppercase tracking-tighter">Current
                                            Image</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="pt-4">
                        <h4
                            class="text-lg font-black text-gray-800 uppercase tracking-tighter mb-4 border-b pb-2 flex items-center">
                            <i class="fas fa-th-list mr-2 text-primary"></i> Feature Highlights
                        </h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @for ($i = 1; $i <= 2; $i++)
                                <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100 space-y-4">
                                    <div class="flex items-center justify-between">
                                        <span
                                            class="bg-primary text-white text-[10px] px-2 py-0.5 rounded-md font-bold uppercase">Feature
                                            {{ $i }}</span>
                                    </div>

                                    <div class="space-y-1">
                                        <label class="block text-[10px] font-black text-gray-400 uppercase">Icon Class
                                            (FontAwesome)</label>
                                        <input type="text" name="feature{{ $i }}_icon"
                                            value="{{ old("feature{$i}_icon", $aboutTwo["feature{$i}_icon"] ?? '') }}"
                                            placeholder="e.g. fas fa-swimming-pool"
                                            class="w-full p-2.5 border border-gray-200 rounded-lg focus:border-primary outline-none text-sm">
                                    </div>

                                    <div class="space-y-1">
                                        <label class="block text-[10px] font-black text-gray-400 uppercase">Feature
                                            Title</label>
                                        <input type="text" name="feature{{ $i }}_title"
                                            value="{{ old("feature{$i}_title", $aboutTwo["feature{$i}_title"] ?? '') }}"
                                            placeholder="Feature Title"
                                            class="w-full p-2.5 border border-gray-200 rounded-lg focus:border-primary outline-none text-sm font-bold">
                                    </div>

                                    <div class="space-y-1">
                                        <label class="block text-[10px] font-black text-gray-400 uppercase">Short
                                            Description</label>
                                        <input type="text" name="feature{{ $i }}_description"
                                            value="{{ old("feature{$i}_description", $aboutTwo["feature{$i}_description"] ?? '') }}"
                                            placeholder="Short details..."
                                            class="w-full p-2.5 border border-gray-200 rounded-lg focus:border-primary outline-none text-sm">
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('about-two.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ isset($aboutTwo) ? 'Update About' : 'Create About' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
