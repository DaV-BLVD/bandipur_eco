@extends('admin.layouts.app')

@section('title', 'Contact Info Form')

@section('content')
    <div class="p-6 max-w-xl">
        <form method="POST"
            action="{{ $info->exists ? route('contact-info.update', $info) : route('contact-info.store') }}">

            @csrf
            @if ($info->exists)
                @method('PUT')
            @endif

            <div class="mb-4">
                <label>FontAwesome Icon (class)</label>
                <input type="text" name="icon" value="{{ old('icon', $info->icon) }}" class="w-full border p-2"
                    placeholder="fa-phone-alt">
            </div>

            <div class="mb-4">
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title', $info->title) }}" class="w-full border p-2">
            </div>

            <div class="mb-4">
                <label>Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $info->subtitle) }}"
                    class="w-full border p-2">
            </div>

            <div class="mb-4">
                <label>Value</label>
                <input type="text" name="value" value="{{ old('value', $info->value) }}" class="w-full border p-2">
            </div>

            <div class="mb-4">
                <label>Link (tel:, mailto:, map url)</label>
                <input type="text" name="link" value="{{ old('link', $info->link) }}" class="w-full border p-2">
            </div>

            <div class="mb-4">
                <label>Theme Color</label>
                <input type="color" name="theme_color" value="{{ old('theme_color', $info->theme_color ?? '#0a7c15') }}"
                    class="w-20 h-10 border">
            </div>

            <div class="mb-4">
                <label>
                    <input type="checkbox" name="is_active" {{ old('is_active', $info->is_active) ? 'checked' : '' }}>
                    Active
                </label>
            </div>

            <button class="bg-blue-600 text-white px-6 py-2 rounded">
                Save
            </button>
        </form>
    </div>
@endsection
