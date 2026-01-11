@extends('admin.layouts.app')

@section('title', (isset($rateHeader) ? 'Edit' : 'Create') . ' Rate Header')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('rate-header.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Rate Headers</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas {{ isset($rateHeader) ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ isset($rateHeader) ? 'Edit Rate Header' : 'Add New Rate Header' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Configure pricing highlights, discounts, and room stats for the
                    rates section.</p>
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
                    action="{{ isset($rateHeader) ? route('rate-header.update', $rateHeader) : route('rate-header.store') }}"
                    class="space-y-6">
                    @csrf
                    @isset($rateHeader)
                        @method('PUT')
                    @endisset

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Badge Text --}}
                        <div class="space-y-1">
                            <label for="badge_text"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Badge Text</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-tag text-xs"></i>
                                </span>
                                <input type="text" id="badge_text" name="badge_text"
                                    value="{{ old('badge_text', $rateHeader->badge_text ?? '') }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                    placeholder="e.g. OUR PRICING">
                            </div>
                        </div>

                        {{-- Title --}}
                        <div class="space-y-1">
                            <label for="title"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Title *</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-heading text-xs"></i>
                                </span>
                                <input type="text" id="title" name="title"
                                    value="{{ old('title', $rateHeader->title ?? '') }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                    required placeholder="e.g. Flexible Rates for You">
                            </div>
                        </div>
                    </div>

                    {{-- Highlighted Word --}}
                    <div class="space-y-1">
                        <label for="highlight_text"
                            class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Highlighted Word</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-highlighter text-xs"></i>
                            </span>
                            <input type="text" id="highlight_text" name="highlight_text"
                                value="{{ old('highlight_text', $rateHeader->highlight_text ?? '') }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                placeholder="Word to emphasize in the title">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="space-y-1">
                        <label for="description"
                            class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Description</label>
                        <textarea id="description" name="description" rows="3"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                            placeholder="Enter a brief description...">{{ old('description', $rateHeader->description ?? '') }}</textarea>
                    </div>

                    {{-- Stats Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-gray-500 uppercase">Room Types</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-bed text-xs"></i>
                                </span>
                                <input type="number" name="room_types"
                                    value="{{ old('room_types', $rateHeader->room_types ?? 0) }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-gray-500 uppercase">% Discount</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-percent text-xs"></i>
                                </span>
                                <input type="number" name="off_season_discount"
                                    value="{{ old('off_season_discount', $rateHeader->off_season_discount ?? 0) }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-gray-500 uppercase">Service Hours</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-clock text-xs"></i>
                                </span>
                                <input type="number" name="service_hours"
                                    value="{{ old('service_hours', $rateHeader->service_hours ?? 0) }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium">
                            </div>
                        </div>
                    </div>

                    {{-- Status Toggle --}}
                    <div class="relative py-4">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-100"></div>
                        </div>
                        <div class="relative flex justify-start text-sm font-bold uppercase tracking-widest">
                            <span class="bg-white pr-4 text-primary">Visibility Settings</span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3 bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                {{ old('is_active', $rateHeader->is_active ?? 1) == 1 ? 'checked' : '' }}>
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                            </div>
                        </label>
                        <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Active Rate
                            Configuration</span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('rate-header.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all flex items-center space-x-2">
                            <span>Cancel</span>
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ isset($rateHeader) ? 'Update Rate' : 'Save Rate' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
