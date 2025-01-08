<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">

                {{-- Banner --}}
                <div class="max-h-96 overflow-hidden">
                    <x-_banner :post="$post" :photos="$photos"></x-_banner>
                </div>

                {{-- Author --}}
                <div class="my-3 flex space-x-2">
                    {{-- author profile --}}
                    <span class="w-14 h-14 mr-2 inline-flex">
                        <x-_photo :user="$post->author" class="text-2xl"></x-_photo>
                    </span>

                    {{-- Post info --}}
                    <div class="flex flex-col justify-evenly">
                        {{-- Author info --}}
                        <div class="flex align-bottom">
                            {{-- author name --}}
                            <a wire:navigate class="font-semibold text-xl mr-2" href="{{  route('users.show', $post->author)  }}">
                                {{ $post->author->name }}
                            </a>
                            
                            {{-- action button --}}
                            @auth
                            @cannot('username', $post->author->username)
                            <livewire:posts.follow :author="$post->author" />
                            @endcan
                            @endauth
                        </div>

                        {{-- post info --}}
                        <span class="flex text-gray-500 space-x-1">
                            <div>{{ $reading_time }} min read</div>
                            <span class="bi bi-dot"></span>
                            <span class="flex align-middle">
                                <span class="bi bi-eye text-lg mr-2"></span>
                                <span>{{ $post->visitors->count() }}</span>
                            </span>
                            <span class="bi bi-dot"></span>
                            <span>{{ $post->created_at->format('M d') }}</span>
                        </span>
                    </div>
                </div>

                {{-- Post --}}
                <h2 class="my-3">{{ $post->title }}</h2>
                <article class="mb-4 text-slate-800 text-lg sm:text-xl">{!! $post->body !!}</article>
                <div class="py-10">
                    <a wire:navigate
                        class="bg-gray-100 px-3 py-2 active:bg-slate-200 rounded-full hover:text-inherit transition text-center"
                        href="{{ route('posts.index', ['category' => $post->category->slug]) }}">{{ $post->category->name
                        }}</a>
                </div>

                {{-- author's bio --}}
                <div class="flex items-center flex-col mb-5 space-y-2 sm:flex-row sm:space-x-5 sm:space-y-0">
                    <a wire:navigate href="{{ route('users.show', $post->author) }}">
                        <div class="w-14 h-14 sm:w-14 sm:h-14">
                            <x-_photo :user="$post->author" class="text-2xl"></x-_photo>
                        </div>
                    </a>
                    <div class="flex items-center flex-col sm:items-start">
                        <div class="text-2xl font-semibold">{{ $post->author->name }}</div>
                        <div class="flex space-x-1 justify-center items-center text-gray-500">
                            <div>{{ $post->author->followers->count() }} Pengikut</div>
                            <i class="bi bi-dot"></i>
                            <div>{{ $post->author->follows->count() }} Mengikuti</div>
                        </div>
                    </div>
                </div>

                <div class="flex mb-44">
                    <x-_link href="{{ url()->previous() }}">
                        <span class="bi bi-chevron-compact-left"></span> Kembali
                    </x-_link>
                </div>
            </div>
        </div>
    </div>
</div>
