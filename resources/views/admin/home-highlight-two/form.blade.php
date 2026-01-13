@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-5xl mx-auto">
        {{-- Back Link --}}
        <div class="mb-6">
            <a href="{{ route('home-highlight-two.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Highlights</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6 text-white">
                <h1 class="text-2xl font-bold tracking-tight flex items-center">
                    <i class="fas {{ $content ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $content ? 'Edit Highlight Section' : 'Create Highlight Section' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Configure the main headings, descriptions, and feature items for
                    this section.</p>
            </div>

            <div class="p-8">
                <form method="POST" enctype="multipart/form-data" class="space-y-8"
                    action="{{ $content ? route('home-highlight-two.update', $content->id) : route('home-highlight-two.store') }}">
                    @csrf
                    @if ($content)
                        @method('PUT')
                    @endif

                    {{-- Main Content Section --}}
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Label</label>
                                <input name="label" type="text" placeholder="e.g. OUR AMENITIES"
                                    value="{{ old('label', $content->label ?? '') }}"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium">
                            </div>

                            <div class="space-y-1">
                                <label
                                    class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Heading</label>
                                <input name="heading" type="text" placeholder="Section Main Heading"
                                    value="{{ old('heading', $content->heading ?? '') }}"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Main
                                Description</label>
                            <textarea name="description" rows="3" placeholder="Enter introductory text..."
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium">{{ old('description', $content->description ?? '') }}</textarea>
                        </div>
                    </div>

                    {{-- Feature Items Section --}}
                    <div class="pt-6 border-t border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-list-ul mr-2 text-primary"></i> Feature Items
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @for ($i = 0; $i < 2; $i++)
                                <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100 space-y-3">
                                    <div class="flex items-center justify-between mb-2">
                                        <span
                                            class="text-[10px] font-black bg-primary text-white px-2 py-0.5 rounded uppercase">Item
                                            {{ $i + 1 }}</span>
                                        <input type="hidden" name="items[{{ $i }}][order]"
                                            value="{{ $i + 1 }}">
                                    </div>

                                    <input name="items[{{ $i }}][title]" placeholder="Item Title"
                                        value="{{ $content->items[$i]->title ?? '' }}"
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/10 outline-none text-sm font-bold">

                                    <textarea name="items[{{ $i }}][text]" placeholder="Short description for this item..."
                                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/10 outline-none text-sm min-h-[80px]">{{ $content->items[$i]->text ?? '' }}</textarea>
                                </div>
                            @endfor
                        </div>
                    </div>

                    {{-- Media Section --}}
                    <div class="pt-6 border-t border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-images mr-2 text-primary"></i> Gallery Media
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- Image One --}}
                            <div class="space-y-3">
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">Primary
                                    Image</label>
                                <div class="flex items-center space-x-4">
                                    <input type="file" name="image_one"
                                        class="flex-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-black file:text-white hover:file:bg-[#9a9a1e] transition-all cursor-pointer">
                                    @if ($content && $content->image_one)
                                        <img src="{{ asset('storage/' . $content->image_one) }}"
                                            class="w-16 h-16 object-cover rounded-lg border">
                                    @endif
                                </div>
                            </div>

                            {{-- Image Two --}}
                            <div class="space-y-3">
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">Secondary
                                    Image</label>
                                <div class="flex items-center space-x-4">
                                    <input type="file" name="image_two"
                                        class="flex-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-black file:text-white hover:file:bg-[#9a9a1e] transition-all cursor-pointer">
                                    @if ($content && $content->image_two)
                                        <img src="{{ asset('storage/' . $content->image_two) }}"
                                            class="w-16 h-16 object-cover rounded-lg border">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-8 border-t border-gray-100 mt-4">
                        <a href="{{ route('home-highlight-two.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $content ? 'Update Highlight' : 'Save Highlight' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
