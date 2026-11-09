{{-- Use the shared layout (header, footer, Tailwind) --}}
@extends('layouts.app')

{{-- Fills the layout's @yield('title') --}}
@section('title', 'Posts – Barangay Bulletin – Purok Perez')

{{-- Everything below goes into the layout's @yield('content') --}}
@section('content')
    {{-- Filter form: GET request so ?q= and ?category= appear in the URL.
         Stacked on mobile (flex-col), side by side from sm: upward. --}}
    <form method="GET" action="{{ route('posts.index') }}"
          class="flex flex-col sm:flex-row gap-2 mb-6 bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        {{-- Title search; value keeps the typed text after submitting --}}
        <input name="q" value="{{ request('q') }}" placeholder="Search title"
               class="flex-1 rounded border border-gray-300 px-3 py-2">
        {{-- Category dropdown built from $categories (passed by the controller) --}}
        <select name="category" class="rounded border border-gray-300 px-3 py-2">
            <option value="">All categories</option>
            @foreach ($categories as $c)
                {{-- @selected marks the option that matches the current filter --}}
                <option value="{{ $c }}" @selected(request('category') === $c)>{{ $c }}</option>
            @endforeach
        </select>
        <button class="rounded bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2">Filter</button>
    </form>

    {{-- Card grid: 1 column on phones, 2 columns from md: upward --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- @forelse loops over the current page of posts; @empty runs when there are none --}}
        @forelse ($posts as $post)
            <article class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    {{-- "Pinned" badge only for pinned posts --}}
                    @if ($post->is_pinned)
                        <span class="text-xs font-semibold bg-amber-100 text-amber-800 px-2 py-0.5 rounded">Pinned</span>
                    @endif
                    {{-- Category badge --}}
                    <span class="text-xs bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded">{{ $post->category }}</span>
                </div>
                {{-- Title links to the show page (/posts/{id}) --}}
                <h2 class="text-lg font-semibold">
                    <a href="{{ route('posts.show', $post->id) }}" class="hover:text-emerald-600">{{ $post->title }}</a>
                </h2>
                {{-- Published date (published_at is cast to a date), view count, and author ID
                     (author name needs a relationship, which is Week 11) --}}
                <p class="text-sm text-gray-500 mt-1">
                    {{ $post->published_at?->format('M d, Y') }} · {{ $post->views }} views · Author #{{ $post->author_id }}
                </p>
            </article>
        @empty
            {{-- Shown when the search/filter matches nothing; spans both columns --}}
            <p class="md:col-span-2 text-gray-600">No posts match your search.</p>
        @endforelse
    </div>

    {{-- Pagination links (Tailwind-styled by default); withQueryString() in the controller keeps the filters --}}
    <div class="mt-6">{{ $posts->links() }}</div>

    {{-- "Showing x–y of z posts" summary from the paginator --}}
    <p class="mt-2 text-sm text-gray-500">
        Showing {{ $posts->firstItem() }}–{{ $posts->lastItem() }} of {{ $posts->total() }} posts
    </p>
@endsection
