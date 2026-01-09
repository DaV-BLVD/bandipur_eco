@extends('admin.layouts.app')

@section('title', $mapLocation->exists ? 'Edit Map Location' : 'Add Map Location')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('map-location.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Map Locations</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas {{ $mapLocation->exists ? 'fa-map-marker-alt' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $mapLocation->exists ? 'Edit Map Location' : 'Add New Map Location' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Configure office coordinates, embed URLs, and custom branding
                    colors for the map section.</p>
            </div>

            <div class="p-8">
                {{-- Display Errors --}}
                @if ($errors->any())
                    <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span class="font-bold">Please correct the following:</span>
                        </div>
                        <ul class="list-disc pl-5 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                    action="{{ $mapLocation->exists ? route('map-location.update', $mapLocation) : route('map-location.store') }}"
                    class="space-y-6">
                    @csrf
                    @if ($mapLocation->exists)
                        @method('PUT')
                    @endif

                    {{-- Title --}}
                    <div class="space-y-1">
                        <label for="title"
                            class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Location Title</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-tag text-xs"></i>
                            </span>
                            <input type="text" id="title" name="title"
                                value="{{ old('title', $mapLocation->title) }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                required placeholder="e.g. Headquarters Office">
                        </div>
                    </div>

                    {{-- Embed URL --}}
                    <div class="space-y-1">
                        <label for="embed_url" class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Google
                            Maps Embed URL</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-link text-xs"></i>
                            </span>
                            <input type="text" id="embed_url" name="embed_url"
                                value="{{ old('embed_url', $mapLocation->embed_url) }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                required placeholder="https://www.google.com/maps/embed?pb=...">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="space-y-1">
                        <label for="description"
                            class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Description
                            (Optional)</label>
                        <textarea id="description" name="description" rows="3"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                            placeholder="Briefly describe this location...">{{ old('description', $mapLocation->description) }}</textarea>
                    </div>

                    {{-- Color Settings --}}
                    <div class="relative py-4">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-100"></div>
                        </div>
                        <div class="relative flex justify-start text-sm font-bold uppercase tracking-widest">
                            <span class="bg-white pr-4 text-primary">Map Branding Colors</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-center space-x-4 bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <input type="color" name="primary_color" id="primary_color"
                                value="{{ old('primary_color', $mapLocation->primary_color ?? '#0a7c15') }}"
                                class="h-10 w-10 border-none rounded cursor-pointer bg-transparent">
                            <label for="primary_color"
                                class="text-sm font-bold text-gray-700 uppercase tracking-wide cursor-pointer">Primary
                                Color</label>
                        </div>
                        <div class="flex items-center space-x-4 bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <input type="color" name="secondary_color" id="secondary_color"
                                value="{{ old('secondary_color', $mapLocation->secondary_color ?? '#6d6d18') }}"
                                class="h-10 w-10 border-none rounded cursor-pointer bg-transparent">
                            <label for="secondary_color"
                                class="text-sm font-bold text-gray-700 uppercase tracking-wide cursor-pointer">Secondary
                                Color</label>
                        </div>
                    </div>

                    {{-- Visibility Toggle --}}
                    <div class="flex items-center space-x-3 bg-gray-50 p-4 rounded-xl border border-gray-100 mt-6">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                {{ old('is_active', $mapLocation->is_active) ? 'checked' : '' }}>
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                            </div>
                        </label>
                        <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Publish Location on
                            Website</span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('map-location.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all flex items-center space-x-2">
                            <span>Cancel</span>
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $mapLocation->exists ? 'Update Location' : 'Save Location' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
