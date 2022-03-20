<x-app-layout title="Ubah Profil">
    <main class="flex align-items-center flex-col">
        <div class="col-lg-4 mb-5">
            <form action="{{ route('profiles.update', $user) }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="text-center">
                    <h1 class="h2">Edit Profil</h1>
                    <div class="relative flex justify-center">
                        @if (auth()->user()->photo)
                        <img src="{{ auth()->user()->photo }}"
                            class="img-preview rounded-circle w-48 h-48 object-cover mb-3 border-5 border-slate-200" alt="{{ auth()->user()->name }}">
                        @else
                        <span class="bi bi-person bg-red-100 text-red-500 p-14 text-7xl rounded-full d-inline-block mb-3 shadow-md"></span>
                        <div class="absolute w-48 h-48 rounded-full top-1/2 left-1/2 overflow-hidden mb-1" style="transform: translate(-50%, -53%)">
                            <img class="img-preview w-full h-full object-cover" style="display: none">
                        </div>
                        @endif
                        <input type="file" name="photo" id="photo"
                            class="img-input absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-40 h-40" style="opacity: 0"
                            onchange="previewImage()">
                    </div>
                </div>

                <x-_input name="name" :model="$user" label="Name"></x-_input>
                <x-_input name="username" :model="$user" label="Username"></x-_input>
                <x-_input name="email" :model="$user" label="email" type="email"></x-_input>

                <div class="mb-3">
                    <label for="bio" class="form-label">Biography</label>
                    <textarea type="text" class="form-control @error('bio') is-invalid @enderror" id="bio"
                        name="bio">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <x-_button>
                        <x-slot name="icon"> <small class="bi bi-pencil"></small> </x-slot>
                        Ubah
                    </x-_button>
                </div>
            </form>
        </div>
    </main>

    <x-slot name="script">
        <script src="/js/image-previewer.js"></script>
    </x-slot>
</x-app-layout>