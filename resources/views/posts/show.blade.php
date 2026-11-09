{{-- Use the shared layout --}}
@extends('layouts.app')

{{-- Browser tab title includes the post title --}}
@section('title', $post->title . ' – Barangay Bulletin – Purok Perez')

@section('content')
    {{-- Link back to the list --}}
    <a href="{{ route('posts.index') }}" class="text-sm text-emerald-600 hover:underline">&larr; Back to posts</a>

    {{-- $post comes from PostController@show (findOrFail, so drafts and missing IDs never get here) --}}
    <article class="mt-4 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex flex-wrap items-center gap-2 mb-2">
            {{-- "Pinned" badge only for pinned posts --}}
            @if ($post->is_pinned)
                <span class="text-xs font-semibold bg-amber-100 text-amber-800 px-2 py-0.5 rounded">Pinned</span>
            @endif
            {{-- Category badge --}}
            <span class="text-xs bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded">{{ $post->category }}</span>
        </div>
        <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
        {{-- Date, view count (already incremented and saved by the controller) and author ID --}}
        <p class="text-sm text-gray-500 mt-1">
            {{ $post->published_at?->format('F d, Y') }} · {{ $post->views }} views · Author #{{ $post->author_id }}
        </p>
        {{-- {{ }} escapes the body so HTML in it can't run; whitespace-pre-line keeps line breaks --}}
        <div class="mt-4 whitespace-pre-line">{{ $post->body }}</div>
    </article>
@endsection
