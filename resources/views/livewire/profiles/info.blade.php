<div class="flex item-center mb-3">
    <a href="#post" class="w-20 text-center cursor-pointer hover:bg-gray-200 transition ease-out">
        <div class="font-semibold text-lg">{{ $postCount }}</div>
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

{{-- Hidden Following Elements --}}
<x-_blur-layer>
    <div x-show="open == 'following'" x-transition @click.away="open = false"
        class="absolute rounded-xl shadow-lg h-96 w-56 py-3 overflow-y-scroll bg-white">
        <div class="font-bold text-lg mb-3 bg-white w-full text-center">
            Mengikuti
        </div>
        <livewire:profiles.follower-modal :user="$user" type="follows" />
    </div>

    <div x-show="open == 'followers'" x-transition @click.away="open = false"
        class="absolute rounded-xl shadow-lg h-96 w-56 py-3 overflow-y-scroll bg-white">
        <div class="font-bold text-lg mb-3 bg-white w-full text-center">
            Pengikut
        </div>
        <livewire:profiles.follower-modal :user="$user" type="followers" />
    </div>
</x-_blur-layer>