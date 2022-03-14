<article id="post" class="row" id="post">
    @foreach ($posts as $post)
    <div class="col-md-4">
        <div class="card mb-3 pb-4 border-0 shadow-md relative">
            <a href="{{ route('posts', ['category' => $post->category->slug]) }}">
                <small class="absolute top-0 z-10 left-0 px-3 py-2 text-white bg-slate-900 text-base rounded-2  bg-opacity-40 backdrop-blur-lg">
                    {{ $post->category->name }}
                </small>
            </a>

            <div class="max-h-64 overflow-hidden">
                <x-_banner :post="$post"></x-_banner>
            </div>
            <div class="card-body">
                <h3 class="card-title">
                    <a href="{{ route('posts.single', $post) }}">{{ $post->title }}</a>
                </h3>

                <small class="mb-4 flex items-center">
                    <x-_photo :user="$post->author" size="sm"></x-_photo>
                    <a class="author ml-2" href="{{ route('posts', ['author' => $post->author->username]) }}">{{ $post->author->name }}</a>
                    <small class="text-muted ml-2">{{ $post->created_at->diffForHumans() }}</small>
                </small>

                <p class="card-text">
                    {{ $post->excerpt }}
                </p>
                <x-_link href="{{ route('posts.single', $post) }}">
                    Lanjut
                    <i class="bi bi-chevron-compact-right"></i>
                </x-_link>
            </div>
        </div>
    </div>
    @endforeach
</article>