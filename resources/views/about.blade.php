<x-layouts.main>
    <h2 class="mb-3 text-center">Halaman Tentang</h2>
    <div class="d-flex align-items-center flex-column">
        <img class="img-thumbnail rounded-circle mb-3" src="images/{{ $image }}.jpg" alt="{{ $name }}" width="200">
        <h3>{{ $name }}</h3>
        <p class="text-xl font-italic text-center w-72 lh-base"><i>"{{ $bio }}"</i></p>
        <p>{{ $email }}</p>
    </div>
</x-layouts.main>