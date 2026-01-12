@extends('admin.layouts.app')

@section('title', 'About Two Sections')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-layer-group mr-2 text-primary"></i> About Two Content
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage secondary about sections, including taglines, detailed
                    descriptions, and media.</p>
            </div>

            {{-- <a href="{{ route('about-two.create') }}"
                class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#9a9a1e] shadow-lg shadow-indigo-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                <i class="fas fa-plus text-xs"></i>
                <span>Add About Section</span>
            </a> --}}
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm animate-fadeIn">
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
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-16">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-24">Image</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Section Details</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Tagline</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($abouts as $about)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- ID --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-400">
                                    #{{ $about->id }}
                                </td>

                                {{-- Image Preview --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($about->image)
                                        <img src="{{ asset('storage/' . $about->image) }}"
                                            class="w-14 h-10 object-cover rounded-lg shadow-sm border border-gray-100">
                                    @else
                                        <div class="w-14 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-image text-gray-300 text-xs"></i>
                                        </div>
                                    @endif
                                </td>

                                {{-- Title --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $about->title }}</div>
                                    @if ($about->description)
                                        <div class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">
                                            {{ Str::limit($about->description, 45) }}
                                        </div>
                                    @endif
                                </td>

                                {{-- Tagline --}}
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 bg-gray-100 text-gray-600 text-[11px] font-bold rounded-full border border-gray-200">
                                        {{ $about->tagline ?? 'No Tagline' }}
                                    </span>
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-2">
                                        {{-- Edit --}}
                                        <a href="{{ route('about-two.edit', $about->id) }}"
                                            class="p-2 text-secondary hover:bg-green-400 hover:text-white rounded-lg transition-all"
                                            title="Edit Section">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Delete --}}
                                        {{-- <form action="{{ route('about-two.destroy', $about->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this section?');"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all"
                                                title="Delete Section">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-layer-group text-3xl text-gray-200"></i>
                                        </div>
                                        <p class="text-gray-500 font-medium">No Content found for About Two.</p>
                                        <p class="text-gray-400 text-xs mt-1">Start by creating your first extended about
                                            block.</p>
                                        <a href="{{ route('about-two.create') }}"
                                            class="mt-4 text-primary hover:underline text-sm font-bold uppercase tracking-widest">
                                            + Add Entry
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if (method_exists($abouts, 'links'))
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    {{ $abouts->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
