@extends('layouts.main', ["title" => "Fiblo | Blog"])

@section('content')
<div class="row justify-content-between">
    <div class="col-md-5">
        <h2 class="mb-4">{{ $pageTitle }}</h2>
    </div>
    <div class="col-md-7 col-sm-10" style="max-width: 400px">
        <form action="/posts">
            <div class="input-group">
                @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Kamu lagi cari apa?"
                    class="form-control border-0 shadow-lg">
                <button type="submit" class="btn text-white shadow-lg" style="background: rgb(14, 14, 24)">
                    <i class="bi bi-send"></i>
                </button>
            </div>
        </form>
    </div>
</div>

@if ($posts->count())
<div class="card mb-3 pb-4 text-center border-0 b-shadow">
    @if ($posts[0]->image)
    <img src="/storage/{{ $posts[0]->image }}" class="card-img-top w-100 h-100 hero-image position-relative img-fluid"
        style="left: 0; max-height: 420px; object-fit: cover">
    @else
    <img src="/images/hero.jpg" class="card-img-top w-100 h-100 hero-image position-relative img-fluid"
        style="left: 0; max-height: 420px; object-fit: cover">
    @endif

    <div class="card-body">
        <h3 class="card-title">
            <a href="/posts/{{ $posts[0]->slug }}">{{ $posts[0]->title }}</a>
        </h3>

        <small class="mb-4 d-block">
            Ditulis oleh
            <a class="author" href="/posts?author={{ $posts[0]->author->username }}">{{ $posts[0]->author->name }}</a>
            di
            <a class="category" href="/posts?category={{ $posts[0]->category->slug }}">{{ $posts[0]->category->name }}</a>
            <small class="text-muted">{{ $posts[0]->created_at->diffForHumans() }}</small>
        </small>

        <p class="card-text">
            {{ $posts[0]->excerpt }}
        </p>
        <div class="d-flex justify-content-center">
            <a href="/posts/{{ $posts[0]->slug }}" class="btn btn-sm btn-danger font-weight-bold mt-4">
                Lanjut <i class="bi bi-chevron-compact-right"></i>
            </a>
        </div>
    </div>
</div>

<article class="row mt-5">
    @foreach ($posts->skip(1) as $post)
    <div class="col-md-4">
        <div class="card mb-3 pb-4 border-0 b-shadow">
            <a href="/posts?category={{ $post->category->slug }}">
                <small style="background: #11111d80;" class="position-absolute px-3 py-2 text-light text-small blur rounded-2">{{
                    $post->category->name
                    }}</small>
            </a>

            @if ($post->image)
            <img src="/storage/{{ $post->image }}" class="card-img-top w-100 h-100 hero-image position-relative img-fluid"
                style="left: 0; max-height: 250px; object-fit: cover">
            @else
            <img src="/images/hero.jpg" class="card-img-top w-100 h-100 hero-image position-relative img-fluid"
                style="left: 0; max-height: 250px; object-fit: cover">
            @endif
            <div class="card-body">
                <h3 class="card-title">
                    <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
                </h3>

                <small class="mb-4 d-block">
                    Ditulis oleh
                    <a class="author" href="/posts?author={{ $post->author->username }}">{{ $post->author->name }}</a>
                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                </small>

                <p class="card-text">
                    {{ $post->excerpt }}
                </p>
                <a href="/posts/{{ $post->slug }}" class="btn btn-sm btn-danger font-weight-bold mt-4">
                    Lanjut <i class="bi bi-chevron-compact-right"></i>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</article>

<div class="d-flex justify-content-center">{{ $posts->links() }}</div>
@else
<h2>Ups!maaf ya, sekarang masih belum ada article nih :(</h2>
@endif
@endsection