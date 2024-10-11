<div>
  <div class="form-group has-icon-left mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <div class="position-relative">
      <textarea class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
        placeholder="{{ $placeholder }}" {{ $attributes }}></textarea>
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
