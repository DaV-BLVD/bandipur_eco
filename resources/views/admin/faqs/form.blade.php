@extends('admin.layouts.app')

@section('title', $faq->exists ? 'Edit FAQ' : 'Add FAQ')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">
        {{-- Breadcrumb --}}
        <div class="mb-6">
            <a href="{{ route('faqs.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to FAQs</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas {{ $faq->exists ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $faq->exists ? 'Edit FAQ' : 'Add New FAQ' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Manage frequently asked questions and their display icons.</p>
            </div>

            <div class="p-8">
                <form action="{{ $faq->exists ? route('faqs.update', $faq) : route('faqs.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @if ($faq->exists)
                        @method('PUT')
                    @endif

                    {{-- Question --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Question</label>
                        <input type="text" name="question" value="{{ old('question', $faq->question) }}" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                            required placeholder="e.g. What is your return policy?">
                    </div>

                    {{-- Answer --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Answer</label>
                        <textarea name="answer" rows="5" 
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                            required placeholder="Provide a detailed answer...">{{ old('answer', $faq->answer) }}</textarea>
                    </div>

                    {{-- Icon --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">FontAwesome Icon</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="{{ $faq->icon ?? 'fas fa-icons' }} text-xs"></i>
                            </span>
                            <input type="text" name="icon" value="{{ old('icon', $faq->icon) }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                placeholder="fas fa-car">
                        </div>
                    </div>

                    {{-- Visibility Setting --}}
                    <div class="relative py-4">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-100"></div>
                        </div>
                        <div class="relative flex justify-start text-sm font-bold uppercase tracking-widest">
                            <span class="bg-white pr-4 text-primary">Status</span>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3 bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                        <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Show on Website</span>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('faqs.index') }}" class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit" class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $faq->exists ? 'Update FAQ' : 'Save FAQ' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection