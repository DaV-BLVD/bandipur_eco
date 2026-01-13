@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb --}}
        <div class="mb-6">
            <a href="{{ route('home-hero-slider.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Sliders</span>
            </a>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas {{ $slider ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $slider ? 'Edit Slide' : 'Create New Slide' }}
                </h1>
                <p class="text-white/80 text-sm mt-1">Design your homepage carousel slide with custom text, images, and theme
                    colors.</p>
            </div>

            <div class="p-8">
                {{-- Refined Error Display --}}
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

                <form method="POST" enctype="multipart/form-data"
                    action="{{ $slider ? route('home-hero-slider.update', $slider->id) : route('home-hero-slider.store') }}"
                    class="space-y-6">
                    @csrf
                    @if ($slider)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        {{-- Left Column (Media & Settings) --}}
                        <div class="lg:col-span-1 space-y-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Slide
                                    Image <span class="text-red-500">*</span></label>
                                <label
                                    class="flex flex-col items-center justify-center w-full h-48 border-2 {{ $errors->has('image') ? 'border-red-300 bg-red-50' : 'border-gray-200 bg-gray-50' }} border-dashed rounded-2xl cursor-pointer hover:bg-gray-100 transition-all group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i
                                            class="fas fa-cloud-upload-alt text-3xl text-gray-400 group-hover:text-primary transition-colors mb-3"></i>
                                        <p class="text-xs text-gray-400">Click to upload image</p>
                                    </div>
                                    <input type="file" name="image" class="hidden" />
                                </label>

                                @if ($slider && $slider->image)
                                    <div
                                        class="mt-4 p-2 bg-gray-50 rounded-xl border border-dashed border-gray-300 inline-block w-full">
                                        <p class="text-[10px] font-bold text-gray-400 uppercase mb-1 ml-1">Current Preview
                                        </p>
                                        <img src="{{ asset('storage/' . $slider->image) }}"
                                            class="w-full h-32 object-cover rounded-lg shadow-sm">
                                    </div>
                                @endif
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Theme
                                    Color</label>
                                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                                    <input type="color" name="color_hex"
                                        value="{{ old('color_hex', $slider->color_hex ?? '#6d6d18') }}"
                                        class="h-10 w-10 p-0 border-0 rounded cursor-pointer bg-transparent">
                                    <span
                                        class="text-sm font-mono text-gray-500 uppercase">{{ old('color_hex', $slider->color_hex ?? '#6d6d18') }}</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-1">Sort
                                        Order</label>
                                    <input type="number" name="sort_order"
                                        value="{{ old('sort_order', $slider->sort_order ?? 0) }}"
                                        class="w-full px-4 py-2 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                                </div>
                                <div class="flex items-end pb-1">
                                    <label class="flex items-center cursor-pointer group">
                                        <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                            {{ old('is_active', $slider->is_active ?? true) ? 'checked' : '' }}>
                                        <div
                                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary relative">
                                        </div>
                                        <span
                                            class="ml-3 text-sm font-bold text-gray-700 group-hover:text-black transition-colors">Active</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Right Column (Content Details) --}}
                        <div class="lg:col-span-2 space-y-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-1">Badge
                                    Text</label>
                                <input type="text" name="badge_text" placeholder="e.g. New Arrival"
                                    value="{{ old('badge_text', $slider->badge_text ?? '') }}"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                            </div>

                            <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100 space-y-4">
                                <label
                                    class="block text-sm font-bold text-gray-700 uppercase tracking-widest text-center border-b border-gray-200 pb-2">Main
                                    Heading Structure</label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                    <input type="text" name="title_prefix"
                                        value="{{ old('title_prefix', $slider->title_prefix ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-primary outline-none transition-all"
                                        placeholder="Prefix (Normal)">

                                    <input type="text" name="title_highlight"
                                        value="{{ old('title_highlight', $slider->title_highlight ?? '') }}"
                                        class="w-full px-3 py-2 border {{ $errors->has('title_highlight') ? 'border-red-300' : 'border-primary/30' }} bg-white rounded-lg text-primary font-bold focus:border-primary outline-none transition-all shadow-sm"
                                        placeholder="Highlight (Colored) *">

                                    <input type="text" name="title_suffix"
                                        value="{{ old('title_suffix', $slider->title_suffix ?? '') }}"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-primary outline-none transition-all"
                                        placeholder="Suffix (Normal)">
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-1">Description</label>
                                <textarea name="description" rows="3"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">{{ old('description', $slider->description ?? '') }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-1">Button
                                        Text</label>
                                    <input type="text" name="button_text"
                                        value="{{ old('button_text', $slider->button_text ?? 'Discover More') }}"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-1">Button
                                        Link <span class="text-red-500">*</span></label>
                                    <input type="text" name="button_link"
                                        value="{{ old('button_link', $slider->button_link ?? '#') }}"
                                        class="w-full px-4 py-3 border {{ $errors->has('button_link') ? 'border-red-300' : 'border-gray-200' }} rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all font-mono text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Footer Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('home-hero-slider.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all flex items-center space-x-2">
                            <span>Cancel</span>
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $slider ? 'Update Slide' : 'Save Slide' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
