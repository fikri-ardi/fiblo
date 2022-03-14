<li class="nav-item">
    <a class="nav-link{{ request()->is($active) ? ' active' : '' }}" href="{{ $href }}">
        {{ $slot }}
    </a>
</li>