<article id="post" class="row" id="post" x-data="{open: false}">
    @foreach ($posts as $post)
    <div class="col-md-4">
        <div class="card mb-3 pb-4 border-0 shadow-md relative">
            {{-- Post Category --}}
            <a href="{{ route('user_posts.index', ['category' => $post->category->slug]) }}">
                <small class="absolute top-0 z-10 left-0 px-3 py-2 text-white bg-slate-900 text-base rounded-2 bg-opacity-40 backdrop-blur-lg">
                    {{ $post->category->name }}
                </small>
            </a>

            {{-- Post Banner --}}
            <div class="h-60">
                <x-_banner :post="$post"></x-_banner>
            </div>

            <div class="card-body">
                {{-- Author Info --}}
                <small class="mb-3 flex items-center">
                    <a class="flex items-center space-x-2 active:bg-slate-200 rounded-full pr-2 transition"
                        href="{{ route('profiles.show', $post->author) }}">
                        <div class="h-8 w-8">
                            <x-_photo :user="$post->author"></x-_photo>
                        </div>
                        <span class="font-semibold text-base">{{ $post->author->name }}</span>
                    </a>
                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                </small>

                {{-- Post title & Action button--}}
                <div class="flex items-start justify-between">
                    <h4 class="card-title">
                        <a href="{{ route('user_posts.show', $post) }}">{{ $post->title }}</a>
                    </h4>

                    @can('username', $post->author->username)
                    {{-- action button --}}
                    <a @click="open = '{{ $post->slug }}'"
                        class="text-slate-400 text-base rounded-full flex items-center justify-center h-8 w-8 mt-1 active:bg-slate-400 cursor-pointer">
                        <i class="bi bi-three-dots-vertical text-lg"></i>
                    </a>

                    {{-- action menu --}}
                    <div x-show="open == '{{ $post->slug }}'" x-transition class="w-full h-full fixed left-0 top-0 flex justify-center items-center"
                        style="z-index: 999;">
                        <div class="bg-white flex flex-col rounded-xl overflow-hidden" @click.away="open=false">
                            <a href="{{ route('user_posts.edit', $post) }}" class="px-4 py-2 flex items-center text-slate-700 active:bg-slate-400">
                                <i class="bi bi-pencil mr-1"></i> Ubah
                            </a>
                            <form action="{{ route('user_posts.destroy', $post) }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button onclick="return confirm('Kamu yakin?')"
                                    class="px-4 py-2 flex items-center text-slate-700 active:bg-slate-400">
                                    <i class="bi bi-trash mr-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @endcan
                </div>

                <p class="card-text text-slate-800">
                    {{ str()->limit($post->excerpt, 100) }}
                </p>

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
    </div>
    @endforeach
    <x-_blur-layer></x-_blur-layer>
</article>