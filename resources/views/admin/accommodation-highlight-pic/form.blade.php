@extends('admin.layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">
        {{ $pic->exists ? 'Edit Image' : 'Add Image' }}
    </h1>

    <form method="POST" enctype="multipart/form-data"
        action="{{ $pic->exists
            ? route('accommodation-highlight-pic.update', $pic)
            : route('accommodation-highlight-pic.store') }}">

        @csrf
        @if ($pic->exists)
            @method('PUT')
        @endif

        <div class="mb-4">
            <label class="block mb-1">Image</label>
            <input type="file" name="image" class="w-full border p-2 rounded">

            @if ($pic->image)
                <img src="{{ asset('storage/' . $pic->image) }}" class="h-24 mt-3 rounded">
            @endif
        </div>

        <div class="mb-4">
            <label class="block mb-1">Rating Text</label>
            <input type="text" name="rating_text" value="{{ old('rating_text', $pic->rating_text) }}" placeholder="4.9/5"
                class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $pic->sort_order) }}"
                class="w-full border p-2 rounded">
        </div>

        <div class="mb-6">
            <label>
                <input type="checkbox" name="status" value="1" {{ old('status', $pic->status) ? 'checked' : '' }}>
                Active
            </label>
        </div>

        <button class="bg-green-600 text-white px-6 py-2 rounded">
            Save
        </button>
    </form>
@endsection
