{{-- resources/views/admin/important_infos/form.blade.php --}}
@extends('admin.layouts.app')

@section('title', $info->exists ? 'Edit Information' : 'Add Information')

@section('content')
@php $isEdit = $info->exists; @endphp

<div class="p-6 max-w-4xl mx-auto">
    {{-- Breadcrumb/Back Link --}}
    <div class="mb-6">
        <a href="{{ route('important-infos.index') }}" class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
            <i class="fas fa-arrow-left text-xs"></i>
            <span>Back to Important Information</span>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
        {{-- Form Header --}}
        <div class="bg-primary px-8 py-6">
            <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                <i class="fas {{ $isEdit ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i> 
                {{ $isEdit ? 'Edit Information Category' : 'Add New Policy Category' }}
            </h1>
            <p class="text-indigo-100/80 text-sm mt-1">Configure policy titles, icons, and specific bullet point details.</p>
        </div>

        <div class="p-8">
            {{-- Display Errors --}}
            @if($errors->any())
                <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-lg shadow-sm">
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span class="font-bold">Please correct the following:</span>
                    </div>
                    <ul class="list-disc pl-5 text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ $isEdit ? route('important-infos.update', $info) : route('important-infos.store') }}" method="POST" class="space-y-6">
                @csrf
                @if ($isEdit) @method('PUT') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Title --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Title</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-heading text-xs"></i>
                            </span>
                            <input type="text" name="title" value="{{ old('title', $info->title) }}" 
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-medium"
                                placeholder="e.g., Check-in & Check-out" required>
                        </div>
                    </div>

                    {{-- Icon --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">FontAwesome Icon Class</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i class="fas fa-icons text-xs"></i>
                            </span>
                            <input type="text" name="icon" value="{{ old('icon', $info->icon) }}" 
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-800 font-mono text-sm"
                                placeholder="e.g., fas fa-clock">
                        </div>
                    </div>
                </div>

                {{-- Dynamic Items Section --}}
                <div class="space-y-3">
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Policy Items / Bullet Points</label>
                    <div id="items-wrapper" class="space-y-3">
                        @php $items = old('items', $info->items ?? ['']); @endphp
                        @foreach ($items as $index => $item)
                            <div class="flex items-center gap-2 group">
                                <div class="flex-grow relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-primary/50">
                                        <i class="fas fa-check-circle text-xs"></i>
                                    </span>
                                    <input type="text" name="items[]" value="{{ $item }}" 
                                        class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-700 shadow-sm"
                                        placeholder="Enter policy detail..." required>
                                </div>
                                @if ($index > 0)
                                    <button type="button" class="remove-item p-3 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition-all border border-red-100">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-item" class="flex items-center space-x-2 text-sm font-bold text-primary hover:text-[#9a9a1e] transition-colors pt-2">
                        <i class="fas fa-plus-circle"></i>
                        <span>Add Another Item</span>
                    </button>
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
                        <input type="checkbox" name="status" value="1" class="sr-only peer" {{ old('status', $info->status ?? true) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                    <span class="text-sm font-bold text-gray-700 uppercase tracking-wide">Publish Information</span>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                    <a href="{{ route('important-infos.index') }}"
                        class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all flex items-center space-x-2">
                        <span>Cancel</span>
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                        <i class="fas fa-save text-sm"></i>
                        <span>{{ $isEdit ? 'Update Policy' : 'Save Policy' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const wrapper = document.getElementById('items-wrapper');
        const addBtn = document.getElementById('add-item');

        addBtn.addEventListener('click', () => {
            const div = document.createElement('div');
            div.classList.add('flex', 'items-center', 'gap-2', 'group', 'animate-fadeIn');
            div.innerHTML = `
                <div class="flex-grow relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-primary/50">
                        <i class="fas fa-check-circle text-xs"></i>
                    </span>
                    <input type="text" name="items[]" class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all text-gray-700 shadow-sm" placeholder="Enter policy detail..." required>
                </div>
                <button type="button" class="remove-item p-3 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition-all border border-red-100">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;
            wrapper.appendChild(div);
        });

        wrapper.addEventListener('click', function(e) {
            const btn = e.target.closest('.remove-item');
            if (btn) {
                const inputCount = wrapper.querySelectorAll('input[name="items[]"]').length;
                if (inputCount > 1) {
                    btn.parentElement.remove();
                } else {
                    alert('At least one item is required.');
                }
            }
        });
    });
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn { animation: fadeIn 0.3s ease-out forwards; }
</style>
@endsection