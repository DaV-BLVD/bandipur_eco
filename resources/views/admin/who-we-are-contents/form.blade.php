@extends('admin.layouts.app')

@section('title', $content->exists ? 'Edit Who We Are' : 'Add Who We Are')

@section('content')
    <div class="p-6 max-w-5xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('who-we-are-contents.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Content List</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6 text-white">
                <h1 class="text-2xl font-bold tracking-tight flex items-center">
                    <i class="fas {{ $content->exists ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $content->exists ? 'Edit Who We Are Content' : 'Add Who We Are Content' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Manage the storytelling text and the three feature cards for the Bandipur section.</p>
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

                <form method="POST"
                    action="{{ $content->exists ? route('who-we-are-contents.update', $content) : route('who-we-are-contents.store') }}"
                    class="space-y-6">
                    @csrf 
                    @if ($content->exists)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Badge Text --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Badge Text</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-tag text-xs"></i>
                                </span>
                                <input type="text" name="badge_text" value="{{ old('badge_text', $content->badge_text) }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                    placeholder="e.g. Who We Are">
                            </div>
                        </div>

                        {{-- Heading --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Heading (HTML Allowed)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-heading text-xs"></i>
                                </span>
                                <input type="text" name="heading" value="{{ old('heading', $content->heading) }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                    placeholder="The Soul of Bandipur...">
                            </div>
                        </div>
                    </div>

                    {{-- Main Description --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Main Description</label>
                        <textarea name="description" rows="5"
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                            placeholder="Enter the section paragraph...">{{ old('description', $content->description) }}</textarea>
                    </div>

                    {{-- Separator --}}
                    <div class="relative py-4">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-100"></div>
                        </div>
                        <div class="relative flex justify-start text-sm font-bold uppercase tracking-widest">
                            <span class="bg-white pr-4 text-primary">Feature Highlights</span>
                        </div>
                    </div>

                    {{-- Feature Cards Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach (['f1' => 'First', 'f2' => 'Second', 'f3' => 'Third'] as $prefix => $label)
                            <div class="p-5 bg-gray-50 rounded-2xl border border-gray-200 space-y-3 transition-all hover:bg-white hover:shadow-md">
                                <h3 class="font-bold text-primary border-b border-gray-200 pb-2 mb-2 flex items-center">
                                    <span class="w-2 h-2 bg-primary rounded-full mr-2"></span>
                                    {{ $label }} Feature
                                </h3>
                                
                                <div class="space-y-1">
                                    <input type="text" name="{{ $prefix }}_icon"
                                        value="{{ old($prefix . '_icon', $content->{$prefix . '_icon'}) }}" placeholder="Icon Class (e.g. fas fa-leaf)"
                                        class="w-full p-2.5 border border-gray-200 rounded-lg text-xs bg-white focus:border-primary focus:ring-2 focus:ring-primary/10 outline-none">
                                </div>

                                <div class="space-y-1">
                                    <input type="text" name="{{ $prefix }}_title"
                                        value="{{ old($prefix . '_title', $content->{$prefix . '_title'}) }}" placeholder="Title"
                                        class="w-full p-2.5 border border-gray-200 rounded-lg text-sm font-bold bg-white focus:border-primary focus:ring-2 focus:ring-primary/10 outline-none">
                                </div>

                                <div class="space-y-1">
                                    <textarea name="{{ $prefix }}_desc" placeholder="Brief description" 
                                        class="w-full p-2.5 border border-gray-200 rounded-lg text-xs bg-white focus:border-primary focus:ring-2 focus:ring-primary/10 outline-none h-24">{{ old($prefix . '_desc', $content->{$prefix . '_desc'}) }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Status Toggle Section --}}
                    <div class="flex items-center space-x-3 bg-gray-50 p-4 rounded-xl border border-gray-100 mt-8">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="status" value="1" class="sr-only peer"
                                {{ old('status', $content->status) ? 'checked' : '' }}>
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                            </div>
                        </label>
                        <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Set as Active</span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('who-we-are-contents.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all flex items-center space-x-2">
                            <span>Cancel</span>
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $content->exists ? 'Update Content' : 'Save Content' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection