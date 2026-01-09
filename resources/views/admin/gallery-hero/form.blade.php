@extends('admin.layouts.app')

@section('title', $hero->exists ? 'Edit Gallery Hero' : 'Add Gallery Hero')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('gallery-hero.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Gallery Heroes</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas {{ $hero->exists ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $hero->exists ? 'Edit Gallery Hero' : 'Add New Gallery Hero' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Upload and manage high-resolution images for the gallery section
                    hero banner.</p>
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
                    action="{{ $hero->exists ? route('gallery-hero.update', $hero) : route('gallery-hero.store') }}"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if ($hero->exists)
                        @method('PUT')
                    @endif

                    {{-- Image Upload Section --}}
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Hero Image</label>

                        <div class="flex items-center justify-center w-full">
                            <label
                                class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-200 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-bold">Click to upload</span> or
                                        drag and drop</p>
                                    <p class="text-xs text-gray-400">JPG, PNG or WEBP (Max: 2MB)</p>
                                </div>
                                <input type="file" name="image" class="hidden" />
                            </label>
                        </div>

                        @if ($hero->image)
                            <div class="mt-4">
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Current
                                    Preview</label>
                                <div class="relative inline-block">
                                    <img src="{{ asset('storage/' . $hero->image) }}"
                                        class="h-44 w-full object-cover rounded-xl border border-gray-200 shadow-sm">
                                    <div
                                        class="absolute top-2 right-2 bg-primary text-white text-[10px] px-2 py-1 rounded-md font-bold shadow-sm">
                                        CURRENT
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Visibility Divider --}}
                    <div class="relative py-4">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-100"></div>
                        </div>
                        <div class="relative flex justify-start text-sm font-bold uppercase tracking-widest">
                            <span class="bg-white pr-4 text-primary">Visibility Settings</span>
                        </div>
                    </div>

                    {{-- Active Status Toggle --}}
                    <div class="flex items-center space-x-3 bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                {{ old('is_active', $hero->is_active) ? 'checked' : '' }}>
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                            </div>
                        </label>
                        <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Set as Active Hero</span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('gallery-hero.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $hero->exists ? 'Update Hero Image' : 'Save Hero Image' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
