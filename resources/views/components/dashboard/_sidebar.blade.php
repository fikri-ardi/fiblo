<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link{{ request()->is('dashboard') ? ' active' : '' }}" aria-current="page" href="{{ route('dashboard.index') }}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ request()->is('dashboard/posts*') ? ' active' : '' }}" href="{{ route('posts.index') }}">
                    <span data-feather="file-text"></span>
                    Posts
                </a>
            </li>
        </ul>

        @can('role', 'admin')
        <h6 class="p-3 text-gray-500">ADMINISTRATOR</h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link{{ request()->is('dashboard/users*') ? ' active' : '' }}" aria-current="page" href="{{ route('users.index') }}">
                    <span data-feather="users"></span>
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ request()->is('dashboard/categories*') ? ' active' : '' }}" aria-current="page"
                    href="{{ route('categories.index') }}">
                    <span data-feather="grid"></span>
                    Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ request()->is('dashboard/roles*') ? ' active' : '' }}" aria-current="page" href="{{ route('roles.index') }}">
                    <i class="bi bi-person-badge text-lg mr-1"></i>
                    Roles
                </a>
            </li>
        </ul>
        @endcan

    </div>
</nav>