<div>
    {{-- User profiles --}}
    <div x-data="{open: false}" class="d-flex align-items-center flex-column border-bottom border-gray-500 pb-4 mb-4">
        {{-- User Photo --}}
        <div class="font-semibold text-lg mb-2">{{ $user->name }}</div>
        <div class="flex flex-col align-items-center mb-2" x-on:click="open='{{ $user->photo }}'">
            <div class="w-24 h-24 rounded-full text-5xl">
                <x-_photo :user="$user">
                    <div x-show="open == '{{ $user->photo }}'" x-transition class="fixed top-0 left-0 flex justify-center items-center w-full h-full"
                        style="z-index: 999">
                        <img x-on:click.outside="open = false" src="{{ env('APP_URL').$user->photo }}" alt="{{ $user->name }}" class="w-56 h-56 object-cover rounded-xl">
                    </div>
                </x-_photo>
            </div>
    
        </div>
    
        {{-- User name --}}
        <div class="font-semibold text-lg mb-2">{{ "@$user->username" }}</div>
    
        {{-- Profile Info --}}
        <livewire:profiles.info :postCount="$posts->count()" :user="$user" />
    
        {{-- action button --}}
        <div class="flex mb-3 space-x-2">
            @auth
            @can('username', $user->username)
            <a wire:navigate class='flex items-center rounded-2xl text-sm text-capitalize no-underline bg-slate-800 active:bg-slate-900 px-3 py-2
                text-blue-100
                font-semibold shadow-lg transition
                duration-200 hover:text-blue-100' href="{{ route('users.edit', $user) }}" >
                <span class="bi bi-pencil text-xs mr-1"></span>
                Edit Profile
            </a>
            @else
            <livewire:profiles.follow :targetUser="$user" />
            @endcan
            @endauth
            <x-_social-media :user="$user" />
        </div>
    
        <div class="text-center">
            <p class="text-sm w-72">{{ "$user->bio" ?? '' }}</p>
        </div>
    </div>
    
    @if ($posts->count())
    <x-posts :posts="$posts" :photos="$photos"></x-posts>
    @else
    <div class="text-center mt-3 text-lg space-y-4 text-slate-700 flex items-center flex-col">
        <div class="w-14 h-14">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
        </div>
        <div class="text-2xl font-bold">Belum Ada Tulisan</div>
    </div>
    @endif
</div>
