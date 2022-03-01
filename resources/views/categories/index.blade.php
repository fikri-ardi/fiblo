@extends('layouts.main', ["title" => "Fiblo | Blog"])

@section('content')
<h2 class="mb-5">Kategori Post</h2>

<div class="row">
    @forelse ($categories as $category)
    <div class="col-md-4">
        <div class="position-relative">
            <a href="/posts?category={{ $category->slug }}" class="stretched-link"></a>
            <div class="position-absolute text-white fs-4 text-center w-100 p-3 backdrop-blur-lg"
                style="left: 0; top: 50%; transform: translateY(-50%); background: #0d0d1699">
                {{ $category->name }}
            </div>
            <img src="/images/hero.jpg" alt="" class="hero-image w-100 h-100 overflow-hidden rounded">
        </div>
    </div>
    @empty
    <h2>Ups!, Maaf sekarang masih belum ada category nih :(</h2>
    @endforelse
</div>

@endsection