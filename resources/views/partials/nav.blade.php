<nav class="navbar navbar-expand-lg navbar-dark" style="background: rgb(202, 39, 74)">
    <div class="container">
        <a class="navbar-brand" href="/">Fiblo</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link{{ request()->segment(1) == '' ? ' active' : '' }}" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->segment(1) == 'posts' && request()->segment(2) != 'categories' ? ' active' : '' }}"
                        href="/posts">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->segment(2) == 'categories' ? ' active' : '' }}" href="/posts/categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ request()->segment(1) == 'about' ? ' active' : '' }}" href="/about">About</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person"></i> {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/dashboard">
                                <i class="bi bi-layout-text-sidebar-reverse"></i> Dashboard
                            </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="/logout" method="post">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    <i class="bi bi-box-arrow-left"></i> Logout
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

    </div>
</nav>