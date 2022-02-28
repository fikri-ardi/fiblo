@extends('layouts.main', ["title" => "Fiblo | Blog"])

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-7">
            @if ($post->image)
            <img src="/storage/{{ $post->image }}" class="card-img-top w-100 h-100 hero-image position-relative img-fluid"
                style="left: 0; max-height: 400px; object-fit: cover">
            @else
            <img src="/images/hero.jpg" class="card-img-top w-100 h-100 hero-image position-relative img-fluid" style="left: 0; max-height: 400px">
            @endif
            <h2 class="my-3">{{ $post->title }}</h2>
            <p class="mb-3">
                Ditulis oleh
                <a class="author" href="/posts/author/{{ $post->author->username }}">{{ $post->author->name }}</a>
                di
                <a class="category" href="/posts?category={{ $post->category->slug }}">{{ $post->category->name }}</a>
            </p>
            <article class="fs-5">{!! $post->body !!}</article>

            <div class="d-flex align-items-center my-16">
                <div class="bi bi-person text-4xl p-5 mr-8 border-2 rounded-full"></div>
                <div>
                    <div class="text-3xl font-bold">{{ $post->author->name }}</div>
                    <p class="lh-base text-lg">Seorang IT antusias yang hoby main futsal, badminton, gambar, ngelukis. Beberapa mengikuti kompetisi di
                        dunia
                        IT
                        dan pernah
                        menjadi terbaik 1 Nasional </p>
                    <div class="text-lg">
                        <span class="bi bi-instagram mr-2 col-primary"></span>
                        <span class="bi bi-facebook mr-2 col-primary"></span>
                        <span class="bi bi-twitter mr-2 col-primary"></span>
                    </div>
                </div>
            </div>

            <a href="/posts" class="btn btn-danger btn-sm text-white mt-3 d-inline-block">
                <span class="bi bi-chevron-compact-left"></span> Kembali
            </a>
        </div>
    </div>
</div>

@endsection