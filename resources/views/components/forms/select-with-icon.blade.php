<div>
  <div class="form-group has-icon-left">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <div class="input-group mb-3">
      <label class="input-group-text" for="{{ $name }}">
        <div><i class="{{ $icon }}"></i></div>
      </label>
      <select class="form-select @error($name) is-invalid @enderror" id="{{ $name }}" {{ $attributes }}>
        <option value="">{{ $label }}</option>
        {{ $slot }}
      </select>

      @error($name)
      <div class="d-block invalid-feedback fw-bold">
        {{ $message }}
      </div>
      @enderror
    </div>
  </div>
</div>
