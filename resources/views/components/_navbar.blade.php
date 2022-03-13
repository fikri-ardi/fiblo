<nav class="navbar navbar-expand-lg navbar-light bg-white bg-opacity-50 p-4 z-50 w-full top-0 backdrop-blur-xl">
    <div class="container d-flex justify-content-between">
        <div>
            <a class="text-red-500 text-3xl font-bold hover:text-red-500" href="/">
                <i class="bi bi-cursor mr-1"></i> Fiblo
            </a>
        </div>

        <div class="collapse navbar-collapse flex-grow-0" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item px-3">
                    <a class="nav-link{{ request()->is('/') ? ' active' : '' }}" aria-current="page" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link{{ request()->is('posts*') && request()->segment(2) != 'categories' ? ' active' : '' }}"
                        href="{{ route('posts') }}">Blog</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link{{ request()->is('posts/categories') ? ' active' : '' }}" href="{{ route('categories') }}"> Kategori</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link{{ request()->is('about') ? ' active' : '' }}" href="{{ route('about') }}">Tentang</a>
                </li>
            </ul>
        </div>

        {{-- Right Nav --}}
        <ul x-data="{ open: false }" class="navbar-nav">
            @auth
            <li class="nav-item relative">
                <div class="cursor-pointer" @click="open = ! open">
                    @if (auth()->user()->photo)
                    <img src="/storage/{{ auth()->user()->photo }}" class="rounded-circle w-7 h-7 object-cover d-inline-block"
                        alt="{{ auth()->user()->name }}">
                    @else
                    <span class="bg-red-100 text-red-500 font-bold text-lg h-10 w-10 text-center d-inline-block rounded-full"
                        style="line-height: 40px">
                        <span>{{ strtoupper(substr(auth()->user()->username, 0, 1)) }}</span>
                    </span>
                    @endif
                    <i class="bi bi-chevron-down"></i>

                    <ul x-show="open" x-transition class="absolute shadow-lg rounded-xl right-0 top-14 overflow-hidden z-50 bg-white">
                        <li>
                            <a class="dropdown-item pl-1 pr-3 py-2" href="{{ route('profiles.show', auth()->user()) }}">
                                <i class="bi bi-person text-lg mr-2"></i> Profil
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item pl-1 pr-3 py-2" href="{{ route('dashboard.index') }}">
                                <i class="bi bi-layout-text-sidebar-reverse mr-2"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="dropdown-item pl-1 pr-3 py-2" type="submit">
                                    <i class="bi bi-box-arrow-left mr-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
            </li>
            @else
            <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link{{ request()->segment(1) == 'login' ? ' active' : '' }}">
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
        <li class="nav-item px-3">
            <a style="color: black" class="text-center nav-link{{ request()->is('/') ? ' active' : '' }}" aria-current="page"
                href="{{ route('home') }}">
                <span class="py-1 px-2 bi bi-house-door text-xl"></span>
                <small class="d-block text-xs mt-1">Beranda</small>
            </a>
        </li>
        <li class="nav-item px-3">
            <a style="color: black" class="text-center nav-link{{ request()->is('posts') ? ' active' : '' }}" href="{{ route('posts') }}">
                <span class="py-1 px-2 bi bi-journal-text text-xl"></span>
                <small class="d-block text-xs mt-1">Blog</small>
            </a>
        </li>
        <li class="nav-item px-3">
            <a style="color: black" class="nav-link{{ request()->is('posts/categories') ? ' active' : '' }}" href="{{ route('categories') }}">
                <span class="py-1 px-2 bi bi-grid text-xl"></span>
                <small class="d-block text-xs mt-1">Kategori</small>
            </a>
        </li>
        <li class="nav-item px-3">
            <a style="color: black" class="nav-link{{ request()->is('about') ? ' active' : '' }}" href="{{ route('about') }}">
                <span class="py-1 px-2 bi bi-info-circle text-xl"></span>
                <small class="d-block text-xs mt-1">Tentang</small>
            </a>
        </li>
    </ul>
</div>

<script src="/js/navbar.js"></script>