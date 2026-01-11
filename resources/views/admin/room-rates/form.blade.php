@extends('admin.layouts.app')

@section('title', (isset($roomRate) ? 'Edit' : 'Create') . ' Room Rate')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('room-rates.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Room Rates</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas {{ isset($roomRate) ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ isset($roomRate) ? 'Edit Room Rate' : 'Create New Room Rate' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Configure pricing, details, and features for this room type.</p>
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

                <form method="POST" enctype="multipart/form-data" class="space-y-6"
                    action="{{ isset($roomRate) ? route('room-rates.update', $roomRate) : route('room-rates.store') }}">
                    @csrf
                    @isset($roomRate)
                        @method('PUT')
                    @endisset

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Title --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Room Title</label>
                            <input type="text" name="title" value="{{ old('title', $roomRate->title ?? '') }}"
                                placeholder="e.g. Deluxe Ocean Suite"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                        </div>

                        {{-- Badge --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Badge
                                (Label)</label>
                            <input type="text" name="badge" value="{{ old('badge', $roomRate->badge ?? '') }}"
                                placeholder="e.g. Popular, Luxury"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                        </div>
                    </div>

                    {{-- Image Upload --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Room Image</label>
                        <input type="file" name="image"
                            class="w-full px-4 py-2 border border-gray-200 rounded-xl bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-black file:text-white hover:file:bg-[#9a9a1e] cursor-pointer">

                        @isset($roomRate->image)
                            <div class="mt-4 p-2 bg-gray-50 rounded-xl border border-dashed border-gray-300 inline-block">
                                <img src="{{ asset('storage/' . $roomRate->image) }}" class="h-32 rounded-lg shadow-sm">
                            </div>
                        @endisset
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Price --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Price</label>
                            <input type="number" name="price" value="{{ old('price', $roomRate->price ?? '') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                        </div>
                        {{-- Currency --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Currency</label>
                            <input type="text" name="currency" value="{{ old('currency', $roomRate->currency ?? 'Rs') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                        </div>
                        {{-- Top Tag --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Top Tag</label>
                            <input type="text" name="tag" value="{{ old('tag', $roomRate->tag ?? '') }}"
                                placeholder="e.g. Best Seller"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Reviews --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Number of
                                Reviews</label>
                            <input type="number" name="reviews" value="{{ old('reviews', $roomRate->reviews ?? 0) }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                        </div>
                        {{-- Rating --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Star Rating
                                (1-5)</label>
                            <input type="number" name="rating" min="1" max="5"
                                value="{{ old('rating', $roomRate->rating ?? 5) }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                        </div>
                    </div>

                    {{-- Features Section --}}
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                        <label class="block text-sm font-bold text-primary uppercase tracking-widest mb-4">
                            Room Features & Amenities
                        </label>

                        <div id="features-wrapper" class="space-y-3">

                            {{-- Existing features (Edit) --}}
                            @if (!empty($roomRate->features))
                                @foreach ($roomRate->features as $feature)
                                    <div class="relative flex items-center gap-2 feature-row">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                            <i class="fas fa-check-circle text-xs"></i>
                                        </span>

                                        <input type="text" name="features[]" value="{{ $feature }}"
                                            class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary/20 outline-none transition-all text-sm">

                                        <button type="button" class="remove-feature text-red-500 hover:text-red-700">
                                            ✕
                                        </button>
                                    </div>
                                @endforeach
                            @endif

                            {{-- Empty row for Create --}}
                            @if (empty($roomRate->features))
                                <div class="relative flex items-center gap-2 feature-row">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                        <i class="fas fa-check-circle text-xs"></i>
                                    </span>

                                    <input type="text" name="features[]" placeholder="Feature"
                                        class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary/20 outline-none transition-all text-sm">

                                    <button type="button" class="remove-feature text-red-500 hover:text-red-700">
                                        ✕
                                    </button>
                                </div>
                            @endif

                        </div>

                        {{-- Add Button --}}
                        <button type="button" id="add-feature"
                            class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                            + Add Feature
                        </button>
                    </div>


                    {{-- Status Toggle --}}
                    <div class="flex items-center space-x-3 bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <input type="hidden" name="is_active" value="0">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                {{ old('is_active', $roomRate->is_active ?? 1) ? 'checked' : '' }}>
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                            </div>
                        </label>
                        <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Publish Room Rate</span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('room-rates.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ isset($roomRate) ? 'Update Room Rate' : 'Save Room Rate' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('add-feature').addEventListener('click', function() {
            const wrapper = document.getElementById('features-wrapper');

            const row = document.createElement('div');
            row.className = 'relative flex items-center gap-2 feature-row';
            row.innerHTML = `
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                <i class="fas fa-check-circle text-xs"></i>
            </span>

            <input type="text" name="features[]" placeholder="Feature"
                class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary/20 outline-none transition-all text-sm">

            <button type="button" class="remove-feature text-red-500 hover:text-red-700">
                ✕
            </button>
        `;

            wrapper.appendChild(row);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-feature')) {
                e.target.closest('.feature-row').remove();
            }
        });
    </script>

@endsection
