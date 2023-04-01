<x-app-layout title="Profil">
    {{-- Content --}}
    <div x-data="{open: false}" class="d-flex align-items-center flex-column border-bottom border-gray-500 pb-4 mb-4">
        {{-- User Photo --}}
        <div class="font-semibold text-lg mb-2">{{ $user->name }}</div>
        <div class="flex flex-col align-items-center mb-2" @click="open='{{ $user->photo }}'">
            <div class="w-24 h-24 rounded-full text-5xl">
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
        <livewire:profiles.info :postCount="$posts->count()" :user="$user" />

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
            <livewire:profiles.follow :targetUser="$user" />
            @endcan
            @endauth
            <x-_social-media :user="$user" />
        </div>

        <div class="text-center">
            <p class="text-sm font-italic w-72"><i>{{ "$user->bio" ?? '' }}</i></p>
        </div>
    </div>

    @if ($posts->count())
    <x-_posts :posts="$posts"></x-_posts>

    @else
    <div class="text-center mt-3 text-lg">{{ "@$user->username" }} belum punya postingan.</div>
    @endif
</x-app-layout>