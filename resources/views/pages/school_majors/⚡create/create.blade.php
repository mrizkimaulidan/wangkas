<div>
  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
              <h5 class="fw-semibold">Tambah Jurusan Baru</h5>
              <p class="text-muted small">Isi formulir untuk menambahkan jurusan baru ke sistem</p>
            </div>
            <button type="button" onclick="history.back()" class="btn btn-outline-secondary btn-sm">
              <i class="bi bi-arrow-left me-1"></i>Kembali
            </button>
          </div>

          <div class="row g-3">
            <div class="col-12 col-md-7">
              <form wire:submit="save">
                <div class="mb-3">
                  <label for="name" class="form-label">Nama Jurusan <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('form.name') is-invalid @enderror" id="name"
                    wire:model="form.name" placeholder="Contoh: Teknik Komputer dan Jaringan, Akuntansi, Tata Boga">
                  @error('form.name')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="abbreviation" class="form-label">Singkatan Jurusan <span
                      class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('form.abbreviation') is-invalid @enderror"
                    id="abbreviation" wire:model="form.abbreviation" placeholder="Contoh: TKJ, AKL, TBG">
                  @error('form.abbreviation')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="d-flex gap-2">
                  <button type="submit" class="btn btn-primary">
                    <span wire:loading.remove wire:target="save">
                      <i class="bi bi-plus-circle me-1"></i>Simpan Data
                    </span>
                    <span wire:loading wire:target="save">
                      <span class="spinner-border spinner-border-sm me-1"></span>
                      Menyimpan...
                    </span>
                  </button>
                  <button type="button" onclick="history.back()" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-1"></i>Batal
                  </button>
                </div>
              </form>
            </div>

            <div class="col-12 col-md-5">
              <div class="border rounded p-3">
                <h6 class="fw-semibold mb-2">
                  <i class="bi bi-info-circle text-primary me-2"></i>Panduan Pengisian
                </h6>
                <ul class="list-unstyled small mb-0">
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    <strong>Nama jurusan harus unik</strong> dan tidak boleh sama dengan jurusan yang sudah ada
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    <strong>Singkatan jurusan harus unik</strong> dan tidak boleh sama dengan singkatan jurusan yang
                    sudah ada
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
