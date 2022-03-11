<x-app-layout title="Tentang">
    <h2 class="mb-3 text-center">Halaman Tentang</h2>
    <div class="d-flex align-items-center flex-column">
        @if ($founder->photo)
        <img class="img-thumbnail rounded-circle mb-3" src="/storage/{{ $founder->photo }}" alt="{{ $founder->name }}" width="200">
        @else
        <span class="bi bi-person bg-red-100 text-red-500 p-14 text-7xl rounded-full d-block mb-3"></span>
        @endif
        <h3>{{ $founder->name }}</h3>
        <p class="text-xl font-italic text-center w-72 lh-base"><i>"{{ $founder->bio }}"</i></p>
        <p>{{ $founder->email }}</p>
    </div>
</x-app-layout>