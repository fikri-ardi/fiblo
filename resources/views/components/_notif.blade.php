@if (session('message'))
<div
    class="fixed z-50 top-0 left-1/2 -translate-x-1/2 bg-slate-100 bg-opacity-10 text-slate-900 rounded-3xl backdrop-blur-lg shadow-lg px-3 py-2 text-base flex align-items-center slide">
    <span class="bi bi-bell text-slate-700 text-2xl bg-slate-200 p-1 rounded-xl"></span>
    <span class="text-sm">{{ session('message') }}</span>
</div>
@endif