@extends('layouts.main', ['title'=>'Fiblo | Sign in'])

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-lg-5 col-md-5">
        <main class="form-signin">
            @if(session('message'))
            <div class="message w-100 text-center bg-success py-3 px-3 rounded shadow-lg text-white">
                {{ session('message') }}
            </div>
            @endif

            <form>
                <h1 class="h3 mb-3 fw-normal text-center">Please login</h1>

                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                    <label for="email">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    <label for="password">Password</label>
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