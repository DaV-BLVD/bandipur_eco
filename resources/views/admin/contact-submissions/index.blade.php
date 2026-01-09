@extends('admin.layouts.app')

@section('title', 'Contact Submissions')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-inbox mr-2 text-primary"></i> Contact Messages
                </h1>
                <p class="text-sm text-gray-500 mt-1">Review and manage inquiries sent by visitors through your website.</p>
            </div>

            <div class="flex items-center space-x-3">
                <span
                    class="bg-gray-100 text-gray-600 px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-widest border border-gray-200 shadow-sm">
                    Total: {{ $submissions->total() }}
                </span>
            </div>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm animate-fadeIn">
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
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Sender</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Contact Info</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-32">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($submissions as $submission)
                            <tr
                                class="hover:bg-gray-50/50 transition-colors {{ !$submission->is_read ? 'bg-primary/5' : '' }}">
                                {{-- SN --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-400">
                                    {{ ($submissions->currentPage() - 1) * $submissions->perPage() + $loop->iteration }}
                                </td>

                                {{-- Sender --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">{{ $submission->name }}</div>
                                    <div class="text-[10px] text-gray-400 font-medium uppercase tracking-tighter">
                                        {{ $submission->created_at->diffForHumans() }}
                                    </div>
                                </td>

                                {{-- Contact Info --}}
                                <td class="px-6 py-4">
                                    <div class="flex flex-col space-y-1">
                                        <span class="text-xs text-gray-600 flex items-center">
                                            <i class="far fa-envelope mr-2 text-primary/70 w-4"></i>{{ $submission->email }}
                                        </span>
                                        <span class="text-xs text-gray-600 flex items-center">
                                            <i
                                                class="fas fa-phone-alt mr-2 text-primary/70 w-4"></i>{{ $submission->phone }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Status Badge --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    @if ($submission->is_read)
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gray-100 text-gray-500 border border-gray-200 uppercase tracking-tighter">
                                            Read
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-700 border border-green-200 uppercase tracking-tighter animate-pulse">
                                            New
                                        </span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-2">
                                        {{-- View --}}
                                        <a href="{{ route('contact-submissions.show', $submission) }}"
                                            class="p-2 text-primary hover:bg-green-700 hover:text-white rounded-lg transition-all"
                                            title="View Message">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        {{-- Toggle Read Status --}}
                                        <form
                                            action="{{ $submission->is_read ? route('contact-submissions.unread', $submission) : route('contact-submissions.read', $submission) }}"
                                            method="POST" class="inline-block">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                class="p-2 {{ $submission->is_read ? 'text-gray-400' : 'text-green-600' }} hover:bg-gray-500 hover:text-white rounded-lg transition-all"
                                                title="{{ $submission->is_read ? 'Mark as Unread' : 'Mark as Read' }}">
                                                <i
                                                    class="fas {{ $submission->is_read ? 'fa-envelope-open' : 'fa-envelope' }}"></i>
                                            </button>
                                        </form>

                                        {{-- Delete --}}
                                        <form action="{{ route('contact-submissions.destroy', $submission) }}"
                                            method="POST" class="inline-block"
                                            onsubmit="return confirm('Delete this message permanently?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-400 hover:bg-red-500 hover:text-white rounded-lg transition-all"
                                                title="Delete Message">
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
                                        <i class="fas fa-stream text-5xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-500 font-medium">No contact messages found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Section --}}
            @if ($submissions->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $submissions->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
