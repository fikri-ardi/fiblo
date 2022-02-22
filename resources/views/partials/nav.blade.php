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
        </div>

    </div>
</nav>