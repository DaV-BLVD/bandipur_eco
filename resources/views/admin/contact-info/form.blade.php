@extends('admin.layouts.app')

@section('title', 'Contact Info Form')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('contact-info.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Contact Info Cards</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas {{ $info->exists ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $info->exists ? 'Edit Contact Card' : 'Add New Contact Card' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Configure the icon, title, and multiple contact values (Phone,
                    Email, etc.) for this card.</p>
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
                    action="{{ $info->exists ? route('contact-info.update', $info) : route('contact-info.store') }}"
                    class="space-y-8">
                    @csrf
                    @if ($info->exists)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Icon Class --}}
                        <div class="space-y-1 col-span-1">
                            <label for="icon"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wider">FontAwesome
                                Icon</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-icons text-xs"></i>
                                </span>
                                <input type="text" id="icon" name="icon" value="{{ old('icon', $info->icon) }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                    placeholder="e.g. fas fa-phone-alt">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1">Example: <span class="font-mono text-primary">fas
                                    fa-envelope</span></p>
                        </div>

                        {{-- Theme Color --}}
                        <div class="space-y-1">
                            <label for="theme_color"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Accent Color</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-palette text-xs"></i>
                                </span>
                                <select name="theme_color"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium">
                                    <option value="#0a7c15"
                                        {{ old('theme_color', $info->theme_color) == '#0a7c15' ? 'selected' : '' }}>Green
                                        Accent</option>
                                    <option value="#6d6d18"
                                        {{ old('theme_color', $info->theme_color) == '#6d6d18' ? 'selected' : '' }}>Yellow
                                        Accent</option>
                                </select>
                            </div>
                        </div>

                        {{-- Title --}}
                        <div class="space-y-1">
                            <label for="title"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Title</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $info->title) }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                placeholder="e.g. Phone Number">
                        </div>

                        {{-- Subtitle --}}
                        <div class="space-y-1">
                            <label for="subtitle"
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Subtitle</label>
                            <input type="text" id="subtitle" name="subtitle"
                                value="{{ old('subtitle', $info->subtitle) }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                placeholder="e.g. Call us anytime">
                        </div>
                    </div>

                    {{-- Multi-Value Section --}}
                    <div class="space-y-4">
                        <div class="flex items-center justify-between border-b border-gray-100 pb-2">
                            <label class="text-sm font-bold text-gray-700 uppercase tracking-wider">Values & Link
                                Types</label>
                            <button type="button" id="add-row"
                                class="text-xs bg-gray-800 hover:bg-black text-white px-3 py-1.5 rounded-lg transition-all flex items-center gap-1 shadow-md">
                                <i class="fas fa-plus"></i> Add Line
                            </button>
                        </div>

                        <div id="value-wrapper" class="space-y-3">
                            @php
                                $oldValues = old('values');
                                if ($oldValues) {
                                    $formattedValues = $oldValues;
                                } elseif ($info->exists) {
                                    $dbValues = is_array($info->value)
                                        ? $info->value
                                        : json_decode($info->value ?? '[]', true);
                                    $dbLinks = is_array($info->link)
                                        ? $info->link
                                        : json_decode($info->link ?? '[]', true);
                                    $formattedValues = [];
                                    foreach ($dbValues as $i => $v) {
                                        $formattedValues[] = ['value' => $v, 'link' => $dbLinks[$i] ?? ''];
                                    }
                                } else {
                                    $formattedValues = [['value' => '', 'link' => '']];
                                }
                            @endphp

                            @foreach ($formattedValues as $index => $item)
                                <div class="flex gap-2 items-center value-row animate-fadeIn">
                                    <input type="text" name="values[{{ $index }}][value]"
                                        value="{{ $item['value'] ?? '' }}" placeholder="Display Text (e.g. +977...)"
                                        class="flex-1 px-4 py-2 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm">

                                    <select name="values[{{ $index }}][link]"
                                        class="w-48 px-4 py-2 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm">
                                        <option value="tel:"
                                            {{ str_starts_with($item['link'] ?? '', 'tel:') ? 'selected' : '' }}>Telephone
                                        </option>
                                        <option value="mailto:"
                                            {{ str_starts_with($item['link'] ?? '', 'mailto:') ? 'selected' : '' }}>Email
                                        </option>
                                        <option value="" {{ empty($item['link']) ? 'selected' : '' }}>No Link
                                        </option>
                                    </select>

                                    <button type="button"
                                        class="remove-row p-2 text-red-400 hover:text-red-600 transition-colors">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            @endforeach
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
                                {{ old('is_active', $info->is_active) ? 'checked' : '' }}>
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                            </div>
                        </label>
                        <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Set as Active Card</span>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('contact-info.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $info->exists ? 'Update Card' : 'Save Card' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let index = document.querySelectorAll('.value-row').length;

            const wrapper = document.getElementById('value-wrapper');
            const addButton = document.getElementById('add-row');

            if (addButton) {
                addButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    const row = document.createElement('div');
                    row.className = 'flex gap-2 items-center value-row animate-fadeIn';
                    row.innerHTML = `
                <input type="text" name="values[${index}][value]"
                       placeholder="Display Text (e.g. +977...)"
                       class="flex-1 px-4 py-2 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm">
                <select name="values[${index}][link]"
                        class="w-48 px-4 py-2 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary outline-none transition-all text-sm">
                    <option value="tel:">Telephone</option>
                    <option value="mailto:">Email</option>
                    <option value="">No Link</option>
                </select>
                <button type="button" class="remove-row p-2 text-red-400 hover:text-red-600 transition-colors">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;
                    wrapper.appendChild(row);
                    index++;
                });
            }

            document.addEventListener('click', function(e) {
                if (e.target.closest('.remove-row')) {
                    const rows = document.querySelectorAll('.value-row');
                    if (rows.length > 1) {
                        e.target.closest('.value-row').remove();
                    } else {
                        alert('At least one row is required.');
                    }
                }
            });
        });
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
@endpush
