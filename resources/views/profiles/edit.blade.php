<x-app-layout>
    <main class="flex align-items-center flex-col">
        <div class="col-lg-4 mb-5">
            <form action="/profiles/{{ $user->slug }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="text-center">
                    <h1 class="h2">Edit Profil</h1>
                    <div class="relative flex justify-center">
                        @if ($user->photo)
                        <img src="/storage/{{ $user->photo }}"
                            class="img-preview rounded-circle w-48 h-48 object-cover mb-3 border-5 border-slate-200" alt="{{ $user->name }}">
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

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name', $user->name) }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                        value="{{ old('username', $user->username) }}" required>
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="bio" class="form-label">Biography</label>
                    <textarea type="text" class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio"
                        required> {{ old('bio', $user->bio) }}</textarea>
                    @error('bio')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end"><button type="submit" class="bg-slate-900 px-3 py-2 rounded-lg text-white cursor-pointer">Ubah</button>
                </div>
            </form>
        </div>
    </main>
</x-app-layout>