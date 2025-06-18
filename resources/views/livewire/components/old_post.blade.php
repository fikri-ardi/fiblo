<div class="col-md-4">
    <div class="card mb-3 pb-4 border-0 relative">
        {{-- Post Category --}}
        <a wire:navigate href="{{ route('posts.index', ['category' => $post->category->slug]) }}">
            <small class="absolute top-0 z-10 left-0 px-3 py-2 text-white bg-slate-900 text-base rounded-2 bg-opacity-40 backdrop-blur-lg">
                {{ $post->category->name }}
            </small>
        </a>

        {{-- Post Banner --}}
        <div class="h-60">
            <x-_banner :post="$post" :photos="$photos"></x-_banner>
        </div>

        <div class="card-body">
            {{-- Author Info --}}
            <small class="mb-3 flex items-center">
                <a wire:navigate class="flex items-center space-x-2 active:bg-slate-200 rounded-full pr-2 transition"
                    href="{{ route('users.show', $post->author) }}">
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
                    <a wire:navigate href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                </h4>

                {{-- action button --}}
                @can('username', $post->author->username)
                <button x-on:click="open = '{{ $post->slug }}'"
                    class="text-slate-400 text-base rounded-full flex items-center justify-center h-8 w-8 mt-1 active:bg-slate-400 cursor-pointer">
                    <i class="bi bi-three-dots-vertical text-lg"></i>
                </button>

                {{-- action menu --}}
                <div x-show="open == '{{ $post->slug }}'" x-transition class="bg-black bg-opacity-50 backdrop-blur-md w-full h-full fixed left-0 top-0 flex justify-center items-center"
                    style="z-index: 999;">
                    <div class="bg-white flex flex-col rounded-xl overflow-hidden" x-on:click.outside="open=false">
                        <a wire:navigate href="{{ route('posts.edit', $post) }}"
                            class="px-4 py-2 flex items-center text-slate-700 active:bg-slate-400">
                            <i class="bi bi-pencil mr-1"></i> Ubah
                        </a>
                        <button wire:click="delete" wire:confirm="Kamu yakin?" class="px-4 py-2 flex items-center text-slate-700 active:bg-slate-400">
                            <i class="bi bi-trash mr-1"></i> Hapus
                        </button>
                    </div>
                </div>
                @endcan
            </div>

            <p class="card-text text-slate-800">
                {{ str()->limit($post->excerpt, 100) }}
            </p>

            {{-- post info --}}
            <span class="flex text-gray-500 font-semibold">
                <a wire:navigate
                    class="bg-slate-200 text-gray-600 px-2 py-1 font-semibold text-sm active:bg-slate-300 rounded-full hover:text-inherit transition text-center"
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

    <div x-data="{cardBlur: false}" @mouseover="cardBlur = true" @mouseleave="cardBlur = false"
        class="relative cursor-pointer w-[19.5rem] rounded-[32px] h-[450px] p-[0.65rem] overflow-hidden bg-cover bg-center"
        style="background-image: url('{{ config('app.url').$post->image }}')"
        >
        {{-- Save Button --}}
        <button class="absolute z-40 top-0 right-0 bg-white bg-opacity-10 backdrop-blur-lg m-[0.78rem] p-[0.6rem] rounded-full">
            <i class="bi bi-bookmark-plus text-white"></i>
        </button>
    
        {{-- Content --}}
        <div class="relative z-40 h-full text-white flex flex-col justify-end">
            {{-- Header --}}
            <div class="flex justify-between items-center">
                <div class="text-[23px] font-bold">Impostor Syndrome</div>
                <div class="flex space-x-1 text-sm items-center backdrop-blur-lg py-1 px-2 rounded-full bg-white bg-opacity-10">
                    <i class="bi bi-eye"></i>
                    <span class="font-semibold">890</span>
                </div>
            </div>
    
            {{-- Body --}}
            <p class="text-[1rem] w-3/4 text-gray-300">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti, commodi temporibus?</p>
    
            {{-- Footer --}}
            <div class="flex text-sm font-semibold space-x-2">
                <div class="backdrop-blur-lg b bg-white bg-opacity-10 py-1 px-2 rounded-full flex items-center space-x-1">
                    <i class="bi bi-bookmark"></i>
                    <span>Life</span>
                </div>
                <div class="backdrop-blur-lg b bg-white bg-opacity-10 py-1 px-2 rounded-full">1 min read</div>
                <div class="backdrop-blur-lg b bg-white bg-opacity-10 py-1 px-2 rounded-full">27 May</div>
            </div>
    
            <a href="#" class="bg-white w-full py-2 text-lg text-slate-900 rounded-full text-center font-bold mt-4">
                Read Now
            </a>
        </div>
    
        {{-- Progressive Blur --}}
        <div :class="cardBlur ? '!h-full' : ''"
            class="absolute left-0 right-0 bottom-0 w-full h-[63%] pointer-events-none transition-all duration-1000 ease-in-out">
            <div class="blur-filter"></div>
            <div class="blur-filter"></div>
            <div class="blur-filter"></div>
            <div class="blur-filter"></div>
            <div class="blur-filter"></div>
            <div class="blur-filter"></div>
            <div class="blur-filter"></div>
            <!-- this gradient hides the glitching -->
            <div class="gradient absolute top-0 left-0 right-0 bottom-0 bg-gradient-to-t from-[#0000005a] to-transparent"></div>
        </div>
    </div>
</div>