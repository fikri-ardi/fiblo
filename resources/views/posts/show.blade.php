@extends('layouts.main', ["title" => "Fiblo | Blog"])

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-7">
            <img src="/images/hero.jpg" class="card-img-top w-100 h-100 hero-image position-relative img-fluid" style="left: 0; max-height: 400px">
            <h2>{{ $post->title }}</h2>
            <p class="mb-3">
                Wrote by
                <a class="author" href="/posts/author/{{ $post->author->username }}">{{ $post->author->name }}</a> in
                <a class="category" href="/posts/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
            </p>
            <article class="fs-5">{!! $post->body !!}</article>

            <a href="/posts" class="btn btn-danger btn-sm text-white mt-3 d-inline-block">Back to posts</a>
        </div>
    </div>
</div>

@endsection