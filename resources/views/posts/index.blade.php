@extends('layouts.main', ["title" => "Fiblo | Blog"])

@section('content')
<h2 class="mb-4">{{ $title ?? 'Halaman Blog' }}</h2>

@if ($posts->count())
<div class="card mb-3 pb-4 text-center border-0 b-shadow">
    <img src="/images/hero.jpg" class="card-img-top w-100 hero-image">
    <div class="card-body">
        <h3 class="card-title">
            <a href="/posts/{{ $posts[0]->slug }}">{{ $posts[0]->title }}</a>
        </h3>

        <small class="mb-4 d-block">
            Wrote by
            <a class="author" href="/posts/author/{{ $posts[0]->author->username }}">{{ $posts[0]->author->name }}</a>
            in
            <a class="category" href="/posts/categories/{{ $posts[0]->category->slug }}">{{ $posts[0]->category->name }}</a>
            <small class="text-muted">{{ $posts[0]->created_at->diffForHumans() }}</small>
        </small>

        <p class="card-text">
            {{ $posts[0]->excerpt }}
        </p>
        <div class="d-flex justify-content-center">
            <a href="/posts/{{ $posts[0]->slug }}" class="btn btn-sm btn-danger font-weight-bold mt-4">Read more</a>
        </div>
    </div>
</div>
@endif

<article class="row mt-5">
    @forelse ($posts->skip(1) as $post)
    <div class="col-md-4">
        <div class="card mb-3 pb-4 border-0 b-shadow">
            <a href="/posts/categories/{{ $post->category->name }}">
                <small style="background: #11111d;" class="position-absolute px-3 py-2 text-light text-small">{{ $post->category->name }}</small>
            </a>

            <img src="/images/hero.jpg" class="card-img-top w-100 h-100">
            <div class="card-body">
                <h3 class="card-title">
                    <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
                </h3>

                <small class="mb-4 d-block">
                    Wrote by
                    <a class="author" href="/posts/author/{{ $post->author->username }}">{{ $post->author->name }}</a>
                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                </small>

                <p class="card-text">
                    {{ $post->excerpt }}
                </p>
                <a href="/posts/{{ $post->slug }}" class="btn btn-sm btn-danger font-weight-bold mt-4">Read more</a>
            </div>
        </div>
    </div>
    @empty
    <h2>Ups!maaf ya, sekarang masih belum ada article nih :(</h2>
    @endforelse
</article>

@endsection