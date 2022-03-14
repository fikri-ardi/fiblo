<x-app-layout title="Profil">
    {{-- Content --}}
    <div x-data="{open: false}" class="d-flex align-items-center flex-column border-bottom border-gray-500 pb-4 mb-4">
        {{-- User Photo --}}
        <div class="font-semibold text-lg mb-2">{{ $user->name }}</div>
        <div class="flex flex-col align-items-center mb-2">
            <x-_photo :user="$user" size="md"></x-_photo>
        </div>
        <div class="font-semibold text-lg mb-2">{{ "@$user->username" }}</div>

        {{-- Profile Info --}}
        <div class="flex item-center mb-3">
            <a href="#post" class="w-20 text-center cursor-pointer hover:bg-gray-200 transition ease-out">
                <div class="font-semibold text-lg">{{ $user->posts->count() }}</div>
                Post
            </a>
            <small @click="open = 'followers'" class="w-20 text-center cursor-pointer hover:bg-gray-200 transition ease-out">
                <div class="font-semibold text-lg">{{ $user->followers->count() }}</div>
                Follower
            </small>
            <small @click="open = 'following'" class="w-20 text-center cursor-pointer hover:bg-gray-200 transition ease-out">
                <div class="font-semibold text-lg">{{ $user->follows->count() }}</div>
                Following
            </small>
        </div>

        {{-- action button --}}
        <div class="flex mb-3">
            @can('username', $user->username)
            <form action="{{ route('profiles.edit', $user) }}" method="get">
                <x-_button>
                    <span class="bi bi-pencil text-xs"></span>
                    Ubah
                </x-_button>
            </form>
            @else
            <form action="{{ route('profiles.follow', $user) }}" method="post">
                @csrf
                <x-_button>
                    <span class="bi bi-person-{{ auth()->user()->wasFollow($user) ? 'dash' : 'plus' }}"></span>
                    {{ auth()->user()->wasFollow($user) ? 'Unfollow' : 'Follow' }}
                </x-_button>
            </form>
            @endcan
        </div>

        {{-- Hidden Following Elements --}}
        <div x-show="open"
            class="fixed flex justify-center align-items-center w-full h-full bg-black bg-opacity-50 top-0 left-0 z-50 backdrop-blur-md transition">

            <div x-show="open == 'following'" x-transition @click.away="open = false"
                class="absolute rounded-xl shadow-lg h-96 w-56 py-3 overflow-y-scroll bg-white">
                <div class="font-bold text-lg mb-3 bg-white w-full text-center">
                    Following
                </div>
                <x-_followments :user="$user" type="follows"></x-_followments>
            </div>

            <div x-show="open == 'followers'" x-transition @click.away="open = false"
                class="absolute rounded-xl shadow-lg h-96 w-56 py-3 overflow-y-scroll bg-white">
                <div class="font-bold text-lg mb-3 bg-white w-full text-center">
                    Followers
                </div>
                <x-_followments :user="$user" type="followers"></x-_followments>
            </div>
        </div>

        <div class="text-center">
            <p class="text-sm font-italic w-72"><i>"{{ $user->bio ?? 'Bio kamu masih kosong' }}"</i></p>
        </div>
    </div>

    @if ($user->posts->count())
    <x-_posts :posts="$user->posts"></x-_posts>

    @else
    <div class="text-center mt-3 text-lg">{{ $user->name }} belum punya postingan.</div>
    @endif
</x-app-layout>