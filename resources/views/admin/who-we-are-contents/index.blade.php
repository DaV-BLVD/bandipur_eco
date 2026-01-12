@extends('admin.layouts.app')
@section('title', 'Who We Are Content')
@section('content')
    <div class="p-6 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Who We Are Content</h1>
                <p class="text-sm text-gray-500 mt-1">Manage the main text and feature icons.</p>
            </div>
            {{-- <a href="{{ route('who-we-are-contents.create') }}"
                class="bg-primary text-white px-5 py-2.5 rounded-xl font-semibold shadow-lg hover:bg-[#9a9a1e] transition-all">
                + Add Content
            </a> --}}
        </div>

        <div class="overflow-hidden shadow-xl rounded-2xl border border-gray-200 bg-white">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Heading</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Features</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-32">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($contents as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gray-900">{!! $item->heading !!}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2 text-primary">
                                    <i class="{{ $item->f1_icon }}"></i>
                                    <i class="{{ $item->f2_icon }}"></i>
                                    <i class="{{ $item->f3_icon }}"></i>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="px-3 py-1 text-xs font-bold rounded-full {{ $item->status ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $item->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('who-we-are-contents.edit', $item) }}"
                                        class="p-2 text-secondary hover:bg-green-400 hover:text-white rounded-lg transition-all"><i
                                            class="fas fa-edit"></i></a>
                                    {{-- <form action="{{ route('who-we-are-contents.destroy', $item) }}" method="POST"
                                        onsubmit="return confirm('Delete?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
