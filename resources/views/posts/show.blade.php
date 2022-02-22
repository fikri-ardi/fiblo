@extends('layouts.main', ["title" => "Fiblo | Blog"])

@section('content')
<h2>{{ $post->title }}</h2>
<p class="mb-3">
    Wrote by <a href="/posts/author/{{ $post->author->username }}">{{ $post->author->name }}</a> in <a
        href="/categories/{{ $post->category->slug }}">{{
        $post->category->name }}</a>
</p>
{!! $post->body !!}

<br>
<a href="/posts" class="btn btn-danger btn-sm text-white mt-3">Back to posts</a>
@endsection