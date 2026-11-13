@extends('layouts.app')

@section('title', $author->name.' – Barangay Bulletin')

@section('content')
    <div class="mx-auto max-w-5xl px-6 py-10">
        <a href="{{ route('posts.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">&larr; Back to posts</a>
        <header class="mt-6 rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <p class="text-sm font-semibold uppercase tracking-wide text-blue-600">{{ $author->position }}</p>
            <h1 class="mt-2 text-3xl font-bold text-slate-900">{{ $author->name }}</h1>
            <p class="mt-3 text-slate-600">{{ $author->comments_count }} comments received</p>
        </header>

        <section class="mt-8">
            <h2 class="text-2xl font-bold text-slate-900">Published posts</h2>
            <div class="mt-4 space-y-4">
                @forelse ($author->posts as $post)
                    <article class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                        <a href="{{ route('posts.show', $post) }}" class="text-xl font-semibold text-slate-900 hover:text-blue-700">{{ $post->title }}</a>
                        <p class="mt-2 text-sm text-slate-500">{{ $post->comments_count }} comments · {{ $post->published_at->format('F j, Y') }}</p>
                    </article>
                @empty
                    <p class="rounded-xl bg-white p-6 text-slate-600 ring-1 ring-slate-200">No published posts.</p>
                @endforelse
            </div>
        </section>
    </div>
@endsection
