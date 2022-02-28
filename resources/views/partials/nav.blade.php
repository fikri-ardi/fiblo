<nav class="navbar navbar-expand-lg navbar-light p-4 z-50 w-full top-0 bg-blur" style="position: fixed">
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
                    <a class="nav-link{{ request()->is('posts') ? ' active' : '' }}" href="/posts">Blog</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link{{ request()->is('posts/categories')  ? ' active' : '' }}" href="/posts/categories"> Kategori</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link{{ request()->is('about') ? ' active' : '' }}" href="/about">Tentang</a>
                </li>
            </ul>
        </div>

        <ul class="navbar-nav">
            @auth
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person text-2xl text-red-500"></i>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <ul class="dropdown-menu border-0 shadow-lg" aria-labelledby="navbarDropdown" style="left: -100px">
                    <li><a class="dropdown-item" href="/dashboard">
                            <i class="bi bi-layout-text-sidebar-reverse mr-2"></i> Dashboard
                        </a></li>
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

<div id="mobile-nav" class="fixed bottom-0 w-full z-50 backdrop-blur-lg shadow-lg" style="background: #ffffff90">
    <ul class="navbar-nav d-flex flex-row justify-content-center">
        <li class="nav-item px-3">
            <a style="color: black" class="nav-link" aria-current="page" href="/">
                <span class="bi bi-house-door text-2xl{{ request()->is('/') ? ' text-red-500' : '' }}"></span>
            </a>
        </li>
        <li class="nav-item px-3">
            <a style="color: black" class="nav-link" href="/posts">
                <span class="bi bi-journal-text text-2xl{{ request()->is('posts') ? ' text-red-500' : '' }}"></span>
            </a>
        </li>
        <li class="nav-item px-3">
            <a style="color: black" class="nav-link" href="/posts/categories">
                <span class="bi bi-grid text-2xl{{ request()->is('posts/categories')  ? ' text-red-500' : '' }}"></span>
            </a>
        </li>
        <li class="nav-item px-3">
            <a style="color: black" class="nav-link" href="/about">
                <span class="bi bi-info-circle text-2xl{{ request()->is('about') ? ' text-red-500' : '' }}"></span>
            </a>
        </li>
    </ul>
</div>