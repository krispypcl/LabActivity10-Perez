<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->where('is_published', true)
            ->when($request->filled('q'), fn ($query) => $query->where('title', 'like', '%'.$request->q.'%'))
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->category))
            ->orderByDesc('is_pinned')
            ->latest('published_at')
            ->paginate(6) // "Perez" has 5 letters, so the minimum of 6 applies
            ->withQueryString(); // keeps ?q= and ?category= on page links

        $categories = Post::query()->where('is_published', true)->distinct()->orderBy('category')->pluck('category');

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show($id)
    {
        $post = Post::where('is_published', true)->findOrFail($id);

        $post->views += 1;
        $post->save();

        return view('posts.show', compact('post'));
    }
}
