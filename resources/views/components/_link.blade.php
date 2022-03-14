<a href="{{ $href }}"
    class="rounded-2xl text-sm text-capitalize bg-slate-900 px-3 py-2 text-blue-100 font-semibold shadow-lg transition duration-200 hover:text-blue-100">
    {{ $icon ?? '' }}
    {{ $slot ?? '' }}
</a>