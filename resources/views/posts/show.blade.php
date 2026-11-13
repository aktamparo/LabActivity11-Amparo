@extends('layouts.app')

@section('title', $post->title.' - Barangay Bulletin')

@section('content')
    <div class="mx-auto max-w-3xl px-6 py-10">
        <a href="{{ route('posts.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">
            &larr; Back to posts
        </a>

        <article class="mt-6 rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <div class="flex flex-wrap items-center gap-2 text-xs font-semibold uppercase tracking-wide">
                <span class="rounded-full bg-blue-100 px-3 py-1 text-blue-700">{{ $post->category }}</span>
                @if ($post->is_pinned)
                    <span class="rounded-full bg-amber-100 px-3 py-1 text-amber-700">Pinned</span>
                @endif
            </div>
            <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-900">{{ $post->title }}</h1>
            <p class="mt-3 text-sm text-slate-500">
                Published {{ $post->published_at->format('F j, Y') }} · {{ $post->views }} views
            </p>
            <a href="{{ route('authors.show', $post->author) }}" class="mt-3 inline-block text-sm font-semibold text-blue-600 hover:text-blue-700">
                {{ $post->author->name }}
            </a>
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach ($post->tags as $tag)
                    <span class="rounded-full bg-slate-100 px-2 py-1 text-xs text-slate-600">{{ $tag->name }}</span>
                @endforeach
            </div>
            <div class="mt-8 whitespace-pre-line leading-7 text-slate-700">{{ $post->body }}</div>
        </article>

        <section class="mt-8 rounded-xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-xl font-semibold text-slate-900">Comments</h2>
            @if (session('status'))
                <p class="mt-3 rounded-lg bg-green-50 p-3 text-sm text-green-700">{{ session('status') }}</p>
            @endif
            <div class="mt-6 space-y-4">
                @forelse ($post->comments as $comment)
                    <div class="border-b border-slate-100 pb-4">
                        <p class="text-sm font-semibold text-slate-800">{{ $comment->user->name }}</p>
                        <p class="mt-1 text-slate-700">{{ $comment->body }}</p>
                        <p class="mt-1 text-xs text-slate-500">{{ $comment->created_at->format('F j, Y g:i A') }}</p>
                    </div>
                @empty
                    <p class="text-slate-600">No comments yet.</p>
                @endforelse
            </div>

            @auth
                <form method="POST" action="{{ route('comments.store', $post) }}" class="mt-6 space-y-3">
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
                    <label for="body" class="block text-sm font-medium text-slate-700">Add a comment</label>
                    <textarea id="body" name="body" rows="3" required class="w-full rounded-lg border border-slate-300 p-3 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-200">{{ old('body') }}</textarea>
                    @error('body')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                        Comment
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mt-6 inline-block text-sm font-semibold text-blue-600 hover:text-blue-700">
                    Sign in to comment
                </a>
            @endauth
        </section>
    </div>
@endsection
