<x-app-layout :title="$post->title">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">

                <div class="max-h-96 overflow-hidden">
                    <x-_banner :post="$post"></x-_banner>
                </div>

                <h2 class="my-3">{{ $post->title }}</h2>
                <p class="mb-3">
                    Ditulis oleh
                    <a class="author" href="{{ route('profiles.show', $post->author) }}">{{ $post->author->name }}</a>
                    di
                    <a class="category" href="{{ route('user_posts.index', ['category' => $post->category->slug]) }}">{{ $post->category->name }}</a>
                </p>
                <article class="fs-5 mb-5 text-slate-800">{!! $post->body !!}</article>

                {{-- author's bio --}}
                <div class="flex items-center flex-col mb-5 sm:flex-row">
                    <a href="{{ route('profiles.show', $post->author) }}">
                        <div class="w-28 h-28 mb-3 sm:w-32 sm:h-32 sm:mr-8">
                            <x-_photo :user="$post->author" class="text-5xl"></x-_photo>
                        </div>
                    </a>
                    <div class="flex items-center flex-col sm:items-start">
                        <div class="text-3xl font-bold">{{ $post->author->name }}</div>
                        <p class="lh-base text-lg my-2 text-justify text-slate-800">{{ $post->author->bio }}</p>
                        <x-_social-media :user="$post->author" />
                    </div>
                </div>

                <div class="flex mb-44">
                    <x-_link href="{{ route('user_posts.index') }}">
                        <span class="bi bi-chevron-compact-left"></span> Kembali
                    </x-_link>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>