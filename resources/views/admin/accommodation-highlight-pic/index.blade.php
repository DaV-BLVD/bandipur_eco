@extends('admin.layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Accommodation Highlight Images</h1>
        <a href="{{ route('accommodation-highlight-pic.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">
            + Add Image
        </a>
    </div>

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-3">Image</th>
                <th class="p-3">Rating</th>
                <th class="p-3">Status</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pics as $pic)
                <tr class="border-t text-center">
                    <td class="p-3">
                        <img src="{{ asset('storage/' . $pic->image) }}" class="h-16 mx-auto rounded">
                    </td>
                    <td class="p-3">{{ $pic->rating_text }}</td>
                    <td class="p-3">{{ $pic->status ? 'Active' : 'Inactive' }}</td>
                    <td class="p-3 flex justify-center gap-3">
                        <a href="{{ route('accommodation-highlight-pic.edit', $pic) }}" class="text-blue-600">Edit</a>

                        <form method="POST" action="{{ route('accommodation-highlight-pic.destroy', $pic) }}">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this image?')" class="text-red-600">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
