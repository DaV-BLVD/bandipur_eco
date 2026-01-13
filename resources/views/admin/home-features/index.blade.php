@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">
        
        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-star mr-2 text-primary"></i> Home Features
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage the time-based feature highlights displayed on the homepage.</p>
            </div>

            <a href="{{ route('home-features.create') }}"
                class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#9a9a1e] shadow-lg shadow-indigo-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                <i class="fas fa-plus text-xs"></i>
                <span>Add New Feature</span>
            </a>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm">
                <i class="fas fa-check-circle mr-2 text-green-500"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Table Section --}}
        <div class="overflow-hidden shadow-xl rounded-2xl border border-gray-200 bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    {{-- Table Header --}}
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-24">Order</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-32">Time</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Feature Title</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($features as $feature)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- Order --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-400">
                                    #{{ $feature->order }}
                                </td>

                                {{-- Time --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 bg-indigo-50 text-primary text-xs font-bold rounded-lg border border-indigo-100">
                                        <i class="far fa-clock mr-1"></i> {{ $feature->time }}
                                    </span>
                                </td>

                                {{-- Title --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $feature->title }}</div>
                                    @if($feature->description)
                                        <div class="text-xs text-gray-400 font-medium truncate max-w-md">{{ $feature->description }}</div>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-2">
                                        <a href="{{ route('home-features.edit', $feature->id) }}"
                                            class="p-2 text-secondary hover:bg-green-400 hover:text-white rounded-lg transition-all"
                                            title="Edit Feature">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('home-features.destroy', $feature->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this feature?');"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all"
                                                title="Delete Feature">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center text-gray-400">
                                        <i class="fas fa-folder-open text-5xl mb-4 opacity-20"></i>
                                        <p class="font-medium">No features added yet.</p>
                                        <a href="{{ route('home-features.create') }}" class="text-primary text-sm font-bold hover:underline mt-2">Add your first feature</a>
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