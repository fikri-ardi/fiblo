@extends('layouts.main', ["title" => "Fiblo | About"])

@section('content')
<h2 class="mb-5 text-center">Halaman About</h2>
<div class="d-flex align-items-center flex-column">
    <img class="img-thumbnail rounded-circle" src="images/{{ $image }}.jpg" alt="{{ $name }}" width="200">
    <h3>{{ $name }}</h3>
    <p>{{ $email }}</p>
</div>
@endsection