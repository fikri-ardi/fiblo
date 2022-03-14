@if ($user->photo)
<img src="/storage/{{ $user->photo }}"
    class="rounded-circle object-cover border-slate-200 d-inline-block shadow-md{{ $size == 'sm' ? ' w-7 h-7 border-3' : ' w-36 h-36 border-5' }}"
    alt="{{ $user->name }}">
@else
<span
    class="bg-red-100 text-red-500 font-bold text-center rounded-full shadow-lg flex justify-center align-items-center{{ $size == 'sm' ? ' text-lg h-10 w-10' : ' text-7xl h-32 w-32' }} ">
    <span>{{ strtoupper(substr($user->username, 0, 1)) }}</span>
</span>
@endif