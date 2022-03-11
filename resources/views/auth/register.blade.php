<x-app-layout title="Register">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-4 col-md-4">
            <main class="form-register">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <h1 class="h3 mb-3 fw-normal text-center">Register</h1>

                    <x-_input name="name" :model="$user" label="Name"></x-_input>
                    <x-_input name="username" :model="$user" label="Username"></x-_input>
                    <x-_input name="email" :model="$user" label="E-Mail" type="email"></x-_input>
                    <x-_input name="password" :model="$user" label="password" type="Password"></x-_input>

                    <div class="flex justify-end">
                        <x-_button>Register</x-_button>
                    </div>
                </form>

                <small class="d-block text-center mt-3">Udah punya akun? <a href="/login" class="link">Login</a></small>
            </main>
        </div>
    </div>
</x-app-layout>