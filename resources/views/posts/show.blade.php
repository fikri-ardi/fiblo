<x-layouts.main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                @if ($post->image)
                <img src="/storage/{{ $post->image }}" class="card-img-top w-100 h-100 hero-image position-relative img-fluid"
                    style="left: 0; max-height: 400px; object-fit: cover">
                @else
                <img src="/images/hero.jpg" class="card-img-top w-100 h-100 hero-image position-relative img-fluid"
                    style="left: 0; max-height: 400px">
                @endif
                <h2 class="my-3">{{ $post->title }}</h2>
                <p class="mb-3">
                    Ditulis oleh
                    <a class="author" href="/posts?author={{ $post->author->username }}">{{ $post->author->name }}</a>
                    di
                    <a class="category" href="/posts?category={{ $post->category->slug }}">{{ $post->category->name }}</a>
                </p>
                <article class="fs-5">{!! $post->body !!}</article>

                {{-- author's bio --}}
                <div class="d-flex align-items-center my-16">
                    <div class="w-52 mr-4 sm:w-40 sm:mr-8">
                        @if ($post->author->photo)
                        <img src="/storage/{{ $post->author->photo }}" class="rounded-circle w-full object-cover border-5 border-slate-200"
                            alt="{{ $post->author->name }}">
                        @else
                        <div class="bi bi-person text-4xl w-full p-5 border-2 rounded-full"></div>
                        @endif
                    </div>
                    <div class="w-full">
                        <div class="text-3xl font-bold">{{ $post->author->name }}</div>
                        <p class="lh-base text-lg my-2">{{ $post->author->bio }}</p>
                        <div class="text-lg">
                            <span class="bi bi-instagram mr-2 col-primary"></span>
                            <span class="bi bi-facebook mr-2 col-primary"></span>
                            <span class="bi bi-twitter mr-2 col-primary"></span>
                        </div>
                    </div>
                </div>

                <a href="/posts" class="btn btn-danger btn-sm text-white mt-3 mb-5 d-inline-block">
                    <span class="bi bi-chevron-compact-left"></span> Kembali
                </a>
            </div>
        </div>
    </div>
</x-layouts.main>