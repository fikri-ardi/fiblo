<nav class="navbar navbar-expand-lg navbar-light p-4 z-50 w-full top-0 backdrop-blur-xl" style="position: fixed">
    <div class="container d-flex justify-content-between">
        <div>
            <a class="text-red-500 text-3xl font-bold hover:text-red-500" href="/">
                <i class="bi bi-cursor mr-1"></i> Fiblo
            </a>
        </div>

        <div class="collapse navbar-collapse flex-grow-0" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item px-3">
                    <a class="nav-link{{ request()->is('/') ? ' active' : '' }}" aria-current="page" href="/">Beranda</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link{{ request()->is('posts*') && request()->segment(2) != 'categories' ? ' active' : '' }}" href="/posts">Blog</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link{{ request()->is('posts/categories') ? ' active' : '' }}" href="/posts/categories"> Kategori</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link{{ request()->is('about') ? ' active' : '' }}" href="/about">Tentang</a>
                </li>
            </ul>
        </div>

        {{-- Right Nav --}}
        <ul class="navbar-nav">
            @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (auth()->user()->photo)
                    <img src="/storage/{{ auth()->user()->photo }}" class="img-preview rounded-circle w-7 h-7 object-cover d-inline-block"
                        alt="{{ auth()->user()->name }}">
                    @else
                    <span class="bg-red-100 text-red-500 font-bold text-lg h-10 w-10 text-center d-inline-block rounded-full"
                        style="line-height: 40px">
                        <span>{{ strtoupper(substr(auth()->user()->username, 0, 1)) }}</span>
                    </span>
                    @endif
                    <i class="bi bi-chevron-down"></i>
                </a>

                <ul class="dropdown-menu border-0 shadow-lg" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="/profiles">
                            <i class="bi bi-person text-lg mr-2"></i> Profil
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="/dashboard">
                            <i class="bi bi-layout-text-sidebar-reverse mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button class="dropdown-item" type="submit">
                                <i class="bi bi-box-arrow-left mr-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            @else
            <li class="nav-item">
                <a href="/login" class="nav-link{{ request()->segment(1) == 'login' ? ' active' : '' }}">
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
            <a style="color: black" class="text-center nav-link{{ request()->is('/') ? ' active' : '' }}" aria-current="page" href="/">
                <span class="py-1 px-2 bi bi-house-door text-xl"></span>
                <small class="d-block text-xs mt-1">Beranda</small>
            </a>
        </li>
        <li class="nav-item px-3">
            <a style="color: black" class="text-center nav-link{{ request()->is('posts') ? ' active' : '' }}" href="/posts">
                <span class="py-1 px-2 bi bi-journal-text text-xl"></span>
                <small class="d-block text-xs mt-1">Blog</small>
            </a>
        </li>
        <li class="nav-item px-3">
            <a style="color: black" class="nav-link{{ request()->is('posts/categories') ? ' active' : '' }}" href="/posts/categories">
                <span class="py-1 px-2 bi bi-grid text-xl"></span>
                <small class="d-block text-xs mt-1">Kategori</small>
            </a>
        </li>
        <li class="nav-item px-3">
            <a style="color: black" class="nav-link{{ request()->is('about') ? ' active' : '' }}" href="/about">
                <span class="py-1 px-2 bi bi-info-circle text-xl"></span>
                <small class="d-block text-xs mt-1">Tentang</small>
            </a>
        </li>
    </ul>
</div>

<script src="/js/navbar.js"></script>