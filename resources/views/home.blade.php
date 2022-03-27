<x-app-layout title="Beranda">
    <x-_red-blur />

    <div class="w-full text-center font-bold text-2xl -mt-20 sm:text-7xl min-h-screen flex items-center justify-center flex-col">
        <div class="relative flex items-center justify-center w-full">
            <p class="typewriter inline-block max-w-fit">
                Tulis Sesuatu Yang Beda.
            </p>
        </div>
        <p class="text-base lh-base text-gray-500 font-normal max-w-xl mx-auto mt-10 sm:text-lg animate-show" style="animation-delay: 2.5s">
            Tulis karya, kenangan, opini dan hal unik kamu lainnya di sini biar orang lain tau dan bisa kamu baca lagi di masa depan nanti.
            <span class="inline-block"><span class="bi bi-emoji-smile-upside-down"></span></span>
        </p>

        @if ($posts->count())
        <a href="#posts"
            class="bi bi-chevron-compact-down text-3xl mx-auto text-red-500 mt-10 animate-bounce shadow-lg bg-white border-1 h-12 w-12 rounded-full flex justify-center items-center">
        </a>
        @endif
    </div>

    @if ($posts->count())
    <div class="text-center text-2xl sm:text-4xl py-3 sm:py-5" id="posts">
        Tulisan Terbaru
    </div>

    <x-_posts :posts="$posts"></x-_posts>
    @endif
</x-app-layout>