<div class="form-floating">
    <input {{ $attributes->class(['-mb-1', 'form-control']) }} type="{{ $type ?? 'text' }}" id="{{
    $name }}"
    name="{{ $name }}"
    value="{{ old($name, isset($model) ? $model->$name : '') }}" placeholder="{{ $label }}" required>
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @error($name)
    <div class="text-red-500 text-sm font-semibold ml-1">{{ $message }}</div>
    @enderror
</div>