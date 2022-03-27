<div class="form-floating">
    <input {{ $attributes->class(['-mb-1', 'form-control']) }} type="{{ $type ?? 'text' }}" id="{{ $name }}" name="{{ $name }}"
    value="{{ old($name, isset($model) ? $model->$name : null) }}" placeholder="{{ $label }}" autofocus>

    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <x-_error :name="$name"></x-_error>
</div>