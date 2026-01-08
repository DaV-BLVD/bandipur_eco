@extends('admin.layouts.app')

@section('title', 'Contact Info')

@section('content')
    <div class="p-6">
        <div class="flex justify-between mb-6">
            <h1 class="text-2xl font-bold">Contact Info Cards</h1>
            <a href="{{ route('contact-info.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                Add New
            </a>
        </div>

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Icon</th>
                    <th class="p-2 border">Title</th>
                    <th class="p-2 border">Value</th>
                    <th class="p-2 border">Active</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($infos as $info)
                    <tr>
                        <td class="p-2 border text-center">
                            <i class="fas {{ $info->icon }}"></i>
                        </td>
                        <td class="p-2 border">{{ $info->title }}</td>
                        <td class="p-2 border">{{ $info->value }}</td>
                        <td class="p-2 border">{{ $info->is_active ? 'Yes' : 'No' }}</td>
                        <td class="p-2 border flex gap-3">
                            <a href="{{ route('contact-info.edit', $info) }}" class="text-blue-600">Edit</a>

                            <form method="POST" action="{{ route('contact-info.destroy', $info) }}">
                                @csrf @method('DELETE')
                                <button class="text-red-600" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
