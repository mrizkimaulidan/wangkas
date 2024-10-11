<div>
  <div class="form-group has-icon-left">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <div class="position-relative">
      <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" placeholder="{{ $placeholder }}"
        id="{{ $name }}" {{ $attributes }}>
      <div class="form-control-icon">
        <i class="{{ $icon }}"></i>
      </div>
      @error($name)
      <div class="d-block invalid-feedback fw-bold">
        {{ $message }}
      </div>
      @enderror
    </div>
  </div>
</div>
