<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private const PER_PAGE = 6;

    public function index(Request $request): View
    {
        $posts = Post::query()
            ->with(['author', 'tags'])
            ->withCount('comments')
            ->where('is_published', true)
            ->when($request->filled('q'), function (Builder $query) use ($request): void {
                $query->where('title', 'like', '%'.$request->input('q').'%');
            })
            ->when($request->filled('category'), function (Builder $query) use ($request): void {
                $query->where('category', $request->input('category'));
            })
            ->when($request->filled('tag'), function (Builder $query) use ($request): void {
                $query->whereHas('tags', function (Builder $tagQuery) use ($request): void {
                    $tagQuery->where('name', $request->input('tag'));
                });
            })
            ->orderByDesc('is_pinned')
            ->latest('published_at')
            ->paginate(self::PER_PAGE)
            ->withQueryString();

        $categories = Post::query()
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $tags = Tag::query()->orderBy('name')->get();

        return view('posts.index', compact('posts', 'categories', 'tags'));
    }

    public function create(): View
    {
        $tags = Tag::query()->orderBy('name')->get();

        return view('posts.create', compact('tags'));
    }

    public function store(StorePostRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $tagIds = $validated['tags'];
        $postData = $request->safe()->except(['tags']);
        $postData['is_published'] = $request->boolean('is_published');
        $postData['is_pinned'] = $request->boolean('is_pinned');
        $postData['published_at'] = $postData['is_published'] ? now() : null;

        $post = $request->user()->author()->firstOrFail()->posts()->create($postData);
        $post->tags()->sync($tagIds);

        return $post->is_published
            ? redirect()->route('posts.show', $post)
            : redirect()->route('posts.index');
    }

    public function show(Post $post): View
    {
        abort_unless($post->is_published, 404);

        $post->views++;
        $post->save();
        $post->load([
            'author',
            'tags',
            'comments' => fn ($query) => $query->with('user')->latest(),
        ]);

        return view('posts.show', compact('post'));
    }
}
