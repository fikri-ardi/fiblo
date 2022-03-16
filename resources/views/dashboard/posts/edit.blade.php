<x-dashboard-layout title="Ubah Post">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Ubah Post</h1>
        </div>

        <div class="col-lg-8">
            <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                @method('put')
                @csrf
                <x-_input name="title" :model="$post" label="Title"></x-_input>
                <x-_input name="slug" :model="$post" label="Slug"></x-_input>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                        <option selected disabled>Pilih Category</option>
                        @forelse ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>{{
                            $category->name }}
                        </option>
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
                    <img src='{{ $post->image ? "/storage/$post->image" : "" }}'
                        class="img-preview img-fluid col-sm-5 rounded-lg{{ $post->image ? ' mb-3' : '' }}">
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
                    <input type="hidden" name="body" id="body" value="{{ old('body', $post->body) }}" required>
                    <trix-editor input="body"></trix-editor>
                </div>

                <div class="flex justify-end">
                    <x-_button>
                        <span class="bi bi-pencil"></span>
                        Ubah Post
                    </x-_button>
                </div>
            </form>
        </div>
    </main>

    <script src="/js/sluggable.js"></script>
    <script src="/js/image-previewer.js"></script>
</x-dashboard-layout>