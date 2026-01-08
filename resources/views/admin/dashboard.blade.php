@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-full mx-auto space-y-8">

        {{-- 1. Dashboard Header --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight flex items-center">
                    <i class="fas fa-th-large mr-3 text-secondary"></i>
                    Dashboard Overview
                </h1>
                <p class="text-gray-500 mt-1">
                    Welcome back, <span class="font-semibold text-gray-700">{{ auth()->user()->name }}</span>! Here is what's
                    happening today.
                </p>
            </div>

            <div class="flex items-center space-x-3">
                <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border font-medium">
                    <i class="fa-regular fa-calendar-check mr-2 text-secondary"></i>
                    {{ now()->format('D, M d, Y') }}
                </div>
            </div>
        </div>
    </div>
@endsection