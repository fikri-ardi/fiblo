@foreach ($user->$type as $type)
<div class="pl-5 py-2 flex justify-center-center active:bg-gray-300 hover:bg-gray-200 cursor-pointer">
    <a href="{{ route('profiles.show', $type) }}" class="w-full">
        <x-_photo :user="$type" size="sm"></x-_photo>
        <span class="ml-2"> {{ $type->username }} </sp>
    </a>
</div>
@endforeach