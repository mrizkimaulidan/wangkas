<div>
  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
              <h5 class="mb-1 fw-semibold">Ubah Profil</h5>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <form wire:submit="update">
                <div class="mb-3">
                  <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('form.name') is-invalid @enderror" id="name"
                    wire:model="form.name" placeholder="Masukan nama lengkap..." autofocus>
                  @error('form.name')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                  <input type="email" class="form-control @error('form.email') is-invalid @enderror" id="email"
                    wire:model="form.email" placeholder="Masukan alamat email..." autofocus>
                  @error('form.email')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Kata Sandi <span class="text-danger">*</span></label>
                  <input type="password" class="form-control @error('form.password') is-invalid @enderror" id="password"
                    wire:model="form.password" placeholder="Masukan kata sandi..." autofocus>
                  @error('form.password')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi <span
                      class="text-danger">*</span></label>
                  <input type="password" class="form-control @error('form.password_confirmation') is-invalid @enderror"
                    id="password_confirmation" wire:model="form.password_confirmation"
                    placeholder="Konfirmasi kata sandi..." autofocus>
                  @error('form.password_confirmation')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="d-flex gap-2 pt-2">
                  <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>Perbarui Data
                  </button>
                </div>
              </form>
            </div>

            <div class="col-lg-6">
              <div class="border rounded p-4">
                <h6 class="fw-semibold mb-3">
                  <i class="bi bi-info-circle text-primary me-2"></i>Informasi Penting
                </h6>
                <ul class="list-unstyled small mb-0">
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    <strong>Alamat email harus unik</strong> dan tidak boleh sama dengan alamat email yang
                    sudah ada
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    <strong>Kata sandi harus aman</strong> minimal 8 karakter
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    <strong>Kata sandi tidak boleh umum</strong> seperti "password123" atau "12345678"
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Gunakan format standar untuk konsistensi data
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
