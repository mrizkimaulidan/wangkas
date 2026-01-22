<div>
  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
              <h5 class="mb-1 fw-semibold">Tambah Kelas Baru</h5>
              <p class="text-muted small mb-0">Isi formulir untuk menambahkan kelas baru ke sistem</p>
            </div>
            <button type="button" onclick="history.back()" class="btn btn-outline-secondary btn-sm">
              <i class="bi bi-arrow-left me-1"></i>Kembali
            </button>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <form wire:submit="save">
                <div class="mb-3">
                  <label for="name" class="form-label">Nama Kelas <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('form.name') is-invalid @enderror" id="name"
                    wire:model="form.name" placeholder="Contoh: 10 IPA 1, 11 IPS 2, 12 Bahasa 1" autofocus
                    wire:loading.attr="disabled">
                  @error('form.name')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="d-flex gap-2 pt-2">
                  <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save">
                      <i class="bi bi-plus-circle me-1"></i>Simpan Data
                    </span>
                    <span wire:loading wire:target="save">
                      <span class="spinner-border spinner-border-sm me-1"></span>
                      Menyimpan...
                    </span>
                  </button>
                  <button type="button" onclick="history.back()" class="btn btn-outline-secondary"
                    wire:loading.attr="disabled">
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
                    <strong>Nama kelas harus unik</strong> dan tidak boleh sama dengan kelas yang sudah ada
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