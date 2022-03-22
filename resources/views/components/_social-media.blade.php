@if ($user->links)
@if($user->links->instagram)
<a href="https://instagram.com/{{ $user->links->instagram }}" target="_blank"
    class="h-9 w-9 flex items-center justify-center bg-slate-300 rounded-full mx-1 text-slate-800">
    <i class="bi bi-instagram"></i>
</a>
@endif

@if($user->links->twitter)
<a href="https://twitter.com/{{ $user->links->twitter }}" target="_blank"
    class="h-9 w-9 flex items-center justify-center bg-slate-300 rounded-full mx-1 text-slate-800">
    <i class="bi bi-twitter"></i>
</a>
@endif

@if($user->links->facebook)
<a href="https://facebook.com/{{ $user->links->facebook }}" target="_blank"
    class="h-9 w-9 flex items-center justify-center bg-slate-300 rounded-full mx-1 text-slate-800">
    <i class="bi bi-facebook"></i>
</a>
@endif
@endif