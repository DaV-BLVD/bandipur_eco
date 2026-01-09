@extends('admin.layouts.app')

@section('title', 'View Submission')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('contact-submissions.index') }}"
                class="text-sm text-black hover:text-primary transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Inbox</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            <div class="bg-primary px-8 py-6 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-white tracking-tight">Message from {{ $contactSubmission->name }}</h1>
                    <p class="text-indigo-100/80 text-sm mt-1">Received on
                        {{ $contactSubmission->created_at->format('F d, Y \a\t H:i') }}</p>
                </div>
                <i class="fas fa-envelope-open-text text-4xl text-white/20"></i>
            </div>

            <div class="p-8 space-y-8">
                {{-- Sender Info Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Email
                            Address</label>
                        <a href="mailto:{{ $contactSubmission->email }}"
                            class="text-primary font-bold hover:underline">{{ $contactSubmission->email }}</a>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Phone
                            Number</label>
                        <a href="tel:{{ $contactSubmission->phone }}"
                            class="text-gray-800 font-bold hover:underline">{{ $contactSubmission->phone }}</a>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Read
                            Status</label>
                        <span
                            class="text-gray-800 font-bold uppercase text-xs">{{ $contactSubmission->is_read ? 'Read' : 'Unread' }}</span>
                    </div>
                </div>

                {{-- Message Content --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Message Body</label>
                    <div
                        class="bg-white border border-gray-200 p-6 rounded-2xl text-gray-700 leading-relaxed italic shadow-inner">
                        "{{ $contactSubmission->message }}"
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                    <form action="{{ route('contact-submissions.destroy', $contactSubmission) }}" method="POST"
                        onsubmit="return confirm('Delete this message permanently?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="px-6 py-3 bg-red-50 text-red-600 rounded-xl font-bold hover:bg-red-100 transition-all text-sm">
                            <i class="fas fa-trash-alt mr-2"></i>Delete Message
                        </button>
                    </form>

                    {{-- <a href="mailto:{{ $contactSubmission->email }}"
                        class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg hover:bg-[#9a9a1e] transition-all flex items-center space-x-2 text-sm">
                        <i class="fas fa-reply"></i>
                        <span>Reply via Email</span>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
