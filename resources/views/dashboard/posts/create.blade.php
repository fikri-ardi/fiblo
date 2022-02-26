@extends('dashboard.layouts.main')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Buat Post Baru</h1>
    </div>

    <div class="col-lg-8">
        <form action="/dashboard/posts" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug">
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" name="category_id">
                    <option selected disabled>Pilih Category</option>
                    @forelse ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @empty
                    <option disabled>Maaf, kamu belum punya category :v</option>
                    @endforelse
                </select>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="hidden" name="body" id="body">
                <trix-editor input="body"></trix-editor>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>

<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', ()=>{
        fetch('/dashboard/posts/checkSlug?title='+title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    })

    document.addEventListener('trix-file-accept', (e) => e.preventDefault())
</script>
@endsection