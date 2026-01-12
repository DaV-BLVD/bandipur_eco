@extends('admin.layouts.app')

@section('title', isset($room) ? 'Edit Room' : 'Create Room')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('rooms.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Room List</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas {{ isset($room) ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ isset($room) ? 'Edit Room Listing' : 'Add New Room Listing' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Fill in the details below to update your accommodation options.
                </p>
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

                <form action="{{ isset($room) ? route('rooms.update', $room->id) : route('rooms.store') }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @if (isset($room))
                        @method('PUT')
                    @endif

                    {{-- Row 1: Title & Category --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Room Title</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-tag text-xs"></i>
                                </span>
                                <input name="title" value="{{ old('title', $room->title ?? '') }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                    type="text" placeholder="e.g. Deluxe Single">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Category</label>
                            <select name="category"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all appearance-none cursor-pointer">
                                <option value="single"
                                    {{ old('category', $room->category ?? '') == 'single' ? 'selected' : '' }}>Single
                                </option>
                                <option value="double"
                                    {{ old('category', $room->category ?? '') == 'double' ? 'selected' : '' }}>Double
                                </option>
                                <option value="others"
                                    {{ old('category', $room->category ?? '') == 'others' ? 'selected' : '' }}>Others
                                </option>
                            </select>
                        </div>
                    </div>

                    {{-- Row 2: Occupancy & Bed Type --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Occupancy</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-users text-xs"></i>
                                </span>
                                <input name="occupancy" value="{{ old('occupancy', $room->occupancy ?? '') }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                    type="text" placeholder="e.g. 2 Guests">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Bed Type</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-bed text-xs"></i>
                                </span>
                                <input name="bed_type" value="{{ old('bed_type', $room->bed_type ?? '') }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                    type="text" placeholder="e.g. King Bed">
                            </div>
                        </div>
                    </div>

                    {{-- Row 3: Currency & Price --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Currency</label>
                            <select name="currency"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all appearance-none cursor-pointer">
                                <option value="USD"
                                    {{ old('currency', $room->currency ?? '') == 'USD' ? 'selected' : '' }}>USD ($)
                                </option>
                                <option value="NPR"
                                    {{ old('currency', $room->currency ?? '') == 'NPR' ? 'selected' : '' }}>NPR (Rs.)
                                </option>
                            </select>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Price per
                                Night</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 font-bold">
                                    <i class="fas fa-dollar-sign text-xs"></i>
                                </span>
                                <input name="price" value="{{ old('price', $room->price ?? '') }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                    type="number" step="0.01">
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">{{ old('description', $room->description ?? '') }}</textarea>
                    </div>

                    {{-- Image Upload Section --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Room Image</label>
                        <input name="image" type="file"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-black file:text-white hover:file:bg-[#9a9a1e] cursor-pointer">

                        @if (isset($room) && $room->image)
                            <div class="mt-4 p-2 bg-gray-50 rounded-xl border border-dashed border-gray-300 inline-block">
                                <p class="text-[10px] uppercase font-bold text-gray-400 mb-1 ml-1">Current Image Preview</p>
                                <img src="{{ asset('storage/' . $room->image) }}" class="h-32 rounded-lg shadow-sm">
                            </div>
                        @endif
                    </div>

                    {{-- Amenities Section --}}
                    <div class="relative py-4">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-100"></div>
                        </div>
                        <div class="relative flex justify-start text-sm font-bold uppercase tracking-widest">
                            <span class="bg-white pr-4 text-primary">Amenities & Extras</span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3 bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="has_wifi" value="0">
                            <input type="checkbox" name="has_wifi" value="1" class="sr-only peer"
                                {{ old('has_wifi', $room->has_wifi ?? 1) ? 'checked' : '' }}>
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                            </div>
                        </label>
                        <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Free WiFi Access</span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('rooms.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ isset($room) ? 'Update Room' : 'Save Room' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
