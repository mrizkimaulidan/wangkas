<div>
  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
              <h5 class="fw-semibold">Ubah Data Jurusan</h5>
              <p class="text-muted small">
                Mengubah data jurusan: <span class="fw-medium">{{ $schoolMajor->name }}</span>
              </p>
            </div>
            <button type="button" onclick="history.back()" class="btn btn-outline-secondary btn-sm">
              <i class="bi bi-arrow-left me-1"></i>Kembali
            </button>
          </div>

          <div class="row g-3">
            <div class="col-lg-5">
              <form wire:submit="update">
                <div class="mb-3">
                  <label for="name" class="form-label">Nama Jurusan <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('form.name') is-invalid @enderror" id="name"
                    wire:model="form.name" placeholder="Contoh: Teknik Komputer dan Jaringan, Akuntansi, Tata Boga"
                    autofocus>
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

                <livewire:last-updated :timestamp="$schoolMajor->updated_at" />

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

            <div class="col-lg-7">
              <div class="border rounded p-3 mb-3">
                <h6 class="fw-semibold mb-2">
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

              <div class="border rounded p-3 mb-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h6 class="fw-semibold mb-0">
                    Daftar Pelajar Terkait
                  </h6>
                  <span class="badge text-bg-primary">{{ $relatedStudentsCount }} Orang</span>
                </div>

                <div class="row mb-3 g-2">
                  <div class="col-12 col-md-6">
                    <label for="searchInput" class="visually-hidden">Pencarian pelajar</label>
                    <input wire:model.live.debounce.300ms="search" type="search" class="form-control" id="searchInput"
                      placeholder="Masukan kata kunci pencarian..." aria-label="Pencarian pelajar">
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                      <select wire:model.live="perPage" class="form-select" id="perPageSelect">
                        <option value="">Tampilkan</option>
                        <option value="5">5 data</option>
                        <option value="10">10 data</option>
                        <option value="25">25 data</option>
                        <option value="50">50 data</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="table-responsive">
                  <table class="table table-hover align-middle mb-0">
                    <thead>
                      <tr>
                        <th scope="col" style="width: 60px">No</th>
                        <th scope="col">Nomor Identitas</th>
                        <th scope="col">Nama Pelajar</th>
                        <th scope="col">Nomor Telepon</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($this->students as $student)
                      <tr>
                        <td class="fw-medium">{{ $this->students->firstItem() + $loop->index }}</td>
                        <td>{{ $student->identification_number }}</td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div>
                              <div class="fw-medium mb-1">{{ $student->name }}</div>
                              <div class="d-flex flex-wrap align-items-center gap-2 small">
                                <span class="text-muted">
                                  <i class="bi bi-briefcase me-1"></i>
                                  {{ $student->schoolMajor->name }}
                                </span>
                                <span class="text-muted">
                                  <i class="bi bi-bookmark me-1"></i>
                                  {{ $student->schoolClass->name }}
                                </span>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>{{ $student->phone_number }}</td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="4" class="text-center py-4">
                          <div class="text-muted">
                            <p class="mb-0">Tidak ada data yang ditemukan</p>
                          </div>
                        </td>
                      </tr>
                      @endforelse
                    </tbody>
                  </table>
                  <div class="pt-3">{{ $this->students->links(data: ['scrollTo' => false]) }}</div>
                </div>
              </div>

              <div class="border rounded p-3">
                <h6 class="fw-semibold mb-2">
                  <i class="bi bi-info-circle text-primary me-2"></i>Informasi Penting
                </h6>
                <ul class="list-unstyled small mb-0">
                  <li class="mb-2">
                    <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                    <strong>Perubahan nama jurusan</strong> akan mempengaruhi semua data terkait
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Pastikan nama dan singkatan jurusan <strong>unik dan tidak duplikat</strong>
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
