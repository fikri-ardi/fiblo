<nav class="navbar navbar-expand-lg navbar-light bg-white bg-opacity-50 p-4 z-50 w-full top-0 backdrop-blur-xl">
    <div class="container flex justify-content-between">
        <div>
            <a class="flex items-center text-red-500 text-3xl font-bold hover:text-red-500" href="/">
                <i class="bi bi-cursor mr-1"></i> Fiblo
            </a>
        </div>

        <div class="collapse navbar-collapse flex-grow-0" id="navbarNav">
            <ul class="navbar-nav">
                @foreach ($links as $name => $value)
                <li class="nav-item px-3">
                    <a class="nav-link{{ request()->is($value['active']) ? ' active' : '' }}" href="{{ $value['route'] }}">{{ $name }}</a>
                </li>
                @endforeach
            </ul>
        </div>

        {{-- Right Nav --}}
        <ul x-data="{ open: false }" class="navbar-nav">
            @auth
            <li class="nav-item relative">
                {{-- Nav Toggler --}}
                <div class="flex items-center cursor-pointer" @click="open = ! open">
                    <x-_photo :user="auth()->user()" size="sm"></x-_photo>
                    <i class="bi bi-chevron-down"></i>

                    <ul x-show="open" @click.away="open = false" x-transition
                        class="absolute shadow-lg rounded-xl right-0 top-14 overflow-hidden z-50 bg-white">
                        <x-_list-link :href="route('profiles.show', auth()->user())">
                            <i class="bi bi-person text-lg mr-2"></i> Profil
                        </x-_list-link>
                        <x-_list-link :href="route('dashboard.index', auth()->user())">
                            <i class="bi bi-layout-text-sidebar-reverse mr-2"></i> Dashboard
                        </x-_list-link>

                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="flex items-center px-3 py-2 hover:bg-slate-300 hover:text-slate-900 w-full" type="submit">
                                    <i class="bi bi-box-arrow-left mr-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
            @else
            <li class="nav-item">
                <a href="{{ route('login') }}"
                    class="flex items-center hover:text-slate-500 transition{{ request()->segment(1) == 'login' ? ' active' : '' }}">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
            </li>
            @endauth
        </ul>
    </div>
</nav>

{{-- Mobile nav --}}
<div id="mobile-nav" class="fixed bottom-0 w-full z-50 backdrop-blur-lg shadow-md" style="background: #ffffff90">
    <ul class="navbar-nav d-flex flex-row justify-content-center">
        @foreach ($links as $name => $value)
        <li class="nav-item px-3">
            <a style="color: black" class="text-center nav-link{{ request()->is($value['active']) ? ' active' : '' }}" href="{{ $value['route'] }}">
                <span class="{{ $value['icon'] }} py-1 px-2 text-xl"></span>
                <small class="d-block text-xs mt-1">{{ $name }}</small>
            </a>
        </li>
        @endforeach
    </ul>
</div>

<script src="/js/navbar.js"></script>