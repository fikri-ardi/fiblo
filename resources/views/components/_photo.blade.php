@if ($user->photo)
<img src="/storage/{{ $user->photo }}" class="rounded-circle object-cover border-slate-200 d-inline-block shadow-md w-full h-full"
    alt="{{ $user->name }}">
@else
<span {{ $attributes->merge(['class' => 'bg-red-100 text-red-500 font-bold text-center rounded-full shadow-lg flex justify-center align-items-center
    w-full h-full']) }}>
    <span>{{ strtoupper(substr($user->username, 0, 1)) }}</span>
</span>
@endif