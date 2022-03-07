<x-app-layout title="Profil">
    <div class="flex justify-content-center">
        <h2 class="mb-4 text-center mr-2">Profil Ku</h2>
        <a href="{{ route('profiles.edit', $user->username) }}"
            class="bi bi-pencil bg-red-100 text-red-500 h-8 w-8 rounded-full flex justify-content-center align-items-center"></a>
    </div>
    <div class="d-flex align-items-center flex-column">
        @if ($user->photo)
        <img src="/storage/{{ $user->photo }}" class="rounded-circle w-48 h-48 object-cover mb-3 border-5 border-slate-200" alt="{{ $user->name }}">
        @else
        <span class="bi bi-person bg-red-100 text-red-500 p-14 text-7xl rounded-full d-block mb-3"></span>
        @endif
        <h3>{{ $user->username }}</h3>
        <p class="text-xl font-italic text-center w-72"><i>"{{ $user->bio }}"</i></p>
        <p>{{ $user->email }}</p>
        <div class="bg-red-100 py-2 px-3 rounded-2xl">Seorang : <b>{{ $user->role->name }}</b></div>
    </div>
</x-app-layout>