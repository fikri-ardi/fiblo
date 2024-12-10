<div>
    <main class="flex align-items-center flex-col">
        <div class="w-full sm:w-1/3 mb-5">
            <form wire:submit="update" method="POST" enctype="multipart/form-data">
                <div class="text-center">
                    <h1 class="h2">Edit Profil</h1>

                    {{-- Photo --}}
                    <div class="relative flex justify-center mt-4 mb-11">
                        {{-- Temporary Photo Preview --}}
                        <div class="relative w-36 h-36 rounded-full overflow-hidden">
                            {{-- Jika user sudah upload foto baru, maka tampilkan --}}
                            @if ($form->photo instanceof Livewire\Features\SupportFileUploads\TemporaryUploadedFile )
                                @if ($form->photo->getClientOriginalExtension() == "png" || "jpg")
                                    <img src="{{ $form->photo->temporaryUrl() }}" class="absolute w-full h-full object-cover">
                                @endif
                            @endif
                            <x-_photo :user="$user" class="text-5xl"></x-_photo>
                            <div
                                class="absolute bottom-0 left-0 right-0 h-7 font-semibold text-sm bg-black bg-opacity-50 backdrop-blur-lg text-white flex items-center justify-center">
                                Ubah
                            </div>
                        </div>

                        {{-- File input --}}
                        <input wire:model.live="form.photo" type="file" name="form.photo" id="form.photo"
                            class="img-input absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-40 h-40 cursor-pointer" style="opacity: 0" />
                        @error('form.photo')
                        <div class="absolute top-full text-red-400 bg-red-100 text-sm font-semibold inline-block px-2 py-1 rounded-xl my-1">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                
                {{-- Nama --}}
                <div class="form-floating">
                    <input wire:model.blur="form.name" class="-mb-1 form-control" type="text" id="form.name" name="form.name"
                        placeholder="Nama" autofocus>
                    <label for="form.name" class="form-label">Nama</label>
                    @error('form.name')
                    <div class="text-red-400 bg-red-100 text-sm font-semibold inline-block px-2 py-1 rounded-xl my-1">{{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Username --}}
                <div class="form-floating">
                    <input wire:model.blur="form.username" class="-mb-1 form-control" type="text" id="form.username" name="form.username"
                        placeholder="Username" autofocus>
                    <label for="form.username" class="form-label">Username</label>
                    @error('form.username')
                    <div class="text-red-400 bg-red-100 text-sm font-semibold inline-block px-2 py-1 rounded-xl my-1">{{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- E-Mail --}}
                <div class="form-floating">
                    <input wire:model.blur="form.email" class="-mb-1 form-control" type="text" id="form.email" name="form.email"
                        placeholder="E-Mail" autofocus>
                    <label for="form.email" class="form-label">E-Mail</label>
                    @error('form.email')
                    <div class="text-red-400 bg-red-100 text-sm font-semibold inline-block px-2 py-1 rounded-xl my-1">{{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Biografi --}}
                <div class="mb-3">
                    <label for="bio" class="form-label mt-4">Biografi</label>
                    <textarea wire:model.blur="form.bio" rows="4" class="form-control @error('form.bio') is-invalid @enderror" id="form.bio"
                        name="form.bio"></textarea>
                    @error('form.bio')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
    
                <label for="link" class="form-label">Link</label>
                {{-- Instagram --}}
                <div class="form-floating">
                    <input wire:model.blur="form.instagram" class="-mb-1 form-control" type="text" id="form.instagram" name="form.instagram" placeholder="E-Mail" autofocus>
                    <label for="form.instagram" class="form-label">Username Instagram kamu</label>
                    @error('form.instagram')
                    <div class="text-red-400 bg-red-100 text-sm font-semibold inline-block px-2 py-1 rounded-xl my-1">{{ $message }}
                    </div>
                    @enderror
                </div>
                
                {{-- Twitter --}}
                <div class="form-floating">
                    <input wire:model.blur="form.twitter" class="-mb-1 form-control" type="text" id="form.twitter" name="form.twitter" placeholder="E-Mail" autofocus>
                    <label for="form.twitter" class="form-label">Username Twitter kamu</label>
                    @error('form.twitter')
                    <div class="text-red-400 bg-red-100 text-sm font-semibold inline-block px-2 py-1 rounded-xl my-1">{{ $message }}
                    </div>
                    @enderror
                </div>
                
                {{-- Facebook --}}
                <div class="form-floating">
                    <input wire:model.blur="form.facebook" class="-mb-1 form-control" type="text" id="form.facebook" name="form.facebook" placeholder="E-Mail" autofocus>
                    <label for="form.facebook" class="form-label">Username Facebook kamu</label>
                    @error('form.facebook')
                    <div class="text-red-400 bg-red-100 text-sm font-semibold inline-block px-2 py-1 rounded-xl my-1">{{ $message }}
                    </div>
                    @enderror
                </div>
    
                <div class="flex justify-end mt-3">
                    <x-_button>
                        <x-slot name="icon"> <small class="bi bi-pencil"></small> </x-slot>
                        Perbarui
                    </x-_button>
                </div>
            </form>
        </div>
    </main>
</div>
