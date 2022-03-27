<x-app-layout title="Ubah Profil">
    <main class="flex align-items-center flex-col">
        <div class="w-full sm:w-1/3 mb-5">
            <form action="{{ route('profiles.update', $user) }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="text-center">
                    <h1 class="h2">Edit Profil</h1>
                    <div class="relative flex justify-center">
                        <div class="relative w-36 h-36 mb-3 rounded-full overflow-hidden">
                            <img class="img-preview absolute w-full h-full object-cover" style="display: none">
                            <x-_photo :user="$user" class="text-5xl"></x-_photo>
                            <div
                                class="absolute bottom-0 left-0 right-0 h-7 font-semibold text-sm bg-black bg-opacity-50 backdrop-blur-lg text-white flex items-center justify-center">
                                Ubah
                            </div>
                        </div>
                        <input type="file" name="photo" id="photo"
                            class="img-input absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-40 h-40 cursor-pointer" style="opacity: 0"
                            onchange="previewImage()">
                    </div>
                </div>

                <x-_input name="name" :model="$user" label="Name"></x-_input>
                <x-_input name="username" :model="$user" label="Username"></x-_input>
                <x-_input name="email" :model="$user" label="email" type="email"></x-_input>

                <div class="mb-3">
                    <label for="bio" class="form-label mt-4">Biografi</label>
                    <textarea type="text" class="form-control @error('bio') is-invalid @enderror" id="bio"
                        name="bio">{{ old('bio', $user->bio) }}</textarea>
                    @error('bio')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <label for="bio" class="form-label">Link</label>
                <x-_input name="instagram" :model="$links" label="Username Instagram kamu"></x-_input>
                <x-_input name="twitter" :model="$links" label="Username Twitter kamu"></x-_input>
                <x-_input name="facebook" :model="$links" label="Username Facebook kamu"></x-_input>

                <div class="flex justify-end mt-3">
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