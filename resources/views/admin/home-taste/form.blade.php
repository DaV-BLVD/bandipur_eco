@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('home-taste.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Taste Section</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6 text-white">
                <h1 class="text-2xl font-bold tracking-tight flex items-center">
                    <i class="fas {{ $content ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $content ? 'Edit Taste Content' : 'Create Taste Content' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Configure the storytelling titles, description, and key bullet
                    points for the homepage experience section.</p>
            </div>

            <div class="p-8">
                <form method="POST"
                    action="{{ $content ? route('home-taste.update', $content->id) : route('home-taste.store') }}"
                    class="space-y-6">
                    @csrf
                    @if ($content)
                        @method('PUT')
                    @endif

                    {{-- Main Titles Section --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Subtitle</label>
                            <input type="text" name="subtitle" value="{{ old('subtitle', $content->subtitle ?? '') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                placeholder="e.g. THE TASTE">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Main Title</label>
                            <input type="text" name="title" value="{{ old('title', $content->title ?? '') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                placeholder="e.g. Traditional Culinary Secrets">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                            placeholder="Enter the main storytelling text...">{{ old('description', $content->description ?? '') }}</textarea>
                    </div>

                    <hr class="border-gray-100">

                    {{-- Dynamic Bullet Points Section --}}
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-list-ul mr-2 text-primary"></i> Highlighted Features
                            </label>
                            <button type="button" id="add-bullet"
                                class="text-xs font-bold bg-primary/10 text-primary px-3 py-1.5 rounded-lg hover:bg-primary hover:text-white transition-all">
                                <i class="fas fa-plus mr-1"></i> Add Bullet Point
                            </button>
                        </div>

                        @php
                            $items = old('items', $content->items ?? [['text' => '']]);
                        @endphp

                        <div id="bullet-points-container" class="space-y-3">
                            @foreach ($items as $i => $item)
                                <div class="flex items-center gap-3 group animate-fadeIn">
                                    <div class="flex-grow relative">
                                        <span
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-300 group-hover:text-primary transition-colors">
                                            <i class="fas fa-circle text-[8px]"></i>
                                        </span>
                                        <input type="text" name="items[{{ $i }}][text]"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-700 font-medium"
                                            placeholder="Bullet point text..."
                                            value="{{ is_array($item) ? $item['text'] : $item->text }}">
                                    </div>
                                    <button type="button"
                                        class="remove-bullet p-3 text-red-400 hover:bg-red-50 hover:text-red-600 rounded-xl transition-all"
                                        onclick="this.parentElement.remove()">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('home-taste.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $content ? 'Update Taste Section' : 'Save Taste Section' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let bulletIndex = {{ count($items) }};

            document.getElementById('add-bullet').addEventListener('click', function() {
                const container = document.getElementById('bullet-points-container');
                const div = document.createElement('div');
                div.classList.add('flex', 'items-center', 'gap-3', 'group', 'animate-fadeIn');

                div.innerHTML = `
                    <div class="flex-grow relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-300 group-hover:text-primary transition-colors">
                            <i class="fas fa-circle text-[8px]"></i>
                        </span>
                        <input type="text" name="items[${bulletIndex}][text]" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-700 font-medium" 
                            placeholder="Bullet point text...">
                    </div>
                    <button type="button" class="remove-bullet p-3 text-red-400 hover:bg-red-50 hover:text-red-600 rounded-xl transition-all" onclick="this.parentElement.remove()">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                `;
                container.appendChild(div);
                bulletIndex++;
            });
        </script>
    @endpush
@endsection
