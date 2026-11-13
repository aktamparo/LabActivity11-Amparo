<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Contracts\View\View;

class AuthorController extends Controller
{
    public function show(Author $author): View
    {
        $author->load([
            'posts' => fn ($query) => $query
                ->where('is_published', true)
                ->with(['tags', 'author'])
                ->withCount('comments')
                ->orderByDesc('is_pinned')
                ->latest('published_at'),
        ])->loadCount('comments');

        return view('authors.show', compact('author'));
    }
}
