<x-app-layout title="Semua Kategori">
    <h2 class="mb-5">Kategori Post</h2>

    <div class="row">
        @forelse ($categories as $category)
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="relative flex justify-center items-center">
                <a href="{{ route('posts', ['category' => $category]) }}" class="stretched-link"></a>
                <div class="absolute bg-slate-100 bg-opacity-30 text-slate-800 font-semibold fs-4 text-center w-100 p-3 backdrop-blur-lg">
                    {{ $category->name }}
                </div>
                <img src="/images/hero.jpg" class="hero-image w-full h-100 overflow-hidden rounded-3xl">
            </div>
        </div>
        @empty
        <div class="text-center font-semibold text-lg text-slate-700">Ups! Maaf sekarang masih belum ada category nih :(</div>
        @endforelse
    </div>
</x-app-layout>