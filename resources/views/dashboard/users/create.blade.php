<x-dashboard-layout title="Tambah User Baru">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Tambah User Baru</h1>
        </div>

        <div class="col-lg-8 mb-5">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <x-_input name="name" label="Name"></x-_input>
                <x-_input name="username" label="Username"></x-_input>
                <x-_input name="email" label="E-mail" type="email"></x-_input>

                <div class="mb-3">
                    <select class="form-select @error('role_id') is-invalid @enderror" name="role_id">
                        <option selected disabled>Pilih Role</option>
                        @forelse ($roles as $role)
                        <option value="{{ $role->id }}" {{ $role->id == old('role_id') ? 'selected' : '' }}>{{ $role->name }}</option>
                        @empty
                        <option disabled>Maaf, kamu belum punya role :v</option>
                        @endforelse
                    </select>
                    @error('role_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <x-_button>Tambah User</x-_button>
            </form>
        </div>
    </main>
</x-dashboard-layout>