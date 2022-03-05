@if (session('message'))
<div class="fixed z-50 bottom-20 right-0 bg-black bg-opacity-50 text-white rounded-3xl backdrop-blur-lg shadow-lg px-3 py-2 text-base flex align-items-center slide"
    style="z-index: 999">
    <span class="bi bi-bell text-slate-500 text-2xl bg-slate-200 p-1 rounded-xl mr-3"></span>
    {{ session('message') }}
</div>
@endif