<x-dashboard-layout title="Ubah User">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Ubah User</h1>
        </div>

        <div class="col-lg-8 mb-5">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @method('put')
                @csrf
                <x-_input name="name" :model="$user" label="Name"></x-_input>
                <x-_input name="username" :model="$user" label="Username"></x-_input>
                <x-_input name="email" :model="$user" label="E-mail" type="email"></x-_input>

                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select @error('role_id') is-invalid @enderror" name="role_id">
                        <option selected disabled>Pilih Role</option>
                        @forelse ($roles as $role)
                        <option value="{{ $role->id }}" {{ $role->id == old('role_id', $user->role_id) ? 'selected' : '' }}>{{ $role->name }}</option>
                        @empty
                        <option disabled>Maaf, kamu belum punya role :v</option>
                        @endforelse
                    </select>
                    @error('role_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <x-_button>
                        <span class="bi bi-pencil"></span>
                        Ubah User
                    </x-_button>
                </div>
            </form>
        </div>
    </main>
</x-dashboard-layout>