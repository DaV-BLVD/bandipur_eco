@extends('admin.layouts.app')

@section('title', $socialLink->exists ? 'Edit Social Link' : 'Add Social Link')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('social-links.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Social Links</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas {{ $socialLink->exists ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $socialLink->exists ? 'Edit Social Link' : 'Add New Social Link' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Configure the platform name, FontAwesome icon, and profile URL for
                    the footer links.</p>
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
                    action="{{ $socialLink->exists ? route('social-links.update', $socialLink) : route('social-links.store') }}"
                    class="space-y-8">
                    @csrf
                    @if ($socialLink->exists)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Platform Name --}}
                        <div class="space-y-1">
                            <label for="name"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Platform Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $socialLink->name) }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                placeholder="e.g. Facebook">
                        </div>

                        {{-- Icon Class --}}
                        <div class="space-y-1">
                            <label for="icon"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wider">FontAwesome Icon
                                Class</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fab fa-font-awesome-flag text-xs"></i>
                                </span>
                                <input type="text" id="icon" name="icon"
                                    value="{{ old('icon', $socialLink->icon) }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                    placeholder="e.g. fab fa-facebook-f">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1 italic">Use brand classes like <span
                                    class="font-mono text-primary">fab fa-instagram</span></p>
                        </div>

                        {{-- URL --}}
                        <div class="space-y-1 md:col-span-2">
                            <label for="url"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Profile URL</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-link text-xs"></i>
                                </span>
                                <input type="text" id="url" name="url"
                                    value="{{ old('url', $socialLink->url) }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                    placeholder="https://facebook.com/your-page">
                            </div>
                        </div>
                    </div>

                    {{-- Visibility Setting --}}
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
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                {{ old('is_active', $socialLink->is_active) ? 'checked' : '' }}>
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                            </div>
                        </label>
                        <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Show in Footer</span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('social-links.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all text-sm">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2 text-sm">
                            <i class="fas fa-save"></i>
                            <span>{{ $socialLink->exists ? 'Update Link' : 'Save Link' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
