@extends('admin.layouts.app')

@section('title', ($rate->exists ? 'Edit' : 'Add') . ' Room Rate')

@section('content')
    @php $isEdit = $rate->exists; @endphp

    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb --}}
        <div class="mb-6">
            <a href="{{ route('rates-table.index') }}"
                class="text-sm text-black hover:text-[#9a9a1e] transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Rates Table</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas {{ $isEdit ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $isEdit ? 'Edit Room Rate' : 'Add New Room Rate' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Define room categories and their specific pricing structures.</p>
            </div>

            <div class="p-8">
                <form action="{{ $isEdit ? route('rates-table.update', $rate) : route('rates-table.store') }}"
                    method="POST" class="space-y-6">
                    @csrf
                    @if ($isEdit)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Room Type --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Room Type</label>
                            <input type="text" name="room_type" value="{{ old('room_type', $rate->room_type) }}"
                                placeholder="e.g. Deluxe Suite"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all"
                                required>
                        </div>

                        {{-- Currency --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Currency</label>
                            <select name="currency"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all appearance-none cursor-pointer">
                                <option value="USD" {{ old('currency', $rate->currency) == 'USD' ? 'selected' : '' }}>USD
                                    ($) - US Dollar</option>
                                <option value="NPR" {{ old('currency', $rate->currency) == 'NPR' ? 'selected' : '' }}>NPR
                                    (रु) - Nepalese Rupee</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Single --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Single
                                Price</label>
                            <input type="number" name="single_price" value="{{ old('single_price', $rate->single_price) }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                        </div>
                        {{-- Double --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Double
                                Price</label>
                            <input type="number" name="double_price" value="{{ old('double_price', $rate->double_price) }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                        </div>
                        {{-- Extra Bed --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Extra Bed</label>
                            <input type="number" name="extra_bed" value="{{ old('extra_bed', $rate->extra_bed) }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all">
                        </div>
                    </div>

                    {{-- Inclusions Section --}}
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                        <label class="block text-sm font-bold text-primary uppercase tracking-widest mb-4">Pricing
                            Inclusions</label>

                        <div id="inclusions-wrapper" class="space-y-3">
                            @php $inclusions = old('inclusions', $rate->inclusions ?? ['']); @endphp
                            @foreach ($inclusions as $index => $inc)
                                <div class="flex items-center gap-3">
                                    <div class="relative flex-1">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                            <i class="fas fa-check text-xs"></i>
                                        </span>
                                        <input type="text" name="inclusions[]" value="{{ $inc }}"
                                            class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary/20 outline-none transition-all text-sm"
                                            placeholder="e.g. Free Breakfast" required>
                                    </div>
                                    @if ($index > 0)
                                        <button type="button"
                                            class="remove-inclusion p-2.5 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <button type="button" id="add-inclusion"
                            class="mt-4 flex items-center space-x-2 text-sm font-bold text-secondary hover:text-black transition-colors uppercase tracking-tighter">
                            <i class="fas fa-plus-circle"></i>
                            <span>Add Inclusion Line</span>
                        </button>
                    </div>

                    {{-- Footer Actions --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('rates-table.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-[#9a9a1e] transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $isEdit ? 'Update Rate' : 'Save Rate' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.getElementById('inclusions-wrapper');
            const addBtn = document.getElementById('add-inclusion');

            addBtn.addEventListener('click', () => {
                const count = wrapper.children.length;
                const div = document.createElement('div');
                div.className = "flex items-center gap-3 animate-fadeIn";
                div.innerHTML = `
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-check text-xs"></i>
                    </span>
                    <input type="text" name="inclusions[]" placeholder="Inclusion ${count + 1}" 
                        class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary/20 outline-none transition-all text-sm" required>
                </div>
                <button type="button" class="remove-inclusion p-2.5 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            `;
                wrapper.appendChild(div);
            });

            wrapper.addEventListener('click', function(e) {
                const btn = e.target.closest('.remove-inclusion');
                if (btn) {
                    const inputCount = wrapper.querySelectorAll('input[name="inclusions[]"]').length;
                    if (inputCount > 1) {
                        btn.parentElement.remove();
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
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
@endsection
