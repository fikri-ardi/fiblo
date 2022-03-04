@extends('layouts.main', ['title'=>'Fiblo | Register'])

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-lg-5 col-md-5">
        <main class="form-register">
            <form action="/register" method="POST">
                @csrf
                <h1 class="h3 mb-3 fw-normal text-center">Register</h1>

                <div class="form-floating">
                    <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Name"
                        value="{{ old('name') ?? '' }}" required>
                    <label for="name">Name</label>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username"
                        placeholder="Username" value="{{ old('username') ?? '' }}" required>
                    <label for="username">Username</label>
                    @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="name@example.com" value="{{ old('email') ?? '' }}" required>
                    <label for="email">Alamat E-Mail</label>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password"
                        placeholder="Password" value="{{ old('password') ?? '' }}" required>
                    <label for="password">Password</label>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Ingat aku
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary border-0" type="submit" style="background: rgb(17, 17, 41)">Register</button>
            </form>

            <small class="d-block text-center mt-3">Already register? <a href="/login" class="link">Login</a></small>
        </main>
    </div>
</div>
@endsection