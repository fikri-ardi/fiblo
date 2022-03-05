<x-dashboard.layouts.main>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Buat Post Baru</h1>
        </div>

        <div class="col-lg-8 mb-5">
            <form action="/dashboard/posts" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}"
                        required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}"
                        required>
                    @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                        <option selected disabled>Pilih Category</option>
                        @forelse ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }}>{{ $category->name }}</option>
                        @empty
                        <option disabled>Maaf, kamu belum punya category :v</option>
                        @endforelse
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Banner</label>
                    <img class="img-preview img-fluid col-sm-5 rounded-lg">
                    <input class="form-control img-input @error('image') is-invalid @enderror" type="file" id="image" name="image"
                        onchange="previewImage()">
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Body</label>
                    @error('body')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input type="hidden" name="body" id="body" value="{{ old('body') }}" required>
                    <trix-editor input="body"></trix-editor>
                </div>

                <button type="submit" class="btn btn-primary">Buat post</button>
            </form>
        </div>
    </main>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');
    
        title.addEventListener('change', () => {
            fetch('/dashboard/posts/checkSlug?title='+title.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
        })
    
        document.addEventListener('trix-file-accept', (e) => e.preventDefault())
    </script>
</x-dashboard.layouts.main>