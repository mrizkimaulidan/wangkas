<div>
  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
              <h5 class="mb-1 fw-semibold">Tambah Pengguna Baru</h5>
              <p class="text-muted small mb-0">Isi formulir untuk menambahkan pengguna baru ke sistem</p>
            </div>
            <button type="button" onclick="history.back()" class="btn btn-outline-secondary btn-sm">
              <i class="bi bi-arrow-left me-1"></i>Kembali
            </button>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <form wire:submit="save">
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
                  <input type="text" class="form-control @error('form.email') is-invalid @enderror" id="email"
                    wire:model="form.email" placeholder="Masukan alamat email...">
                  @error('form.email')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="password" class="form-label">
                    Kata Sandi <span class="text-danger">*</span>
                  </label>

                  <div class="position-relative">
                    <input type="{{ $showPassword ? 'text' : 'password' }}"
                      class="form-control @error('form.password') is-invalid @enderror" id="password"
                      wire:model="form.password" placeholder="Masukan kata sandi...">

                    <button type="button" wire:click="togglePasswordVisibility"
                      class="btn btn-link position-absolute top-50 end-0 translate-middle-y p-0 border-0 bg-transparent text-decoration-none me-3">
                      <i class="bi {{ $showPassword ? 'bi-eye-slash' : 'bi-eye' }} text-secondary"></i>
                    </button>
                  </div>

                  <div class="mt-2 d-flex justify-content-end">
                    <button type="button" wire:click="generatePassword"
                      class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                      <span>Generate Kata Sandi</span>
                    </button>
                  </div>
                  @error('form.password')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="password_confirmation" class="form-label">
                    Konfirmasi Kata Sandi <span class="text-danger">*</span>
                  </label>

                  <div class="position-relative">
                    <input type="{{ $showPassword ? 'text' : 'password' }}"
                      class="form-control @error('form.password_confirmation') is-invalid @enderror"
                      id="password_confirmation" wire:model="form.password_confirmation"
                      placeholder="Konfirmasi kata sandi...">

                    <button type="button" wire:click="togglePasswordVisibility"
                      class="btn btn-link position-absolute top-50 end-0 translate-middle-y p-0 border-0 bg-transparent text-decoration-none me-3">
                      <i class="bi {{ $showPassword ? 'bi-eye-slash' : 'bi-eye' }} text-secondary"></i>
                    </button>
                  </div>
                  @error('form.password_confirmation')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="d-flex gap-2 pt-2">
                  <button type="submit" class="btn btn-primary">
                    <span wire:target="save">
                      <i class="bi bi-plus-circle me-1"></i>Simpan Data
                    </span>
                  </button>
                  <button type="button" onclick="history.back()" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-1"></i>Batal
                  </button>
                </div>
              </form>
            </div>

            <div class="col-lg-6">
              <div class="border rounded p-4">
                <h6 class="fw-semibold mb-3">
                  <i class="bi bi-info-circle text-primary me-2"></i>Panduan Pengisian
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