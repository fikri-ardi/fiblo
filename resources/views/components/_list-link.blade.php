<li>
    <a class="flex items-center no-underline text-gray-800 px-3 py-2 hover:bg-slate-200 hover:text-slate-900{{ request()->is($active ?? '') ? ' active' : '' }}"
        href="{{ $href }}">
        {{ $slot }}
    </a>
</li>