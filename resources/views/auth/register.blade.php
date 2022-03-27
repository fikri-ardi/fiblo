<x-app-layout title="Daftar">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-4 col-md-4">
            <main class="form-register">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal text-center">Daftar</h1>

                    <x-_input name="name" :model="$user" label="Name" required></x-_input>
                    <x-_input name="username" :model="$user" label="Username" required></x-_input>
                    <x-_input name="email" :model="$user" label="E-Mail" type="email" required></x-_input>
                    <x-_input name="password" :model="$user" label="Password" type="Password" required></x-_input>

                    <div class="flex justify-end mt-3">
                        <x-_button>
                            <i class="bi bi-send-plus mr-1"></i>
                            Daftar
                        </x-_button>
                    </div>
                </form>

                <small class="d-block text-center mt-3">Udah punya akun? <a href="{{ route('login') }}" class="link">Masuk</a></small>
            </main>
        </div>
    </div>
</x-app-layout>