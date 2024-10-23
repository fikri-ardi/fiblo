<div class="form-floating">
    <input wire:model.blur="{{ $name }}" class="-mb-1 form-control" type="{{ $type ?? 'text' }}" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $label }}" autofocus>

    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <x-_error :name="$name"></x-_error>
</div>