<form wire:submit="store" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        {{-- Banner --}}
        <div
            class="relative w-full h-48 sm:h-96 bg-slate-200 active:bg-slate-300 transition rounded-xl flex items-center justify-center overflow-hidden">
            @if (isset($post) && $post->image)
            <img src="{{ $post->image }}" class="block img-fluid rounded-lg w-full h-full object-cover object-center absolute">
            @endif
            @if ($form->image instanceof Livewire\Features\SupportFileUploads\TemporaryUploadedFile )
            @if ($form->image->getClientOriginalExtension() == "png" || "jpg")
            <img src="{{ $form->image->temporaryUrl() }}" class="img-fluid rounded-lg w-full h-full object-cover object-center absolute">
            @endif
            @endif
            <i class="bi bi-camera-fill font-bold text-4xl text-slate-500"></i>
            <input wire:model.live="form.image" class="absolute h-full w-full opacity-0 form-control img-input @error('form.image') is-invalid @enderror" type="file" id="form.image"
                name="form.image">
            <div
                class="absolute bottom-0 left-0 right-0 h-10 bg-black bg-opacity-50 flex items-center justify-center font-semibold text-white backdrop-blur-xl pointer-events-none">
                Ubah
            </div>
        </div>
        <x-_error name="form.image"></x-_error>
    </div>

    {{-- Title --}}
    <div class="mb-3">
        <input wire:model.blur="form.title" type="text" id="form.title" name="form.title" placeholder="Judul"
            class="bg-inherit text-2xl sm:text-4xl border-0 w-full focus:ring-0 font-semibold" autofocus>
        <x-_error name="form.title"></x-_error>
    </div>

    {{-- Body --}}
    <div wire:ignore class="mb-3" style="min-height: 500px;">
        <input type="hidden" name="form.body" id="form.body" required>
        <trix-editor 
        class="text-xl border-0 text-slate-800 outline-none"
        input="form.body"
        x-data
        x-on:trix-change="$dispatch('input', event.target.value)"
        x-ref="trix"
        wire:model.blur="form.body"
        wire:key="uniqueKey"
        placeholder="Tulis cerita kamu..." 
        >
        </trix-editor>
        <x-_error name="form.body"></x-_error>
    </div>

    {{-- Category --}}
    <div class="mb-3">
        <label for="category" class="form-label">Topik</label>
        <select wire:model.blur="form.category_id" class="form-select @error('form.category_id') is-invalid @enderror" name="form.category_id">
            <option selected disabled>Pilih Topik</option>
            @forelse ($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == old('category_id', isset($post) ? $post->category_id : null) ? 'selected' : ''
                }}>{{
                $category->name }}
            </option>
            @empty
            <option disabled>Kamu belum punya category ☹️</option>
            @endforelse
        </select>
        <x-_error name="form.category_id"></x-_error>
    </div>

    {{-- Slug --}}
    <div class="form-floating">
        <input wire:model.blur="form.slug" class="-mb-1 form-control" type="text" id="form.slug" name="form.slug" placeholder="Slug" autofocus>
        <label for="form.slug" class="form-label">Slug</label>
        @error('form.slug')
        <div class="text-red-400 bg-red-100 text-sm font-semibold inline-block px-2 py-1 rounded-xl my-1">{{ $message }}
        </div>
        @enderror
    </div>

    {{-- Publish button --}}
    <div class="flex justify-end">
        <x-_button>
            <span class="bi bi-upload mr-1"></span>
            {{ $button ?? 'Tambah' }}
        </x-_button>
    </div>
</form>
