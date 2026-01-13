@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('home-images-grid.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Images Grid</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6 text-white">
                <h1 class="text-2xl font-bold tracking-tight flex items-center">
                    <i class="fas {{ $image ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $image ? 'Edit Grid Image' : 'Add New Grid Image' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Upload gallery images and define their display priority on the
                    homepage.</p>
            </div>

            <div class="p-8">
                {{-- Display Validation Errors --}}
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
                    action="{{ $image ? route('home-images-grid.update', $image->id) : route('home-images-grid.store') }}">
                    @csrf
                    @if ($image)
                        @method('PUT')
                    @endif

                    {{-- Image Upload Section --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Upload Image</label>
                        <div class="flex items-start space-x-6">
                            <div class="flex-1">
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                        <i class="fas fa-cloud-upload-alt text-xs"></i>
                                    </span>
                                    <input type="file" name="image"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-black file:text-white hover:file:bg-[#9a9a1e] cursor-pointer">
                                </div>
                                <p class="text-[10px] text-gray-400 mt-2 uppercase font-bold tracking-widest">Recommended:
                                    High resolution JPG or PNG</p>
                            </div>

                            @if ($image)
                                <div class="p-2 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                                    <p class="text-[9px] uppercase font-bold text-gray-400 mb-1 text-center">Current</p>
                                    <img src="{{ asset('storage/' . $image->image) }}"
                                        class="h-24 w-32 object-cover rounded-lg shadow-sm">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        {{-- Alt Text Field --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Alt Text
                                (SEO)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-font text-xs"></i>
                                </span>
                                <input type="text" name="alt_text" placeholder="Describe the image content..."
                                    value="{{ old('alt_text', $image->alt_text ?? '') }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium">
                            </div>
                        </div>

                        {{-- Position Field --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Display
                                Position</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-sort-numeric-down text-xs"></i>
                                </span>
                                <input type="number" name="position" placeholder="e.g. 1"
                                    value="{{ old('position', $image->position ?? '') }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium">
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('home-images-grid.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $image ? 'Update Image' : 'Save Image' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
