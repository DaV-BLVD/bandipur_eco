@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-highlighter mr-2 text-primary"></i> Home Highlight Two
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage the secondary highlight section, feature items, and
                    split-gallery images.</p>
            </div>

            @if (!$content)
                <a href="{{ route('home-highlight-two.create') }}"
                    class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#9a9a1e] shadow-lg shadow-indigo-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                    <i class="fas fa-plus text-xs"></i>
                    <span>Create Content</span>
                </a>
            @endif
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm">
                <i class="fas fa-check-circle mr-2 text-green-500"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Content Overview Table --}}
        <div class="overflow-hidden shadow-xl rounded-2xl border border-gray-200 bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    {{-- Table Header --}}
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Section Details</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Feature Items</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-48">Media Preview
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @if ($content)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- Section Details --}}
                                <td class="px-6 py-4">
                                    <span
                                        class="text-[10px] font-black text-primary uppercase tracking-widest">{{ $content->label ?? 'No Label' }}</span>
                                    <div class="text-sm font-bold text-gray-900 mt-1">
                                        {{ $content->heading ?? 'No Heading' }}</div>
                                    <div class="text-xs text-gray-500 mt-1 line-clamp-1 italic max-w-xs">
                                        {{ $content->description }}
                                    </div>
                                </td>

                                {{-- Feature Items --}}
                                <td class="px-6 py-4">
                                    <div class="flex flex-col space-y-1">
                                        @foreach ($content->items as $item)
                                            <div class="flex items-center text-xs font-medium text-gray-700">
                                                <i class="fas fa-check text-[10px] text-green-500 mr-2"></i>
                                                {{ $item->title }}
                                            </div>
                                        @endforeach
                                    </div>
                                </td>

                                {{-- Media Preview --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center -space-x-4">
                                        @if ($content->image_one)
                                            <img src="{{ asset('storage/' . $content->image_one) }}"
                                                class="h-12 w-12 rounded-full border-2 border-white object-cover shadow-sm ring-1 ring-gray-100">
                                        @endif
                                        @if ($content->image_two)
                                            <img src="{{ asset('storage/' . $content->image_two) }}"
                                                class="h-12 w-12 rounded-full border-2 border-white object-cover shadow-sm ring-1 ring-gray-100">
                                        @endif
                                    </div>
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-2">
                                        <a href="{{ route('home-highlight-two.edit', $content->id) }}"
                                            class="p-2 text-secondary hover:bg-green-400 hover:text-white rounded-lg transition-all"
                                            title="Edit Content">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Optional Delete if needed --}}
                                        {{--
                                        <form method="POST"
                                            action="{{ route('home-highlight-two.destroy', $content->id) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this section content?')"
                                            class="inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @else
                            {{-- Empty State --}}
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-highlighter text-3xl text-gray-200"></i>
                                        </div>
                                        <p class="text-gray-500 font-medium">No highlight content found.</p>
                                        <a href="{{ route('home-highlight-two.create') }}"
                                            class="mt-2 text-primary hover:underline text-sm font-bold uppercase tracking-widest">
                                            + Create Now
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
