<x-dashboard-layout title="Buat Post Baru">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Buat Post Baru</h1>
        </div>

        <div class="col-lg-8 mb-5">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <div class="relative w-full h-48 sm:h-96 bg-slate-300 rounded-xl flex items-center justify-center overflow-hidden">
                        <img class="img-preview img-fluid rounded-lg w-full h-full object-cover object-center absolute">
                        <i class="bi bi-camera-fill font-bold text-4xl text-slate-500"></i>
                        <input class="absolute h-full w-full opacity-0 form-control img-input @error('image') is-invalid @enderror" type="file"
                            id="image" name="image" onchange="previewImage()">
                        <div
                            class="absolute bottom-0 left-0 right-0 h-10 bg-black bg-opacity-50 flex items-center justify-center font-semibold text-white backdrop-blur-xl pointer-events-none">
                            Ubah
                        </div>
                    </div>
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input type="text" id="title" name="title" value="{{ old('title', isset($post) ? $post->title : '') }}" placeholder="Judul"
                        class="text-2xl sm:text-3xl border-0 w-full focus:ring-0" autofocus>
                </div>

                <div class="mb-3" style="min-height: 500px;">
                    @error('body')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input type="hidden" name="body" id="body" value="{{ old('body') }}" required>
                    <trix-editor input="body" placeholder="Tulis cerita kamu..." class="text-lg border-0"></trix-editor>
                </div>

                <input type="hidden" id="slug" name="slug" value="{{ old('slug', isset($post) ? $post->slug : '') }}">

                <div class="mb-3">
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

                <div class="flex justify-end">
                    <x-_button>
                        <span class="bi bi-upload"></span>
                        Buat Post
                    </x-_button>
                </div>
            </form>
        </div>
    </main>

    <script src="/js/sluggable.js"></script>
    <script src="/js/image-previewer.js"></script>
</x-dashboard-layout>