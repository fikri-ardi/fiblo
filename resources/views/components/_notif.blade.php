@if (session('message'))
<div style="z-index: 9999;"
    class="fixed top-0 right-1/2 bg-slate-100 bg-opacity-10 text-slate-900 rounded-3xl backdrop-blur-lg shadow-lg px-3 py-2 text-base flex items-center justify-center slide">
    <span class="bi bi-bell text-slate-700 text-2xl bg-slate-200 p-1 rounded-xl"></span>
    <span class="text-sm">{{ session('message') }}</span>
</div>
@endif