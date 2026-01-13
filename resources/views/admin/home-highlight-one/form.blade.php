@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('home-highlight-one.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Highlights</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas {{ $content ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $content ? 'Edit Highlight One' : 'Create New Highlight' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Configure the main feature image, percentage statistic, and
                    display text for the home section.</p>
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
                    action="{{ $content ? route('home-highlight-one.update', $content->id) : route('home-highlight-one.store') }}">
                    @csrf
                    @if ($content)
                        @method('PUT')
                    @endif

                    {{-- Image Upload Section --}}
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Highlight
                            Image</label>

                        <div class="flex items-center justify-center w-full">
                            <label
                                class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-200 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-3"></i>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-bold">Click to upload</span> or
                                        drag and drop</p>
                                    <p class="text-xs text-gray-400">Recommended: High Resolution (Max: 2MB)</p>
                                </div>
                                <input type="file" name="image" class="hidden" />
                            </label>
                        </div>

                        @if ($content && $content->image)
                            <div class="mt-4">
                                <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Current
                                    Image</label>
                                <div class="relative inline-block">
                                    <img src="{{ asset('storage/' . $content->image) }}"
                                        class="h-32 w-48 object-cover rounded-xl border border-gray-200 shadow-sm">
                                    <div
                                        class="absolute top-2 right-2 bg-primary text-white text-[10px] px-2 py-1 rounded-md font-bold shadow-sm">
                                        LIVE
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- Percentage Input --}}
                        <div class="space-y-1 col-span-1">
                            <label for="percentage"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Stat %</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-percent text-xs"></i>
                                </span>
                                <input type="text" id="percentage" name="percentage"
                                    value="{{ old('percentage', $content->percentage ?? '') }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                    placeholder="85%">
                            </div>
                        </div>

                        {{-- Text Input --}}
                        <div class="space-y-1 col-span-1 md:col-span-3">
                            <label for="text"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Highlight
                                Text</label>
                            <input type="text" id="text" name="text"
                                value="{{ old('text', $content->text ?? '') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                placeholder="Enter short description text...">
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('home-highlight-one.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $content ? 'Update Highlight' : 'Save Highlight' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
