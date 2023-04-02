<x-app-layout title="Semua Post">
    @if ($posts->count())
    {{-- First Post --}}
    <div class="card mb-5 pb-4 text-center border-0">
        {{-- Banner --}}
        <div class="h-60 sm:h-96">
            <x-_banner :post="$posts[0]"></x-_banner>
        </div>

        <div class="card-body">
            <h3 class="card-title">
                <a href="{{ route('user_posts.show', $posts[0]) }}">{{ $posts[0]->title }}</a>
            </h3>

            <small class="mb-4 d-block">
                Ditulis oleh
                <a class="author" href="{{ route('profiles.show', $posts[0]->author) }}">{{ $posts[0]->author->name }}</a>
                di
                <a class="category" href="{{ route('user_posts.index', [ 'category' => $posts[0]->category->slug]) }}">
                    {{ $posts[0]->category->name }}
                </a>
                <small class="text-muted">{{ $posts[0]->created_at->diffForHumans() }}</small>
            </small>

            <p class="card-text text-slate-800">
                {{ $posts[0]->excerpt }}
            </p>
            <div class="d-flex justify-content-center">
                <x-_link href="{{ route('user_posts.show', $posts[0]) }}">
                    Lanjut
                    <i class="bi bi-chevron-compact-right"></i>
                </x-_link>
            </div>
        </div>
    </div>

    {{-- All Post --}}
    <x-_posts :posts="$posts->skip(1)"></x-_posts>

    <div class="d-flex justify-content-center">{{ $posts->links() }}</div>
    @else
    <div class="text-center text-lg text-slate-800 mt-10">Ups!maaf ya, sekarang masih belum ada article nih :(</div>
    @endif
</x-app-layout>