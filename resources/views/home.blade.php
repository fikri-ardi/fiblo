<x-app-layout title="Beranda">
    <div class="blur-3xl bg-red-500 w-52 h-52 rounded-full absolute top-44 -z-10 left-10 opacity-30"></div>
    <div class="blur-3xl bg-red-500 w-32 h-32 rounded-full absolute top-52 -z-10 -left-32 opacity-30 translate-x-32 translate-y-52"></div>
    <div class="blur-3xl bg-red-500 w-52 h-52 rounded-full absolute top-0 -z-10 -left-32 opacity-30"></div>

    <div class="col-sm-10 text-center font-bold text-5xl my-14 mx-auto sm:text-7xl sm:my-44 ">
        <p>It's Always Seem Impossible</p>
        <p class="text-red-500">Until It's Done</p>
        <p class="text-base lh-base text-gray-500 font-normal max-w-xl mx-auto mt-10 sm:text-lg">
            Hai! Salam kenal, saya Fikri, seseorang yang ngakunya programmer, hoby main gitar, nyanyi, futsal, suka baca buku, bikin eksperimen,
            ngoding dan juga suka sama kamu <span class="bi bi-emoji-smile-upside-down"></span>
        </p>
        <a href="#tulisan"
            class="bi bi-arrow-down text-3xl mx-auto text-red-500 mt-10 animate-bounce shadow-lg bg-white border-1 h-12 w-12 rounded-full d-flex justify-center align-items-center cursor-pointer relative z-10">
        </a>
    </div>

    <div class="opacity-30 blur-3xl bg-blue-900 w-44 h-44 rounded-full absolute bottom-0 right-0 -translate-x-20 -translate-y-28"></div>
    <div class="opacity-30 blur-3xl bg-blue-900 w-32 h-32 rounded-full absolute bottom-0 right-0 -translate-x-10 -translate-y-52"></div>
    <div class="opacity-30 blur-3xl bg-blue-900 w-44 h-44 rounded-full absolute bottom-0 right-0 "></div>

    @if ($posts->count())
    <div class="text-center text-5xl mb-2 pt-32" id="tulisan">
        Tulisan Terbaru
    </div>

    <article class="row mt-5">
        @foreach ($posts as $post)
        <div class="col-md-4">
            <div class="card mb-3 pb-4 border-0 shadow-md relative">
                <a href="{{ route('posts', ['category' => $post->category->slug]) }}">
                    <small class="absolute top-0 z-10 left-0 px-3 py-2 text-white bg-slate-900 text-base rounded-2  bg-opacity-40 backdrop-blur-lg">{{
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
                        <a href="{{ route('posts.single', $post) }}">{{ $post->title }}</a>
                    </h3>

                    <small class="mb-4 d-block">
                        Ditulis oleh
                        <a class="author" href="{{ route('posts', ['author' => $post->author->username]) }}">{{ $post->author->name }}</a>
                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                    </small>

                    <p class="card-text">
                        {{ $post->excerpt }}
                    </p>
                    <a href="{{ route('posts.single', $post) }}" class="btn btn-sm btn-danger font-weight-bold mt-4">
                        Lanjut <i class="bi bi-chevron-compact-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </article>

    @else
    <h2>Ups!maaf ya, sekarang masih belum ada article nih :(</h2>
    @endif
</x-app-layout>