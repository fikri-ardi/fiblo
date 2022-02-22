@extends('layouts.main', ["title" => "Fiblo | Blog"])

@section('content')
<h2>Post Categories</h2>

@forelse ($categories as $category)
<ul>
    <li>
        <h5><a href="/categories/{{ $category->slug }}">{{ $category->name }}</a></h5>
    </li>
</ul>
@empty
<h2>Ups!, Maaf sekarang masih belum ada category nih :(</h2>
@endforelse
@endsection