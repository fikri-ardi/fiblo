<x-dashboard-layout title="Semua Post">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Semua Post</h1>
        </div>

        <div class="table-responsive">
            <div class="flex mb-3">
                <x-_link href="{{ route('posts.create') }}" class="mb-3 mr-1"><span data-feather="plus"></span> Buat Post</x-_link>
                <x-_link href="{{ route('posts.index') }}"
                    class="mb-3 mr-1{{ request()->is('dashboard/posts') ?: ' bg-slate-300 text-slate-900 hover:text-inherit hover:bg-slate-400' }}">
                    All Posts
                </x-_link>
                <x-_link href="{{ route('posts.status', 'published') }}"
                    class="mb-3 mr-1{{ request()->is('dashboard/posts/published/status') ?: ' bg-slate-300 text-slate-900 hover:text-inherit hover:bg-slate-400' }}">
                    Published
                </x-_link>
                <x-_link href="{{ route('posts.status', 'draft') }}"
                    class="mb-3 mr-1{{ request()->is('dashboard/posts/draft/status') ?: ' bg-slate-300 text-slate-900 hover:text-inherit hover:bg-slate-400' }}">
                    Draft
                </x-_link>
            </div>

            @if ($posts->count())
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td class="flex items-center justify-between">
                            <a href="{{ route('posts.show', $post) }}" class="badge bg-success text-white"> <span data-feather="eye"></span>
                            </a>
                            <a href="{{ route('posts.edit', $post) }}" class="badge bg-warning text-dark"> <span data-feather="edit-3"></span>
                            </a>
                            <form action="{{ route('posts.destroy', $post) }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button type="submit" class="badge bg-danger text-white border-0" onclick="return confirm('Kamu yakin?')"> <span
                                        data-feather="x-circle"></span>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('posts.publish', $post) }}" method="post">
                                @method('put')
                                @csrf
                                <x-_button class="text-center">
                                    {{ $post->status->value == 'draft' ? 'publish' : 'unpublish' }}
                                </x-_button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class=" alert alert-info">Data post kamu belum ada karena kamu belum buat postnya :v
            </div>
            @endif
        </div>
    </main>
</x-dashboard-layout>