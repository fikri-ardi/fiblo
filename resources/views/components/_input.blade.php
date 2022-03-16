<div class="form-floating">
    <input type="{{ $type ?? 'text' }}" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}"
        value="{{ old($name, isset($model) ? $model->$name : '') }}" placeholder="{{ $label }}" required>
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>