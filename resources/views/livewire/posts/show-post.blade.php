<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">

                {{-- Banner --}}
                <div class="max-h-96 overflow-hidden">
                    <x-_banner :post="$post" :photos="$photos"></x-_banner>
                </div>

                {{-- Author --}}
                <div class="my-3 flex">
                    {{-- author profile --}}
                    <span class="w-16 h-16 mr-2 inline-flex">
                        <x-_photo :user="$post->author" class="text-2xl"></x-_photo>
                    </span>

                    {{-- author information --}}
                    <div class="flex flex-col justify-evenly">
                        <div class="flex align-bottom">
                            {{-- author name --}}
                            <a wire:navigate class="text-gray-700 font-semibold text-xl mr-2" href="{{  route('users.show', $post->author)  }}">{{
                                $post->author->name
                                }}</a>

                            {{-- action button --}}
                            @auth
                            @cannot('username', $post->author->username)
                            <livewire:posts.follow :author="$post->author" />
                            @endcan
                            @endauth
                        </div>

                        {{-- post info --}}
                        <span class="flex text-gray-500 font-semibold">
                            <a wire:navigate class="bg-slate-200 text-gray-600 px-2 py-1 font-semibold text-sm active:bg-slate-300 rounded-full hover:text-inherit transition text-center"
                                href="{{ route('posts.index', ['category' => $post->category->slug]) }}">{{ $post->category->name
                                }}</a>
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
                <article class="mb-5 text-slate-800 text-lg sm:text-xl">{!! $post->body !!}</article>

                {{-- author's bio --}}
                <div class="flex items-center flex-col mb-5 sm:flex-row">
                    <a wire:navigate href="{{ route('users.show', $post->author) }}">
                        <div class="w-28 h-28 mb-3 sm:w-32 sm:h-32 sm:mr-8">
                            <x-_photo :user="$post->author" class="text-5xl"></x-_photo>
                        </div>
                    </a>
                    <div class="flex items-center flex-col sm:items-start">
                        <div class="text-3xl font-bold">{{ $post->author->name }}</div>
                        <p class="lh-base text-lg my-2 text-justify text-slate-800">{{ $post->author->bio }}</p>
                        <x-_social-media :user="$post->author" />
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
