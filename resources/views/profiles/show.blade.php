<x-app-layout title="Profil">
    {{-- Content --}}
    <div x-data="{open: false}" class="d-flex align-items-center flex-column border-bottom border-gray-500 pb-4 mb-4">
        {{-- User Photo --}}
        <div class="font-semibold text-lg mb-2">{{ $user->name }}</div>
        <div class="flex flex-col align-items-center mb-2" @click="open='{{ $user->photo }}'">
            <div class="w-24 h-24 rounded-full border-3 border-slate-800 text-5xl">
                <x-_photo :user="$user">
                    <div x-show="open == '{{ $user->photo }}'" x-transition class="fixed top-0 left-0 flex justify-center items-center w-full h-full"
                        style="z-index: 999">
                        <img @click.away="open = false" src="{{ $user->photo }}" alt="{{ $user->name }}" class="w-56 h-56 object-cover rounded-xl">
                    </div>
                </x-_photo>
            </div>

        </div>
        <div class="font-semibold text-lg mb-2">{{ "@$user->username" }}</div>

        {{-- Profile Info --}}
        <div class="flex item-center mb-3">
            <a href="#post" class="w-20 text-center cursor-pointer hover:bg-gray-200 transition ease-out">
                <div class="font-semibold text-lg">{{ $posts->count() }}</div>
                Post
            </a>
            <small @click="open = 'followers'" class="w-20 text-center cursor-pointer hover:bg-gray-200 transition ease-out">
                <div class="font-semibold text-lg">{{ $user->followers->count() }}</div>
                Pengikut
            </small>
            <small @click="open = 'following'" class="w-20 text-center cursor-pointer hover:bg-gray-200 transition ease-out">
                <div class="font-semibold text-lg">{{ $user->follows->count() }}</div>
                Mengikuti
            </small>
        </div>

        {{-- action button --}}
        <div class="flex mb-3 space-x-2">
            @auth
            @can('username', $user->username)
            <form action="{{ route('profiles.edit', $user) }}" method="get">
                <x-_button>
                    <span class="bi bi-pencil text-xs mr-1"></span>
                    Ubah
                </x-_button>
            </form>
            @else
            <form action="{{ route('profiles.follow', $user) }}" method="post">
                @csrf
                <x-_button>
                    <span class="bi bi-person-{{ auth()->user()->wasFollow($user) ? 'dash' : 'plus' }} mr-1"></span>
                    {{ auth()->user()->wasFollow($user) ? 'Unfollow' : 'Follow' }}
                </x-_button>
            </form>
            @endcan
            @endauth
            <x-_social-media :user="$user" />
        </div>

        {{-- Hidden Following Elements --}}
        <x-_blur-layer>
            <div x-show="open == 'following'" x-transition @click.away="open = false"
                class="absolute rounded-xl shadow-lg h-96 w-56 py-3 overflow-y-scroll bg-white">
                <div class="font-bold text-lg mb-3 bg-white w-full text-center">
                    Mengikuti
                </div>
                <x-_followments :user="$user" type="follows"></x-_followments>
            </div>

            <div x-show="open == 'followers'" x-transition @click.away="open = false"
                class="absolute rounded-xl shadow-lg h-96 w-56 py-3 overflow-y-scroll bg-white">
                <div class="font-bold text-lg mb-3 bg-white w-full text-center">
                    Pengikut
                </div>
                <x-_followments :user="$user" type="followers"></x-_followments>
            </div>
        </x-_blur-layer>

        <div class="text-center">
            <p class="text-sm font-italic w-72"><i>{{ "$user->bio" ?? '' }}</i></p>
        </div>
    </div>

    @if ($posts->count())
    <x-_posts :posts="$posts"></x-_posts>

    @else
    <div class="text-center mt-3 text-lg">{{ "@$user->name" }} belum punya postingan.</div>
    @endif
</x-app-layout>