{{-- resources/views/admin/rates_table/form.blade.php --}}
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

                <form action="{{ $isEdit ? route('rates-table.update', $rate) : route('rates-table.store') }}"
                    method="POST" class="space-y-6">
                    @csrf
                    @if ($isEdit) @method('PUT') @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Room Type --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Room Type</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-bed text-xs"></i>
                                </span>
                                <input type="text" name="room_type" value="{{ old('room_type', $rate->room_type) }}"
                                    placeholder="e.g. Deluxe Suite"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all font-medium"
                                    required>
                            </div>
                        </div>

                        {{-- Currency --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Currency</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-money-bill-wave text-xs"></i>
                                </span>
                                <select name="currency" id="currency-select"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all appearance-none cursor-pointer font-medium">
                                    <option value="USD" {{ old('currency', $rate->currency) == 'USD' ? 'selected' : '' }}>USD ($) - US Dollar</option>
                                    <option value="NPR" {{ old('currency', $rate->currency) == 'NPR' ? 'selected' : '' }}>NPR (रु) - Nepalese Rupee</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Single Price --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Single Price</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 font-bold currency-symbol">
                                    {{ old('currency', $rate->currency) == 'NPR' ? 'रु' : '$' }}
                                </span>
                                <input type="number" step="0.01" name="single_price" value="{{ old('single_price', $rate->single_price) }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all font-mono"
                                    placeholder="0.00">
                            </div>
                        </div>

                        {{-- Double Price --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Double Price</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 font-bold currency-symbol">
                                    {{ old('currency', $rate->currency) == 'NPR' ? 'रु' : '$' }}
                                </span>
                                <input type="number" step="0.01" name="double_price" value="{{ old('double_price', $rate->double_price) }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all font-mono"
                                    placeholder="0.00">
                            </div>
                        </div>

                        {{-- Extra Bed --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Extra Bed</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 font-bold currency-symbol">
                                    {{ old('currency', $rate->currency) == 'NPR' ? 'रु' : '$' }}
                                </span>
                                <input type="number" step="0.01" name="extra_bed" value="{{ old('extra_bed', $rate->extra_bed) }}"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 outline-none transition-all font-mono"
                                    placeholder="0.00">
                            </div>
                        </div>
                    </div>

                    {{-- Inclusions Section --}}
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                        <label class="block text-sm font-bold text-primary uppercase tracking-widest mb-4">Pricing Inclusions</label>

                        <div id="inclusions-wrapper" class="space-y-3">
    @php 
        // 1. Check for validation errors (old)
        // 2. Check for existing model data ($rate->inclusions)
        // 3. Fallback to an empty array with one empty string if it's a new record
        $currentInclusions = old('inclusions', $rate->inclusions);
        
        if (is_null($currentInclusions) || (is_array($currentInclusions) && count($currentInclusions) === 0)) {
            $currentInclusions = ['']; 
        }
    @endphp
    
    @foreach ($currentInclusions as $index => $inc)
        <div class="flex items-center gap-3 group">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-primary/50">
                    <i class="fas fa-check-circle text-xs"></i>
                </span>
                <input type="text" name="inclusions[]" value="{{ $inc }}"
                    class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-primary/10 outline-none transition-all text-sm shadow-sm"
                    placeholder="e.g. Complimentary WiFi" required>
            </div>
            @if ($index > 0)
                <button type="button" class="remove-inclusion p-3 text-red-500 hover:bg-red-500 hover:text-white bg-white border border-red-100 rounded-xl transition-all">
                    <i class="fas fa-trash-alt text-sm"></i>
                </button>
            @endif
        </div>
    @endforeach
</div>

                        <button type="button" id="add-inclusion"
                            class="mt-4 flex items-center space-x-2 text-sm font-bold text-primary hover:text-[#9a9a1e] transition-colors pt-2 uppercase tracking-tighter">
                            <i class="fas fa-plus-circle"></i>
                            <span>Add Inclusion Line</span>
                        </button>
                    </div>

                    {{-- Footer Actions --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('rates-table.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all flex items-center space-x-2">
                            <span>Cancel</span>
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
            const currencySelect = document.getElementById('currency-select');
            const symbols = document.querySelectorAll('.currency-symbol');

            // Update currency symbols dynamically
            currencySelect.addEventListener('change', function() {
                const symbol = this.value === 'NPR' ? 'रु' : '$';
                symbols.forEach(el => el.textContent = symbol);
            });

            // Add dynamic inclusion
            addBtn.addEventListener('click', () => {
                const div = document.createElement('div');
                div.className = "flex items-center gap-3 animate-fadeIn group";
                div.innerHTML = `
                    <div class="relative flex-1">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-primary/50">
                            <i class="fas fa-check-circle text-xs"></i>
                        </span>
                        <input type="text" name="inclusions[]" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-4 focus:ring-primary/10 outline-none transition-all text-sm shadow-sm" 
                            placeholder="Enter inclusion detail..." required>
                    </div>
                    <button type="button" class="remove-inclusion p-3 text-red-500 hover:bg-red-500 hover:text-white bg-white border border-red-100 rounded-xl transition-all">
                        <i class="fas fa-trash-alt text-sm"></i>
                    </button>
                `;
                wrapper.appendChild(div);
            });

            // Remove inclusion
            wrapper.addEventListener('click', function(e) {
                const btn = e.target.closest('.remove-inclusion');
                if (btn) {
                    const inputCount = wrapper.querySelectorAll('input[name="inclusions[]"]').length;
                    if (inputCount > 1) {
                        btn.parentElement.remove();
                    } else {
                        alert('At least one inclusion is required.');
                    }
                }
            });
        });
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.3s ease-out forwards; }
    </style>
@endsection