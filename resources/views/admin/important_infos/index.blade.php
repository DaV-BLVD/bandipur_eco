{{-- resources/views/admin/important_infos/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Important Information')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">
        
        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-info-circle mr-2 text-primary"></i> Important Information
                </h1>
                <h2 class="text-sm text-gray-500 mt-1">Manage policies, payment details, and general hotel rules.</h2>
            </div>

            <a href="{{ route('important-infos.create') }}"
                class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#9a9a1e] shadow-lg shadow-indigo-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                <i class="fas fa-plus text-xs"></i>
                <span>Add New Info</span>
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm">
                <i class="fas fa-check-circle mr-2 text-green-500"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Table Section (Card Layout) --}}
        <div class="overflow-hidden shadow-xl rounded-2xl border border-gray-200 bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    {{-- Table Header --}}
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-16">SN</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Category Detail</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Policy Items</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-32">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100">
                        @forelse($infos as $info)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- SN --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-400">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- Title & Icon --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0 flex items-center justify-center rounded-lg bg-gray-100 text-primary border border-gray-200">
                                            <i class="{{ $info->icon ?: 'fas fa-list' }}"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $info->title }}</div>
                                            <div class="text-xs text-gray-400 font-mono">{{ $info->icon }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Items List --}}
                                <td class="px-6 py-4">
                                    <ul class="space-y-1">
                                        @foreach (array_slice($info->items, 0, 3) as $item)
                                            <li class="text-sm text-gray-600 flex items-center">
                                                <i class="fas fa-check text-[10px] mr-2 text-green-500"></i>
                                                {{ Str::limit($item, 50) }}
                                            </li>
                                        @endforeach
                                        @if(count($info->items) > 3)
                                            <li class="text-xs text-gray-400 italic pl-5">+ {{ count($info->items) - 3 }} more items...</li>
                                        @endif
                                    </ul>
                                </td>

                                {{-- Status Badge --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    @if($info->status)
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-700 border border-green-200 uppercase tracking-tighter">
                                            Active
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gray-100 text-gray-500 border border-gray-200 uppercase tracking-tighter">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-2">
                                        {{-- Edit --}}
                                        <a href="{{ route('important-infos.edit', $info) }}"
                                            class="p-2 text-secondary hover:bg-green-400 hover:text-white rounded-lg transition-all"
                                            title="Edit Information">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('important-infos.destroy', $info) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this info category?');"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all"
                                                title="Delete Information">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-info-circle text-5xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-500 font-medium">No important info categories found.</p>
                                        <a href="{{ route('important-infos.create') }}"
                                            class="mt-2 text-primary hover:underline text-sm font-semibold">Add your first policy info</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection