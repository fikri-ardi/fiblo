<x-app-layout title="Masuk">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-4 col-md-4">
            <main class="form-signin">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal text-center">Masuk</h1>

                    <x-_input name="email" type="email" :model="$user" label="E-Mail" required></x-_input>
                    <x-_input name="password" type="password" :model="$user" label="Password" required></x-_input>
                    <input type="checkbox" name="remember" id="remember"> Ingat aku

                    <div class="flex justify-end">
                        <x-_button>
                            <i class="bi bi-box-arrow-in-right mr-1"></i>
                            Masuk
                        </x-_button>
                    </div>

                    <small class="d-block text-center mt-3">Belum punya akun? <a href="{{ route('register') }}" class="link">Buat akun</a></small>
                </form>
            </main>
        </div>
    </div>
</x-app-layout>