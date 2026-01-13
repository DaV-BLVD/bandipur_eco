@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-th mr-2 text-primary"></i> Home Images Grid
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage the homepage gallery, including image positions and display
                    order.</p>
            </div>

            {{-- <a href="{{ route('home-images-grid.create') }}"
                class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#9a9a1e] shadow-lg shadow-indigo-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                <i class="fas fa-plus text-xs"></i>
                <span>Add Image</span>
            </a> --}}
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm">
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
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-32">Preview</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Details</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-32">Position</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($images as $img)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- Image Preview --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="h-20 w-32 overflow-hidden rounded-lg border border-gray-200 shadow-sm bg-gray-50">
                                        <img src="{{ asset('storage/' . $img->image) }}" class="h-full w-full object-cover">
                                    </div>
                                </td>

                                {{-- Details --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900">Gallery Item #{{ $img->id }}</div>
                                    <div class="text-[10px] text-gray-400 uppercase tracking-widest mt-0.5">
                                        Uploaded: {{ $img->created_at->format('M d, Y') }}
                                    </div>
                                </td>

                                {{-- Position --}}
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 bg-indigo-50 text-primary text-xs font-mono font-bold rounded-md border border-indigo-100">
                                        Pos: {{ $img->position }}
                                    </span>
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-2">
                                        <a href="{{ route('home-images-grid.edit', $img->id) }}"
                                            class="p-2 text-secondary hover:bg-green-400 hover:text-white rounded-lg transition-all"
                                            title="Edit Image">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- <form method="POST" action="{{ route('home-images-grid.destroy', $img->id) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this image?')"
                                            class="inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all"
                                                title="Delete Image">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-images text-3xl text-gray-200"></i>
                                        </div>
                                        <p class="text-gray-500 font-medium">No images found in the grid.</p>
                                        <a href="{{ route('home-images-grid.create') }}"
                                            class="mt-2 text-primary hover:underline text-sm font-bold uppercase tracking-widest">
                                            + Add First Image
                                        </a>
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
