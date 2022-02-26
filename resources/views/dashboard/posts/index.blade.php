@extends('dashboard.layouts.main', ['title'=>'Fiblo | Dashboard'])

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">All Posts</h1>
    </div>

    <div class="table-responsive">
        <a href="/dashboard/posts/create" class="btn btn-primary mb-3"><span data-feather="plus"></span> Buat Post</a>

        @if ($posts->count())
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>
                        <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-success text-white"> <span data-feather="eye"></span>
                        </a>
                        <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning text-dark"> <span data-feather="edit-3"></span>
                        </a>
                        <form action="/dashboard/posts/{{ $post->slug }}" method="delete" class="d-inline">
                            @csrf
                            <button type="submit" class="badge bg-danger text-white border-0"> <span data-feather="x-circle"></span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert alert-info">Data post kamu belum ada karena kamu belum buat postnya :v</div>
        @endif
    </div>
</main>
@endsection