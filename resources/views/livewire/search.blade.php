<div x-data="{searchInput: ''}" class="border-slate-300 border bg-white mb-4 rounded-xl sm:w-1/4 mx-auto relative">
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
            <input x-model="searchInput" wire:model.live="search" type="text" name="search" value="{{ request('search') }}" placeholder="Cari"
                class="w-full h-full border-0 bg-transparent rounded-xl active:border-none focus:ring-0">

            {{-- Autocomplete --}}
            @if ($users !== null && $users->isNotEmpty() || $posts !== null && $posts->isNotEmpty())
            <div x-show="searchInput !== ''" x-transition
                class="absolute top-full left-0 z-20 w-full mt-2 rounded-lg bg-white shadow-md px-4 pt-3 pb-4">
                {{-- Users Autocomplete --}}
                @if ($users !== null && $users->isNotEmpty())
                <div>
                    <div class="py-2">AKUN</div>
                    @foreach ($users as $user)
                    <div wire:key="{{ $user->id }}" class="py-2 flex justify-center-center hover:bg-gray-100 cursor-pointer transition">
                        <a wire:navigate href="{{ route('users.show', $user) }}" class="w-full flex items-center">
                            <div class="h-10 w-10">
                                <x-_photo :user="$user" size="md"></x-_photo>
                            </div>
                            <div>
                                <div class="ml-2 text-sm font-semibold"> {{ $user->username }} </div>
                                <div class="ml-2 text-sm text-slate-500"> {{ $user->name }} </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Posts Autocomplete --}}
                @if ($posts !== null && $posts->isNotEmpty())
                <div>
                    <div class="py-2">TULISAN</div>
                    @foreach ($posts as $post)
                    <div wire:key="{{ $post->id }}" class="py-2 flex justify-center-center hover:bg-gray-100 cursor-pointer transition">
                        <a wire:navigate href="{{ route('posts.show', $post) }}" class="w-full flex items-center">
                            <div class="flex">
                                <span class="bi bi-pencil-fill m-auto bg-slate-200 text-slate-800 h-10 w-10 rounded-full"></span>
                            </div>
                            <span class="ml-3 text-sm font-semibold text-slate-800"> {{ str($post->title)->limit(30) }} </span>
                        </a>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            @endif
        </div>
    </form>
</div>