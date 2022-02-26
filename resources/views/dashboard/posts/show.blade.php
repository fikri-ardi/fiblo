@extends('dashboard.layouts.main', ['title'=>'Fiblo | Dashboard'])

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <div class="col-md-7 col-lg-8">
            <img src="/images/hero.jpg" class="card-img-top w-100 h-100 hero-image position-relative img-fluid"
                style="left: 0; max-height: 400px; object-fit: cover">
            <h2>{{ $post->title }}</h2>
            <article class="fs-5">{!! $post->body !!}</article>

        </div>
        <p class="mx-4">
            <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit-3"></span> Ubah</a>
            <a href="/dashboard/posts" class="btn btn-danger"><span data-feather="x-circle"></span> Hapus</a>
        </p>
    </div>
</main>
@endsection