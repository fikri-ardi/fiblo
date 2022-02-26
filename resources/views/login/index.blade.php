@extends('layouts.main', ['title'=>'Fiblo | Sign in'])

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-lg-5 col-md-5">
        <main class="form-signin">
            @if(session('message'))
            <div class="message w-100 text-center alert-{{ session('type') }} text-{{ session('type') }} py-3 px-3 rounded shadow-lg mb-4">
                {{ session('message') }}
            </div>
            @endif

            <form action="/login" method="POST">
                @csrf
                <h1 class="h3 mb-3 fw-normal text-center">Please login</h1>

                <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                    <label for="email">Email address</label>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        placeholder="Password" required>
                    <label for="password">Password</label>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary border-0" type="submit" style="background: rgb(17, 17, 41)">Login</button>
            </form>

            <small class="d-block text-center mt-3">Not Registered yet? <a href="/register" class="link">Register</a></small>
        </main>
    </div>
</div>
@endsection