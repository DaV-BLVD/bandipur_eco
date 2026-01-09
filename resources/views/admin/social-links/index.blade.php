@extends('admin.layouts.app')

@section('title', 'Social Links')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-share-alt mr-2 text-primary"></i> Social Links
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage the social media icons and profile links displayed in the
                    website footer.</p>
            </div>

            <a href="{{ route('social-links.create') }}"
                class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#9a9a1e] shadow-lg shadow-indigo-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                <i class="fas fa-plus text-xs"></i>
                <span>Add Social Link</span>
            </a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm">
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
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-20">Icon</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Platform Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">URL</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-32">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100">
                        @forelse($socialLinks as $link)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- SN --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-400">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- Icon Preview --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center text-primary border border-gray-200 shadow-sm">
                                        <i class="fab {{ $link->icon }} text-lg"></i>
                                    </div>
                                </td>

                                {{-- Name --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $link->name }}</div>
                                </td>

                                {{-- URL --}}
                                <td class="px-6 py-4">
                                    <a href="{{ $link->url }}" target="_blank"
                                        class="text-sm text-blue-500 hover:text-blue-700 hover:underline flex items-center">
                                        <span class="truncate max-w-xs">{{ $link->url }}</span>
                                        <i class="fas fa-external-link-alt ml-1 text-[10px]"></i>
                                    </a>
                                </td>

                                {{-- Status Badge --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    @if ($link->is_active)
                                        <span
                                            class="px-3 py-1 inline-flex text-[10px] leading-5 font-black rounded-full bg-green-100 text-green-700 border border-green-200 uppercase tracking-widest">
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 inline-flex text-[10px] leading-5 font-black rounded-full bg-gray-100 text-gray-500 border border-gray-200 uppercase tracking-widest">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-2">
                                        <a href="{{ route('social-links.edit', $link) }}"
                                            class="p-2 text-secondary hover:bg-green-400 hover:text-white rounded-lg transition-all"
                                            title="Edit Link">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form method="POST" action="{{ route('social-links.destroy', $link) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this social link?');"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all"
                                                title="Delete Link">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-share-nodes text-5xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-500 font-medium">No social links configured yet.</p>
                                        <a href="{{ route('social-links.create') }}"
                                            class="mt-2 text-primary hover:underline text-sm font-semibold">Add your first
                                            profile</a>
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
