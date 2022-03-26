<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @method($method ?? 'post')
    @csrf
    <div class="mb-3">
        <div class="relative w-full h-48 sm:h-96 bg-slate-300 rounded-xl flex items-center justify-center overflow-hidden">
            @if ($post->image)
            <img src="{{ $post->image }}" class="block img-fluid rounded-lg w-full h-full object-cover object-center absolute">
            @endif
            <img class="img-preview img-fluid rounded-lg w-full h-full object-cover object-center absolute">
            <i class="bi bi-camera-fill font-bold text-4xl text-slate-500"></i>
            <input class="absolute h-full w-full opacity-0 form-control img-input @error('image') is-invalid @enderror" type="file" id="image"
                name="image" onchange="previewImage()">
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
        <input type="hidden" name="body" id="body" value="{{ old('body', $post->body) }}" required>
        <trix-editor input="body" placeholder="Tulis cerita kamu..." class="text-lg border-0"></trix-editor>
    </div>

    <input type="hidden" id="slug" name="slug" value="{{ old('slug', isset($post) ? $post->slug : '') }}">

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

    <div class="flex justify-end">
        <x-_button>
            <span class="bi bi-upload mr-1"></span>
            {{ $button ?? 'Tambah' }}
        </x-_button>
    </div>
</form>