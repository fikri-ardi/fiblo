<x-app-layout title="Semua Post">
    <div class="row justify-content-between">
        <div class="col-md-5">
            <h2 class="mb-4">{{ $pageTitle }}</h2>
        </div>

        {{-- Search Bar --}}
        <div class="col-md-7 col-sm-10" style="max-width: 400px">
            <form action="/posts" class="mb-3">
                <div class="input-group">
                    @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                    @endif
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Kamu lagi cari apa?"
                        class="form-control border-0 shadow-lg">
                    <button type="submit" class="btn text-white shadow-md" style="background: rgb(14, 14, 24)">
                        <i class="bi bi-send"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if ($posts->count())
    <div class="card mb-5 pb-4 text-center border-0 shadow-xl">
        <x-_banner :post="$posts[0]"></x-_banner>

        <div class="card-body">
            <h3 class="card-title">
                <a href="{{ route('posts.single', $posts[0]) }}">{{ $posts[0]->title }}</a>
            </h3>

            <small class="mb-4 d-block">
                Ditulis oleh
                <a class="author" href="{{ route('profiles.show', $posts[0]->author) }}">{{ $posts[0]->author->name }}</a>
                di
                <a class="category" href="{{ route('posts', [ 'category' => $posts[0]->category->name]) }}">{{ $posts[0]->category->name }}</a>
                <small class="text-muted">{{ $posts[0]->created_at->diffForHumans() }}</small>
            </small>

            <p class="card-text">
                {{ $posts[0]->excerpt }}
            </p>
            <div class="d-flex justify-content-center">
                <x-_link href="{{ route('posts.single', $posts[0]) }}">
                    Lanjut
                    <i class="bi bi-chevron-compact-right"></i>
                </x-_link>
            </div>
        </div>
    </div>

    <x-_posts :posts="$posts->skip(1)"></x-_posts>

    <div class="d-flex justify-content-center">{{ $posts->links() }}</div>
    @else
    <div class="text-center text-lg text-slate-800 mt-10">Ups!maaf ya, sekarang masih belum ada article nih :(</div>
    @endif
</x-app-layout>