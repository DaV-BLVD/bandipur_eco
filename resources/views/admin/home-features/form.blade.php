@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('home-features.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Home Features</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas {{ $feature ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $feature ? 'Edit Feature Highlight' : 'Add New Feature Highlight' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Configure the time, title, and display order for this homepage
                    feature.</p>
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
                    action="{{ $feature ? route('home-features.update', $feature->id) : route('home-features.store') }}"
                    class="space-y-6">
                    @csrf
                    @if ($feature)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Time Input --}}
                        <div class="space-y-1">
                            <label for="time"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Display Time</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="far fa-clock text-xs"></i>
                                </span>
                                <input type="text" id="time" name="time"
                                    value="{{ old('time', $feature->time ?? '') }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                    placeholder="e.g. 06:00 AM">
                            </div>
                        </div>

                        {{-- Order Input --}}
                        <div class="space-y-1">
                            <label for="order"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Display Order</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-sort-numeric-down text-xs"></i>
                                </span>
                                <input type="number" id="order" name="order"
                                    value="{{ old('order', $feature->order ?? '') }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                    placeholder="1">
                            </div>
                        </div>
                    </div>

                    {{-- Title Input --}}
                    <div class="space-y-1">
                        <label for="title" class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Feature
                            Title</label>
                        <input type="text" id="title" name="title"
                            value="{{ old('title', $feature->title ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                            placeholder="e.g. Morning Yoga Session">
                    </div>

                    {{-- Description Input --}}
                    <div class="space-y-1">
                        <label for="description"
                            class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Description</label>
                        <textarea id="description" name="description" rows="4"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                            placeholder="Describe this feature highlight...">{{ old('description', $feature->description ?? '') }}</textarea>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('home-features.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $feature ? 'Update Feature' : 'Save Feature' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
