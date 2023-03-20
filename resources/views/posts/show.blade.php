<x-app-layout :title="$post->title">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">

                {{-- Banner --}}
                <div class="max-h-96 overflow-hidden">
                    <x-_banner :post="$post"></x-_banner>
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
                            <a class="text-gray-700 font-semibold text-xl mr-2" href="{{  route('profiles.show', $post->author)  }}">{{
                                $post->author->name
                                }}</a>

                            {{-- action button --}}
                            @auth
                            @can('username', $post->author->username)
                            @else
                            <form action="{{ route('profiles.follow', $post->author) }}" method="post" class="flex align-bottom">
                                @csrf
                                <button class="text-gray-500 hover:text-gray-600">
                                    <span class="bi bi-person-{{ auth()->user()->wasFollow($post->author) ? 'check' : 'plus' }}-fill mr-1"></span>
                                </button>
                            </form>
                            @endcan
                            @endauth
                        </div>

                        {{-- post info --}}
                        <span class="flex text-gray-500 font-semibold">
                            <a class="bg-slate-200 text-gray-600 px-2 py-1 font-semibold text-sm active:bg-slate-300 rounded-full hover:text-inherit transition text-center"
                                href="{{ route('user_posts.index', ['category' => $post->category->slug]) }}">{{ $post->category->name
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
                    <a href="{{ route('profiles.show', $post->author) }}">
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
                    <x-_link href="{{ route('user_posts.index') }}">
                        <span class="bi bi-chevron-compact-left"></span> Kembali
                    </x-_link>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>