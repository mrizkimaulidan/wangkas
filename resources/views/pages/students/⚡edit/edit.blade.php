<div>
  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
              <h5 class="fw-semibold">Ubah Data Pelajar</h5>
              <p class="text-muted small">
                Mengubah data pelajar: <span class="fw-medium">{{ $student->name }}</span>
              </p>
            </div>
            <button type="button" onclick="history.back()" class="btn btn-outline-secondary btn-sm">
              <i class="bi bi-arrow-left me-1"></i>Kembali
            </button>
          </div>

          <div class="row g-3">
            <div class="col-lg-6">
              <form wire:submit="update">
                <div class="row g-2">
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                      <input type="text" class="form-control @error('form.name') is-invalid @enderror" id="name"
                        wire:model="form.name" placeholder="Contoh: Ahmad Budiman">
                      @error('form.name')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="identification_number" class="form-label">Nomor Identitas <span
                          class="text-danger">*</span></label>
                      <input type="number"
                        class="form-control @error('form.identification_number') is-invalid @enderror"
                        id="identification_number" wire:model="form.identification_number"
                        placeholder="Contoh: 20230001">
                      @error('form.identification_number')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row g-2">
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="school_major_select" class="form-label">Pilih Jurusan <span
                          class="text-danger">*</span></label>
                      <select wire:model="form.school_major_id"
                        class="form-select @error('form.school_major_id') is-invalid @enderror"
                        id="school_major_select">
                        <option value="">Pilih Jurusan</option>
                        @foreach ($schoolMajors as $schoolMajor)
                        <option value="{{ $schoolMajor->id }}">{{ $schoolMajor->name }}</option>
                        @endforeach
                      </select>
                      @error('form.school_major_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="school_class_select" class="form-label">Pilih Kelas <span
                          class="text-danger">*</span></label>
                      <select wire:model="form.school_class_id"
                        class="form-select @error('form.school_class_id') is-invalid @enderror"
                        id="school_class_select">
                        <option value="">Pilih Kelas</option>
                        @foreach ($schoolClasses as $schoolClass)
                        <option value="{{ $schoolClass->id }}">{{ $schoolClass->name }}</option>
                        @endforeach
                      </select>
                      @error('form.school_class_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row g-2">
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="phone_number" class="form-label">Nomor Telepon <span
                          class="text-danger">*</span></label>
                      <input type="tel" class="form-control @error('form.phone_number') is-invalid @enderror"
                        id="phone_number" wire:model="form.phone_number" placeholder="Contoh: 081234567890">
                      @error('form.phone_number')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="gender_select" class="form-label">Jenis Kelamin <span
                          class="text-danger">*</span></label>
                      <select wire:model="form.gender" class="form-select @error('form.gender') is-invalid @enderror"
                        id="gender_select">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="1">Laki-laki</option>
                        <option value="2">Perempuan</option>
                      </select>
                      @error('form.gender')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row g-2">
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="school_year_start" class="form-label">Tahun Ajaran Masuk <span
                          class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('form.school_year_start') is-invalid @enderror"
                        id="school_year_start" wire:model="form.school_year_start" min="2000" max="2030"
                        placeholder="Contoh: 2023">
                      @error('form.school_year_start')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="school_year_end" class="form-label">Tahun Ajaran Keluar <span
                          class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('form.school_year_end') is-invalid @enderror"
                        id="school_year_end" wire:model="form.school_year_end" min="2000" max="2035"
                        placeholder="Contoh: 2027">
                      @error('form.school_year_end')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <livewire:last-updated :timestamp="$student->updated_at" />

                <div class="d-flex gap-2">
                  <button type="submit" class="btn btn-primary">
                    <span wire:loading.remove wire:target="update">
                      <i class="bi bi-save me-1"></i>Perbarui Data
                    </span>
                    <span wire:loading wire:target="update">
                      <span class="spinner-border spinner-border-sm me-1"></span>
                      Memperbarui...
                    </span>
                  </button>
                  <button type="button" onclick="history.back()" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-1"></i>Batal
                  </button>
                </div>
              </form>
            </div>

            <div class="col-lg-6">
              <div class="border rounded p-3 mb-3">
                <h6 class="fw-semibold mb-2">
                  <i class="bi bi-card-checklist text-primary me-2"></i>Detail Pelajar
                </h6>
                <dl class="row small mb-0">
                  <dt class="col-5">Dibuat pada:</dt>
                  <dd class="col-7">{{ $student->created_at?->translatedFormat('d F Y') ?? '-' }}</dd>

                  <dt class="col-5">Jurusan Saat Ini:</dt>
                  <dd class="col-7">{{ $student->schoolMajor->name ?? '-' }}</dd>

                  <dt class="col-5">Kelas Saat Ini:</dt>
                  <dd class="col-7">{{ $student->schoolClass->name ?? '-' }}</dd>
                </dl>
              </div>

              <div class="border rounded p-3">
                <h6 class="fw-semibold mb-2">
                  <i class="bi bi-info-circle text-primary me-2"></i>Panduan Pengisian Data Pelajar
                </h6>
                <ul class="list-unstyled small mb-0">
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    <strong>Nomor Identitas</strong> harus unik dan terdiri dari angka saja (contoh: 20230001)
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    <strong>Nama Lengkap</strong> gunakan huruf kapital di awal setiap kata (contoh: Ahmad Budiman)
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    <strong>Nomor Telepon</strong> gunakan format 08xxxxxxxxxx atau +62xxxxxxxxxxx
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    <strong>Jenis Kelamin</strong> pilih Laki-laki atau Perempuan sesuai pilihan yang tersedia
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    <strong>Tahun Ajaran</strong> isi dengan angka 4 digit (contoh: 2023-2024 → 2023 dan 2024)
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    <strong>Pilih Jurusan dan Kelas</strong> sesuai dengan pilihan yang tersedia
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Pastikan data konsisten dan lengkap
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
