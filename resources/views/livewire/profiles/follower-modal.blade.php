<div>
    @forelse ($user->$type as $type)
    <div class="pl-5 py-2 flex justify-center-center active:bg-gray-300 hover:bg-gray-200 cursor-pointer">
        <a href="{{ route('profiles.show', $type) }}" class="w-full flex items-center">
            <div class="h-8 w-8">
                <x-_photo :user="$type" size="sm"></x-_photo>
            </div>
            <span class="ml-2"> {{ $type->username }} </span>
        </a>
    </div>
    @empty
    <div class="text-center text-slate-400">{{ $type == 'followers' ? 'Belum ada pengikut.' : "$user->username belum mengikuti siapapun." }}</div>
    @endforelse
</div>