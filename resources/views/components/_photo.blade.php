@if ($user->photo)
<img src="{{ env("APP_URL").$user->photo }}" class="rounded-circle object-cover border-slate-200 d-inline-block shadow-md w-full h-full" alt="{{ $user->name }}">
{{ $slot ?? '' }}
@else
<span {{ $attributes->merge(['class' => 'bg-red-100 text-red-500 font-bold text-center rounded-full flex justify-center align-items-center
    w-full h-full']) }}>
    <span>{{ strtoupper(substr($user->username, 0, 1)) }}</span>
</span>
@endif