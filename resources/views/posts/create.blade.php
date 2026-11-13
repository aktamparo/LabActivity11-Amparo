@extends('layouts.app')

@section('title', 'Create Post – Barangay Bulletin')

@section('content')
    <div class="mx-auto max-w-3xl px-6 py-10">
        <h1 class="text-3xl font-bold text-slate-900">Create post</h1>

        <form method="POST" action="{{ route('posts.store') }}" class="mt-6 space-y-5 rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
            @csrf
            @if ($errors->any())
                <div class="rounded-lg bg-red-50 p-4 text-sm text-red-700">
                    <p class="font-semibold">Please fix the following errors:</p>
                    <ul class="mt-2 list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <label for="title" class="block text-sm font-medium text-slate-700">Title</label>
                <input id="title" name="title" value="{{ old('title') }}" required class="mt-1 w-full rounded-lg border border-slate-300 p-2">
                @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="category" class="block text-sm font-medium text-slate-700">Category</label>
                <select id="category" name="category" required class="mt-1 w-full rounded-lg border border-slate-300 p-2">
                    @foreach (['Announcement', 'Health', 'Peace & Order', 'Ayuda', 'Education'] as $category)
                        <option value="{{ $category }}" @selected(old('category') === $category)>{{ $category }}</option>
                    @endforeach
                </select>
                @error('category') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="body" class="block text-sm font-medium text-slate-700">Body</label>
                <textarea id="body" name="body" rows="6" required class="mt-1 w-full rounded-lg border border-slate-300 p-2">{{ old('body') }}</textarea>
                @error('body') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <p class="text-sm font-medium text-slate-700">Tags</p>
                <div class="mt-2 grid gap-2 sm:grid-cols-2">
                    @foreach ($tags as $tag)
                        <label class="flex items-center gap-2 text-sm text-slate-700">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" @checked(in_array($tag->id, old('tags', [])))>
                            {{ $tag->name }}
                        </label>
                    @endforeach
                </div>
                @error('tags') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                @error('tags.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div class="flex gap-4">
                <label class="flex items-center gap-2 text-sm text-slate-700">
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published'))>
                    Published
                </label>
                <label class="flex items-center gap-2 text-sm text-slate-700">
                    <input type="checkbox" name="is_pinned" value="1" @checked(old('is_pinned'))>
                    Pinned
                </label>
            </div>
            <button type="submit" class="rounded-lg bg-blue-600 px-5 py-2 font-semibold text-white hover:bg-blue-700">Save post</button>
        </form>
    </div>
@endsection
