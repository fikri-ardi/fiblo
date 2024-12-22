<div>
    {{-- User info --}}
    <div class="flex item-center mb-3">
        <a href="#post" class="w-20 text-center cursor-pointer hover:bg-gray-200 transition ease-out">
            <div class="font-semibold text-lg">{{ $postCount }}</div>
            Post
        </a>
        <small x-on:click="open = 'followers'" class="w-20 text-center cursor-pointer hover:bg-gray-200 transition ease-out">
            <div class="font-semibold text-lg">{{ $user->followers->count() }}</div>
            Pengikut
        </small>
        <small x-on:click="open = 'following'" class="w-20 text-center cursor-pointer hover:bg-gray-200 transition ease-out">
            <div class="font-semibold text-lg">{{ $user->follows->count() }}</div>
            Mengikuti
        </small>
    </div>
    
    {{-- Hidden Following Elements --}}
    <div x-show="open"
        class="fixed flex justify-center align-items-center w-full h-full bg-black bg-opacity-50 top-0 left-0 z-50 backdrop-blur-md transition">
        <div x-show="open == 'following'" x-transition x-on:click.outside="open = false"
            class="absolute rounded-xl shadow-lg h-96 w-56 py-3 overflow-y-scroll bg-white">
            <div class="font-bold text-lg mb-3 bg-white w-full text-center">
                Mengikuti
            </div>
            <livewire:profiles.follower-modal :user="$user" type="follows" />
        </div>

        <div x-show="open == 'followers'" x-transition x-on:click.outside="open = false"
            class="absolute rounded-xl shadow-lg h-96 w-56 py-3 overflow-y-scroll bg-white">
            <div class="font-bold text-lg mb-3 bg-white w-full text-center">
                Pengikut
            </div>
            <livewire:profiles.follower-modal :user="$user" type="followers" />
        </div>
    </div>
</div>