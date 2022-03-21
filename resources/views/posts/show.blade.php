<x-app-layout :title="$post->title">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">

                <x-_banner :post="$post"></x-_banner>

                <h2 class="my-3">{{ $post->title }}</h2>
                <p class="mb-3">
                    Ditulis oleh
                    <a class="author" href="{{ route('profiles.show', $post->author) }}">{{ $post->author->name }}</a>
                    di
                    <a class="category" href="{{ route('posts', ['category' => $post->category->slug]) }}">{{ $post->category->name }}</a>
                </p>
                <article class="fs-5 mb-5 text-justify">{!! $post->body !!}</article>

                {{-- author's bio --}}
                <div class="flex items-center flex-col mb-5 sm:flex-row">
                    <a href="{{ route('profiles.show', $post->author) }}">
                        <div class="w-28 h-28 mb-3 sm:w-32 sm:h-32 sm:mr-8">
                            <x-_photo :user="$post->author" class="text-5xl"></x-_photo>
                        </div>
                    </a>
                    <div class="flex items-center flex-col sm:items-start">
                        <div class="text-3xl font-bold">{{ $post->author->name }}</div>
                        <p class="lh-base text-lg my-2 text-justify">{{ $post->author->bio }}</p>
                        <div class="text-xl flex justify-center items-center space-x-4 sm:justify-start mt-2">
                            <span class="bi bi-instagram mr-2 col-primary"></span>
                            <span class="bi bi-facebook mr-2 col-primary"></span>
                            <span class="bi bi-twitter mr-2 col-primary"></span>
                        </div>
                    </div>
                </div>

                <div class="flex mb-44">
                    <x-_link href="{{ route('posts') }}">
                        <span class="bi bi-chevron-compact-left"></span> Kembali
                    </x-_link>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>