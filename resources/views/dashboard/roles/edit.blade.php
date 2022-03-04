@extends('dashboard.layouts.main', ['title' => 'Fiblo | Ubah Role - Dashboard'])

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ubah Role</h1>
    </div>

    <div class="col-lg-8 mb-5">
        <form action="/dashboard/roles/{{ $role->slug }}" method="POST">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Role Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $role->name) }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Edit Role</button>
        </form>
    </div>
</main>
@endsection