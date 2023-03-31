<x-app-layout title="Explore">
    {{-- Search Bar --}}
    <div class="border-slate-300 border-2 bg-white mb-4 rounded-xl sm:w-1/3 mx-auto">
        <form action="{{ route('explore') }}">
            <div class="flex grow w-full">
                <div class="pl-3 flex">
                    <i class="bi bi-search m-auto text-slate-400"></i>
                </div>
                @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
                @endif
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari"
                    class="w-full h-full border-0 bg-transparent rounded-xl active:border-none">
            </div>
        </form>
    </div>

    {{-- Category --}}
    <div
        class="h-10 overflow-hidden relative after:absolute after:w-24 after:h-full after:bg-gradient-to-l from-white after:right-0 after:top-0 mb-10">
        <div class="flex gap-2 overflow-x-scroll">
            @forelse ($categories as $category)
            <a href="{{ route('explore', ['category' => $category]) }}"
                class="font-semibold active:bg-slate-300 hover:text-inherit text-center
                {{ request('category') == $category->slug ? 'bg-slate-800 text-white' : 'bg-slate-200' }} hover:bg-opacity-80 transition py-2 px-3 rounded-xl min-w-max">
                {{ $category->name }}
            </a>
            @empty
            <div class="text-center font-semibold text-lg text-slate-700">Ups! Maaf sekarang masih belum ada category nih :(</div>
            @endforelse
        </div>
        <button class="absolute top-0 right-0 z-10 h-full flex">
            <span class="bi bi-chevron-right text-lg my-auto"></span>
        </button>
    </div>

    {{-- Posts --}}
    @if ($posts->count())
    {{-- All Post --}}
    <x-_posts :posts="$posts->skip(1)"></x-_posts>
    <div class="d-flex justify-content-center">{{ $posts->links() }}</div>
    @else
    <div class="text-center text-lg text-slate-800 mt-10">Ups!maaf ya, sekarang masih belum ada article nih :(</div>
    @endif
</x-app-layout>