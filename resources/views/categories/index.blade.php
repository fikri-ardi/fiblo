<x-app-layout title="Semua Topik">
    <h2 class="mb-5">Topik Post</h2>

    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 xl:grid-cols-9 gap-3">
        @forelse ($categories as $category)
        <a href="{{ route('user_posts.index', ['category' => $category]) }}"
            class="bg-slate-200 py-2 font-semibold active:bg-slate-300 rounded-full hover:text-inherit transition text-center">
            {{ $category->name }}
        </a>
        @empty
        <div class="text-center font-semibold text-lg text-slate-700">Ups! Maaf sekarang masih belum ada category nih :(</div>
        @endforelse
    </div>
</x-app-layout>