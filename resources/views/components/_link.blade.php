<a {{ $attributes->merge(['class' => 'flex items-center rounded-2xl text-sm text-capitalize no-underline bg-slate-800 active:bg-slate-900 px-3 py-2
    text-blue-100
    font-semibold shadow-lg transition
    duration-200 hover:text-blue-100']) }} 
    href="{{ $href }}" 
    wire:navigate
    >
    {{ $slot }}
</a>