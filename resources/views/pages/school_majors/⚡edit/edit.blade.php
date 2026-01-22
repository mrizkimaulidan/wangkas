<div>
  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
              <h5 class="mb-1 fw-semibold">Ubah Data Jurusan</h5>
              <p class="text-muted small mb-0">
                Mengubah data jurusan: <span class="fw-medium">{{ $schoolMajor->name }}</span>
              </p>
            </div>
            <button type="button" onclick="history.back()" class="btn btn-outline-secondary btn-sm">
              <i class="bi bi-arrow-left me-1"></i>Kembali
            </button>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <form wire:submit="update">
                <div class="mb-3">
                  <label for="name" class="form-label">Nama Jurusan <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('form.name') is-invalid @enderror" id="name"
                    wire:model="form.name" placeholder="Masukan nama jurusan..." autofocus>
                  @error('form.name')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="abbreviation" class="form-label">Singkatan Jurusan <span
                      class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('form.abbreviation') is-invalid @enderror"
                    id="abbreviation" wire:model="form.abbreviation" placeholder="Masukan nama jurusan..." autofocus>
                  @error('form.abbreviation')
                  <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="border rounded p-3 mb-4">
                  <div class="small">
                    <i class="bi bi-clock-history text-primary me-1"></i>
                    <strong>Terakhir diperbarui:</strong>
                    <span>{{ $schoolMajor->updated_at?->translatedFormat('d F Y H:i') ?? '-' }}</span>
                  </div>
                </div>

                <div class="d-flex gap-2 pt-2">
                  <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>Perbarui Data
                  </button>
                  <button type="button" onclick="history.back()" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-1"></i>Batal
                  </button>
                </div>
              </form>
            </div>

            <div class="col-lg-6">
              <div class="card border mb-4">
                <div class="card-body">
                  <h6 class="fw-semibold mb-3">
                    <i class="bi bi-card-checklist text-primary me-2"></i>Detail Jurusan
                  </h6>
                  <dl class="row small mb-0">
                    <dt class="col-5">Dibuat pada:</dt>
                    <dd class="col-7">{{ $schoolMajor->created_at?->translatedFormat('d F Y') ?? '-' }}</dd>

                    <dt class="col-5">Jumlah Pelajar:</dt>
                    <dd class="col-7">
                      <span class="badge bg-primary">
                        {{ $schoolMajor->students_count ?? 0 }} Pelajar
                      </span>
                    </dd>
                  </dl>
                </div>
              </div>

              <div class="border rounded p-4">
                <h6 class="fw-semibold mb-3">
                  <i class="bi bi-info-circle text-primary me-2"></i>Informasi Penting
                </h6>
                <ul class="list-unstyled small mb-0">
                  <li class="mb-2">
                    <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                    <strong>Perubahan nama jurusan</strong> akan mempengaruhi semua data terkait
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Pastikan singkatan jurusan <strong>unik dan tidak duplikat</strong>
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