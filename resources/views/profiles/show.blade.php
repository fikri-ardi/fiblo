<x-app-layout title="Profil">
    {{-- Content --}}
    <div x-data="{open: false}" class="d-flex align-items-center flex-column border-bottom border-gray-500 pb-4">
        {{-- User Photo --}}
        <div class="font-semibold text-lg mb-2">{{ $user->name }}</div>
        <div class="flex flex-col align-items-center mb-2">
            @if ($user->photo)
            <img src="/storage/{{ $user->photo }}" class="rounded-circle w-36 h-36 object-cover border-5 border-slate-200" alt=" {{ $user->name }}">
            @else
            <span class="bi bi-person bg-red-100 text-red-500 p-9 text-7xl rounded-full d-block "></span>
            @endif
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
        <div class="flex mb-3 bg-blue-800 text-blue-100 rounded-lg overflow-hidden">
            @can('username', $user->username)
            <form action="{{ route('profiles.edit', $user) }}" method="get"
                class="w-24 py-2 text-center text-sm hover:bg-blue-900 transition duration-200 cursor-pointer">
                <span class="bi bi-pencil text-xs"></span>
                <button type="submit">Ubah</button>
            </form>
            @else
            <form action="{{ route('profiles.follow', $user) }}" method="post"
                class="w-24 py-2 text-center text-sm hover:bg-blue-900 transition duration-200 cursor-pointer">
                @csrf
                <span class="bi bi-person-{{ auth()->user()->wasFollow($user) ? 'dash' : 'plus' }}"></span>
                <button type="submit">
                    {{ auth()->user()->wasFollow($user) ? 'Unfollow' : 'Follow' }}
                </button>
            </form>
            @endcan
        </div>

        {{-- Hidden Following Elements --}}
        <div x-show="open"
            class="fixed flex justify-center align-items-center w-full h-full bg-black bg-opacity-50 top-0 left-0 z-50 backdrop-blur-md transition pointer-events-none">

            <div x-show="open == 'following'" x-transition @click.away="open = false"
                class="absolute rounded-xl shadow-lg h-96 w-56 py-3 overflow-y-scroll bg-white">
                <div class="font-bold text-lg mb-3 bg-white w-full text-center">
                    Following
                </div>
                <div class="pl-5">
                    @foreach ($user->follows as $following)
                    <div class="my-2 flex justify-center-center">
                        {{-- Photo or Avatar --}}
                        @if ($following->photo)
                        <img src="/storage/{{ $following->photo }}" class="rounded-circle w-7 h-7 object-cover d-inline-block"
                            alt="{{ $following->name }}">
                        @else
                        <span class="bg-red-100 text-red-500 font-bold text-base h-7 w-7 text-center flex item-center justify-center rounded-full">
                            <span>{{ strtoupper(substr($following->username, 0, 1)) }}</span>
                        </span>
                        @endif
                        {{-- Username --}}
                        <span class="ml-2"> {{ $following->username }} </sp>
                    </div>
                    @endforeach
                </div>
            </div>

            <div x-show="open == 'followers'" x-transition @click.away="open = false"
                class="absolute rounded-xl shadow-lg h-96 w-56 py-3 overflow-y-scroll bg-white">
                <div class="font-bold text-lg mb-3 bg-white w-full text-center">
                    Followers
                </div>
                <div class="pl-5">
                    @foreach ($user->followers as $followers)
                    <div class="my-2 flex justify-center-center">
                        {{-- Photo or Avatar --}}
                        @if ($followers->photo)
                        <img src="/storage/{{ $followers->photo }}" class="rounded-circle w-7 h-7 object-cover d-inline-block"
                            alt="{{ $followers->name }}">
                        @else
                        <span class="bg-red-100 text-red-500 font-bold text-base h-7 w-7 text-center flex item-center justify-center rounded-full">
                            <span>{{ strtoupper(substr($followers->username, 0, 1)) }}</span>
                        </span>
                        @endif
                        {{-- Username --}}
                        <span class="ml-2"> {{ $followers->username }} </sp>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="text-center">
            <p class="text-sm font-italic w-72"><i>"{{ $user->bio ?? 'Bio kamu masih kosong' }}"</i></p>
        </div>
    </div>

    @if ($user->posts->count())
    <article id="post" class="row mt-5" id="post">
        @foreach ($user->posts as $post)
        <div class="col-md-4">
            <div class="card mb-3 pb-4 border-0 shadow-md relative">
                <a href="{{ route('posts', ['category' => $post->category->slug]) }}">
                    <small class="absolute top-0 z-10 left-0 px-3 py-2 text-white bg-slate-900 text-base rounded-2  bg-opacity-40 backdrop-blur-lg">{{
                        $post->category->name
                        }}</small>
                </a>

                @if ($post->image)
                <img src="/storage/{{ $post->image }}" class="card-img-top w-100 h-100 hero-image position-relative img-fluid"
                    style="left: 0; max-height: 250px; object-fit: cover">
                @else
                <img src="/images/hero.jpg" class="card-img-top w-100 h-100 hero-image position-relative img-fluid"
                    style="left: 0; max-height: 250px; object-fit: cover">
                @endif
                <div class="card-body">
                    <h3 class="card-title">
                        <a href="{{ route('posts.single', $post) }}">{{ $post->title }}</a>
                    </h3>

                    <small class="mb-4 d-block">
                        Ditulis oleh
                        <a class="author" href="{{ route('posts', ['author' => $post->author->username]) }}">{{ $post->author->name }}</a>
                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                    </small>

                    <p class="card-text">
                        {{ $post->excerpt }}
                    </p>
                    <a href="{{ route('posts.single', $post) }}" class="btn btn-sm btn-danger font-weight-bold mt-4">
                        Lanjut <i class="bi bi-chevron-compact-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </article>

    @else
    <div class="text-center mt-3 text-lg">{{ $user->name }} belum punya postingan.</div>
    @endif

</x-app-layout>