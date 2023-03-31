<button {{ $attributes->merge(['class' => 'flex items-center rounded-2xl text-sm text-capitalize bg-slate-300 active:bg-slate-400 px-3 py-2
    text-slate-800 font-semibold
    shadow-lg transition duration-200']) }} type="submit">
    {{ $slot }}
</button>