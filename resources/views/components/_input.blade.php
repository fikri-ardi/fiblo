<div class="mb-3 form-floating">
    <input type="{{ $type ?? 'text' }}" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}"
        value="{{ old($name, $model->$name) }}" placeholder="{{ $label }}" required>
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>