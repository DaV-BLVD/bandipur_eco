@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-highlighter mr-2 text-primary"></i> Home Highlight One
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage the primary call-to-action highlight and percentage stat on the
                    homepage.</p>
            </div>

            @if (!$content)
                <a href="{{ route('home-highlight-one.create') }}"
                    class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#9a9a1e] shadow-lg shadow-indigo-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                    <i class="fas fa-plus text-xs"></i>
                    <span>Create Highlight</span>
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

        @if ($content)
            {{-- Content Display Card --}}
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden max-w-2xl">
                <div class="relative group">
                    <img src="{{ asset('storage/' . $content->image) }}"
                        class="h-64 w-full object-cover transition-transform duration-500 group-hover:scale-105"
                        alt="Highlight Image">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6">
                        <span
                            class="bg-primary text-white px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-widest">
                            Preview Image
                        </span>
                    </div>
                </div>

                <div class="p-8">
                    <div class="flex items-start justify-between">
                        <div class="space-y-4">
                            <div>
                                <label
                                    class="text-[10px] font-bold text-primary uppercase tracking-[0.2em] block mb-1">Percentage
                                    Stat</label>
                                <p class="text-4xl font-black text-gray-900 leading-none">{{ $content->percentage }}</p>
                            </div>

                            <div>
                                <label
                                    class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] block mb-1">Highlight
                                    Text</label>
                                <p class="text-gray-600 font-medium leading-relaxed">{{ $content->text }}</p>
                            </div>
                        </div>

                        <div class="flex flex-col space-y-2">
                            <a href="{{ route('home-highlight-one.edit', $content->id) }}"
                                class="flex items-center justify-center space-x-2 bg-gray-900 text-white px-6 py-3 rounded-xl font-bold hover:bg-black transition-all shadow-lg shadow-gray-200">
                                <i class="fas fa-edit text-sm"></i>
                                <span>Edit Content</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Card Footer --}}
                <div
                    class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center text-gray-400 text-xs font-medium">
                    <i class="fas fa-info-circle mr-2"></i>
                    This highlight is currently visible on the live website.
                </div>
            </div>
        @else
            {{-- Empty State --}}
            <div class="bg-white rounded-2xl border-2 border-dashed border-gray-200 p-12 text-center">
                <div class="flex flex-col items-center">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-highlighter text-3xl text-gray-300"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">No Highlight Found</h3>
                    <p class="text-gray-500 max-w-xs mx-auto mt-2">You haven't created the home highlight section yet. Start
                        by creating one now.</p>
                    <a href="{{ route('home-highlight-one.create') }}"
                        class="mt-6 text-primary font-bold hover:underline flex items-center">
                        Create Highlight Section <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
