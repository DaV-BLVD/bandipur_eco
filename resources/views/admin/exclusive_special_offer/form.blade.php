{{-- resources/views/admin/exclusive_special_offer/form.blade.php --}}
@extends('admin.layouts.app')

@section('title', $offer->exists ? 'Edit Special Offer' : 'Create Special Offer')

@section('content')
@php $isEdit = $offer->exists; @endphp

<div class="p-6 max-w-4xl mx-auto">
    {{-- Breadcrumb/Back Link --}}
    <div class="mb-6">
        <a href="{{ route('exclusive-special-offer.index') }}" class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Back to Offers List</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
        {{-- Form Header --}}
        <div class="bg-primary px-8 py-6">
            <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                <i class="fas {{ $isEdit ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i> 
                {{ $isEdit ? 'Edit Special Offer' : 'Create New Special Offer' }}
            </h1>
            <p class="text-indigo-100/80 text-sm mt-1">Fill in the details below to publish an exclusive deal on the website.</p>
        </div>

        <div class="p-8">
            {{-- Display Errors --}}
            @if($errors->any())
                <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-lg shadow-sm">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span class="font-bold">Please correct the following:</span>
                    </div>
                    <ul class="list-disc pl-5 text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ $isEdit ? route('exclusive-special-offer.update', $offer) : route('exclusive-special-offer.store') }}"
                method="POST" class="space-y-6">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Title --}}
                    <div class="md:col-span-2 space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Offer Title</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-heading text-xs"></i>
                            </span>
                            <input type="text" name="title" value="{{ old('title', $offer->title) }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                placeholder="e.g., Honeymoon Package" required>
                        </div>
                    </div>

                    {{-- Discount --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Discount / Subtitle</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-percentage text-xs"></i>
                            </span>
                            <input type="text" name="discount" value="{{ old('discount', $offer->discount) }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all" 
                                placeholder="e.g., 15% Off">
                        </div>
                    </div>

                    {{-- Icon --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Icon Class (FontAwesome)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-star text-xs"></i>
                            </span>
                            <input type="text" name="icon" value="{{ old('icon', $offer->icon) }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all" 
                                placeholder="e.g., fas fa-gem">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="md:col-span-2 space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all" 
                            required>{{ old('description', $offer->description) }}</textarea>
                    </div>

                    {{-- Tags Section --}}
                    <div class="md:col-span-2 space-y-3">
                        <div class="relative py-2">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-100"></div>
                            </div>
                            <div class="relative flex justify-start text-sm font-bold uppercase tracking-widest">
                                <span class="bg-white pr-4 text-primary">Offer Highlights (Tags)</span>
                            </div>
                        </div>

                        <div id="tags-wrapper" class="space-y-3">
                            @php $tags = old('tags', $offer->tags ?? ['']); @endphp
                            @foreach ($tags as $index => $tag)
                                <div class="flex items-center gap-3 tag-item bg-gray-50 p-2 rounded-xl border border-gray-100">
                                    <div class="flex-grow relative">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                            <i class="fas fa-check-circle text-[10px]"></i>
                                        </span>
                                        <input type="text" name="tags[]" value="{{ $tag }}"
                                            class="w-full pl-8 pr-4 py-2 border border-gray-200 rounded-lg focus:border-primary outline-none transition-all"
                                            placeholder="e.g., Free Breakfast">
                                    </div>
                                    <button type="button" class="remove-tag text-red-400 hover:text-red-600 p-2 hover:bg-red-50 rounded-lg transition-all">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        
                        <button type="button" id="add-tag"
                            class="inline-flex items-center text-xs font-bold uppercase tracking-widest text-secondary hover:text-primary transition-colors">
                            <i class="fas fa-plus-circle mr-1"></i> Add Another Highlight
                        </button>
                    </div>

                    {{-- Status Toggle --}}
                    <div class="md:col-span-2 space-y-3 pt-4">
                         <div class="relative py-2">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                <div class="w-full border-t border-gray-100"></div>
                            </div>
                            <div class="relative flex justify-start text-sm font-bold uppercase tracking-widest">
                                <span class="bg-white pr-4 text-primary">Visibility Settings</span>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3 bg-gray-50 p-4 rounded-xl border border-gray-100 w-full md:w-fit">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="status" value="1" class="sr-only peer" 
                                    {{ old('status', $offer->status ?? 1) == 1 ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            </label>
                            <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Active Status</span>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                    <a href="{{ route('exclusive-special-offer.index') }}"
                        class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                        <i class="fas fa-save text-sm"></i>
                        <span>{{ $isEdit ? 'Update Offer' : 'Save Offer' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const wrapper = document.getElementById('tags-wrapper');
        const addBtn = document.getElementById('add-tag');

        // Add Tag
        addBtn.addEventListener('click', () => {
            const div = document.createElement('div');
            div.className = 'flex items-center gap-3 tag-item bg-gray-50 p-2 rounded-xl border border-gray-100';
            div.innerHTML = `
                <div class="flex-grow relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-check-circle text-[10px]"></i>
                    </span>
                    <input type="text" name="tags[]" class="w-full pl-8 pr-4 py-2 border border-gray-200 rounded-lg focus:border-primary outline-none transition-all" placeholder="New highlight">
                </div>
                <button type="button" class="remove-tag text-red-400 hover:text-red-600 p-2 hover:bg-red-50 rounded-lg transition-all">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;
            wrapper.appendChild(div);
        });

        // Remove Tag
        wrapper.addEventListener('click', (e) => {
            if (e.target.closest('.remove-tag')) {
                const items = wrapper.querySelectorAll('.tag-item');
                if (items.length > 1) {
                    e.target.closest('.tag-item').remove();
                } else {
                    items[0].querySelector('input').value = '';
                }
            }
        });
    });
</script>
@endsection