<x-dashboard-layout title="{{ $post->title }}">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
            <div class="col-md-7 col-lg-8">
                <x-_banner :post="$post"></x-_banner>
                <h2 class="my-4">{{ $post->title }}</h2>
                <article class="fs-5">{!! $post->body !!}</article>
            </div>

            {{-- Action Button --}}
            <div class="mx-4">
                <a href="{{ route('posts.index') }}" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning"><span data-feather="edit-3"></span> Ubah</a>
                <form action="{{ route('posts.destroy', $post) }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Kamu yakin?')">
                        <span data-feather="x-circle"></span> Hapus
                    </button>
                </form>
            </div>
        </div>
    </main>
</x-dashboard-layout>