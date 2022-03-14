<x-app-layout title="Beranda">
    <x-_red-blur />

    <div class="col-sm-10 text-center font-bold text-5xl my-14 mx-auto sm:text-7xl sm:my-44 ">
        <p>It's Always Seem Impossible</p>
        <p class="text-red-500">Until It's Done</p>
        <p class="text-base lh-base text-gray-500 font-normal max-w-xl mx-auto mt-10 sm:text-lg">
            Hai! Salam kenal, saya Fikri, seseorang yang ngakunya programmer, hoby main gitar, nyanyi, futsal, suka baca buku, bikin eksperimen,
            ngoding dan juga suka sama kamu <span class="bi bi-emoji-smile-upside-down"></span>
        </p>

        @if ($posts->count())
        <a href="#posts"
            class="bi bi-arrow-down text-3xl mx-auto text-red-500 mt-10 animate-bounce shadow-lg bg-white border-1 h-12 w-12 rounded-full d-flex justify-center align-items-center cursor-pointer relative z-10">
        </a>
        @endif
    </div>

    <x-_blue-blur />

    @if ($posts->count())
    <div class="text-center text-5xl py-5" id="posts">
        Tulisan Terbaru
    </div>

    <x-_posts :posts="$posts"></x-_posts>
    @endif
</x-app-layout>