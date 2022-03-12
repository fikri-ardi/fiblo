<x-app-layout title="Profil">
    {{-- Header --}}
    <div class="flex justify-content-center">
        <h2 class="mb-4 text-center mr-2">Profil Ku</h2>
        <a href="{{ route('profiles.edit', $user) }}"
            class="bi bi-pencil bg-red-100 text-red-500 h-8 w-8 rounded-full flex justify-content-center align-items-center"></a>
    </div>

    {{-- Content --}}
    <div class="d-flex align-items-center flex-column">
        {{-- User Photo --}}
        @if ($user->photo)
        <img src="/storage/{{ $user->photo }}" class="rounded-circle w-36 h-36 object-cover mb-3 border-5 border-slate-200" alt="{{ $user->name }}">
        @else
        <span class="bi bi-person bg-red-100 text-red-500 p-9 text-7xl rounded-full d-block mb-3"></span>
        @endif

        {{-- Profile Info --}}
        <div class="flex item-center mb-3">
            <small class="w-20 text-center cursor-pointer hover:bg-gray-200 transition ease-out">
                <div class="font-semibold text-lg">16</div>
                Post
            </small>
            <small class="w-20 text-center cursor-pointer hover:bg-gray-200 transition ease-out">
                <div class="font-semibold text-lg">136k</div>
                Follower
            </small>
            <small class="following w-20 text-center cursor-pointer hover:bg-gray-200 transition ease-out" onclick="show()">
                <div class="font-semibold text-lg">{{ $user->follows->count() }}</div>
                Following
            </small>
        </div>

        <h4>{{ $user->username }}</h4>
        <p class="text-base font-italic text-center w-72"><i>"{{ $user->bio ?? 'Bio kamu masih kosong' }}"</i></p>
    </div>

    {{-- Hidden Following Elements --}}
    <div class="bg-following fixed w-full h-full bg-black bg-opacity-50 top-0 left-0 z-50 backdrop-blur-md transition pointer-events-none"
        onclick="hide()" style="opacity: 0">
        <div class="absolute rounded-xl shadow-lg h-96 w-56 py-3 overflow-y-scroll bg-white top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2">
            <div class="font-bold text-lg mb-3 bg-white w-full text-center">
                Following
            </div>
            <div class="pl-5">
                @foreach ($user->follows as $following)
                <div class="my-2 flex justify-center-center">
                    {{-- Photo or Avatar --}}
                    @if ($following->photo)
                    <img src="/storage/{{ $following->photo }}" class="rounded-circle w-7 h-7 object-cover d-inline-block"
                        alt="{{ $following->name }}">
                    @else
                    <span class="bg-red-100 text-red-500 font-bold text-base h-7 w-7 text-center flex item-center justify-center rounded-full">
                        <span>{{ strtoupper(substr($following->username, 0, 1)) }}</span>
                    </span>
                    @endif
                    {{-- Username --}}
                    <span class="ml-2"> {{ $following->username }} </sp>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function hide() {
            const bgFollowing = document.querySelector('.bg-following');
            bgFollowing.style.opacity = '0';
            bgFollowing.style.pointerEvents = 'none' ;
        }
        
        function show() {
            const bgFollowing = document.querySelector('.bg-following');
            bgFollowing.style.opacity = '1';
            bgFollowing.style.pointerEvents = 'all' ;
            console.log('ok');
        }
    </script>
</x-app-layout>