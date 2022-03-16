<x-app-layout>
    <div class="flex justify-center items-center flex-col">
        <i class="bi bi-shield-lock mb-2 text-3xl text-red-500"></i>
        <div class="text-2xl font-semibold mb-2">Ubah Password</div>

        <form action="{{ route('password.update') }}" method="post">
            @method('put')
            @csrf
            <x-_input name="current_password" type="password" label="Password saat ini">Current Password</x-_input>
            <x-_input name="password" type="password" label="Password Baru">New Password</x-_input>
            <x-_input name="password_confirmation" type="password" label="Konfirmasi Password">Confirm Password</x-_input>

            <div class="flex justify-end mt-3">
                <x-_button>
                    Ubah Password
                </x-_button>
            </div>
        </form>
    </div>
</x-app-layout>