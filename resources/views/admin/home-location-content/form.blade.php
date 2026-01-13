@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('home-location-content.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Location Overview</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6 text-white">
                <h1 class="text-2xl font-bold tracking-tight flex items-center">
                    <i class="fas {{ $content ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $content ? 'Edit Location Content' : 'Create Location Content' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Configure the heading, description, and transportation details for
                    the homepage map section.</p>
            </div>

            <div class="p-8">
                <form method="POST"
                    action="{{ $content ? route('home-location-content.update', $content->id) : route('home-location-content.store') }}"
                    class="space-y-6">
                    @csrf
                    @if ($content)
                        @method('PUT')
                    @endif

                    {{-- Main Content Section --}}
                    <div class="space-y-6">
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Heading</label>
                            <input type="text" name="heading" value="{{ old('heading', $content->heading ?? '') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                placeholder="Enter main heading...">
                        </div>

                        <div class="space-y-1">
                            <label
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Description</label>
                            <textarea name="description" rows="3"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                placeholder="Enter section description...">{{ old('description', $content->description ?? '') }}</textarea>
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    {{-- Transportation Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Car Section --}}
                        <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100 space-y-4">
                            <div class="flex items-center space-x-2 text-primary">
                                <i class="fas fa-car"></i>
                                <span class="text-xs font-black uppercase tracking-widest">Car Transport</span>
                            </div>

                            <div class="space-y-1">
                                <label class="block text-xs font-bold text-gray-500 uppercase">Label</label>
                                <input type="text" name="car_label"
                                    value="{{ old('car_label', $content->car_label ?? 'BY CAR') }}"
                                    class="w-full p-2.5 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/10 outline-none">
                            </div>

                            <div class="space-y-1">
                                <label class="block text-xs font-bold text-gray-500 uppercase">Details</label>
                                <textarea name="car_text" rows="2"
                                    class="w-full p-2.5 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/10 outline-none"
                                    placeholder="Driving directions...">{{ old('car_text', $content->car_text ?? '') }}</textarea>
                            </div>
                        </div>

                        {{-- Pickup Section --}}
                        <div class="p-5 bg-gray-50 rounded-2xl border border-gray-100 space-y-4">
                            <div class="flex items-center space-x-2 text-primary">
                                <i class="fas fa-shuttle-van"></i>
                                <span class="text-xs font-black uppercase tracking-widest">Pickup Service</span>
                            </div>

                            <div class="space-y-1">
                                <label class="block text-xs font-bold text-gray-500 uppercase">Label</label>
                                <input type="text" name="pickup_label"
                                    value="{{ old('pickup_label', $content->pickup_label ?? 'PICKUP') }}"
                                    class="w-full p-2.5 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/10 outline-none">
                            </div>

                            <div class="space-y-1">
                                <label class="block text-xs font-bold text-gray-500 uppercase">Details</label>
                                <textarea name="pickup_text" rows="2"
                                    class="w-full p-2.5 border border-gray-200 rounded-lg focus:border-primary focus:ring-2 focus:ring-primary/10 outline-none"
                                    placeholder="Pickup instructions...">{{ old('pickup_text', $content->pickup_text ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('home-location-content.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $content ? 'Update Content' : 'Save Content' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
