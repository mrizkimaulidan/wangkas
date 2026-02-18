<div>
  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
              <h5 class="mb-1 fw-semibold">Tambah Kas Baru</h5>
              <p class="text-muted small mb-0">Isi formulir untuk menambahkan kas baru ke sistem</p>
            </div>
            <button type="button" onclick="history.back()" class="btn btn-outline-secondary btn-sm">
              <i class="bi bi-arrow-left me-1"></i>Kembali
            </button>
          </div>
          <div class="row">
            <div class="col-lg-5">
              <div class="card border">
                <div class="card-body">
                  <h6 class="fw-semibold mb-3">
                    <i class="bi bi-filter text-info me-2"></i>Form Tambah Kas
                  </h6>
                  <form wire:submit="save">
                    <div class="mb-3">
                      <label for="student_select" class="form-label">Pilih Pelajar <span
                          class="text-danger">*</span></label>
                      <select wire:model="form.student_id"
                        class="form-select @error('form.student_id') is-invalid @enderror" id="student_select">
                        <option value="">Pilih Pelajar</option>
                        @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->identification_number }} - {{ $student->name }}
                        </option>
                        @endforeach
                      </select>
                      @error('form.student_id')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="amount" class="form-label">Jumlah Bayar <span class="text-danger">*</span></label>
                          <input type="number" class="form-control @error('form.amount') is-invalid @enderror"
                            id="amount" wire:model="form.amount" placeholder="Contoh: 50000" autofocus>
                          @error('form.amount')
                          <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="date_paid" class="form-label">Tanggal <span class="text-danger">*</span></label>
                          <input type="date" class="form-control @error('form.date_paid') is-invalid @enderror"
                            id="date_paid" wire:model="form.date_paid">
                          @error('form.date_paid')
                          <div class="invalid-feedback">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="transaction_note" class="form-label">Catatan</label>
                      <textarea wire:model="form.transaction_note" class="form-control" name="transaction_note"
                        id="transaction_note" cols="30" rows="3" placeholder="Catatan (opsional)"></textarea>
                    </div>
                    <div class="d-flex gap-2 pt-2">
                      <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i>Simpan Data
                      </button>
                      <button type="button" onclick="history.back()" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle me-1"></i>Batal
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-7">
              <div class="card border">
                <div class="card-body">
                  <h6 class="fw-semibold mb-3">
                    <i class="bi bi-filter text-info me-2"></i>Filter Pelajar Belum Bayar
                  </h6>
                  <div class="row g-2 mb-3">
                    <div class="col-6">
                      <label for="start_date" class="form-label small">Tanggal Awal</label>
                      <input type="date" class="form-control form-control-sm @error('start_date') is-invalid @enderror"
                        id="start_date" wire:model.live="start_date">
                      @error('start_date')
                      <div class="invalid-feedback small d-block">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-6">
                      <label for="end_date" class="form-label small">Tanggal Akhir</label>
                      <input type="date" class="form-control form-control-sm @error('end_date') is-invalid @enderror"
                        id="end_date" wire:model.live="end_date">
                      @error('end_date')
                      <div class="invalid-feedback small d-block">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="card border">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-semibold mb-0">
                      <i class="bi bi-filter text-info me-2"></i>Daftar Belum Membayar
                    </h6>
                    <span class="badge text-bg-primary">{{ $this->unpaidStudents->total() }} Orang</span>
                  </div>
                  <div class="row mb-4 g-2">
                    <div class="col-12 col-md-6">
                      <label for="searchInput" class="visually-hidden">Pencarian pelajar</label>
                      <input wire:model.live.debounce.300ms="search" type="search" class="form-control" id="searchInput"
                        placeholder="Masukan kata kunci pencarian..." aria-label="Pencarian pelajar">
                    </div>
                    <div class="col-12 col-md-6">
                      <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                        <select wire:model.live="school_major_id" class="form-select form-select-sm"
                          id="schoolMajorSelect">
                          <option value="">Semua Jurusan</option>
                          @foreach ($this->schoolMajors as $schoolMajor)
                          <option value="{{ $schoolMajor->id }}">{{ $schoolMajor->name }}</option>
                          @endforeach
                        </select>

                        <select wire:model.live="school_class_id" class="form-select form-select-sm"
                          id="schoolClassSelect">
                          <option value="">Semua Kelas</option>
                          @foreach ($this->schoolClasses as $schoolClass)
                          <option value="{{ $schoolClass->id }}">{{ $schoolClass->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                      <caption class="caption-top">Rentang tanggal: {{ $start_date }} sampai {{ $end_date }}</caption>
                      <thead>
                        <tr>
                          <th scope="col" style="width: 60px">No</th>
                          <th scope="col">Nomor Identitas</th>
                          <th scope="col">Nama Pelajar</th>
                          <th scope="col">Nomor Telepon</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($this->unpaidStudents as $student)
                        <tr>
                          <td class="fw-medium">{{ $this->unpaidStudents->firstItem() + $loop->index }}</td>
                          <td>{{ $student->identification_number }}</td>
                          <td>
                            <div class="d-flex align-items-center">
                              <div class="me-3">
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
                          <td>0821-2345-6789</td>
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
                    <div class="pt-3">{{ $this->unpaidStudents->links(data: ['scrollTo' => false]) }}</div>
                  </div>
                </div>
              </div>
              <div class="border rounded p-4">
                <h6 class="fw-semibold mb-3">
                  <i class="bi bi-info-circle text-primary me-2"></i>Panduan Pengisian
                </h6>
                <ul class="list-unstyled small mb-0">
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    <strong>Pilih pelajar</strong> yang melakukan pembayaran
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    <strong>Isi jumlah bayar</strong> sesuai dengan iuran yang ditetapkan
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    <strong>Pilih tanggal</strong> sesuai tanggal pembayaran dilakukan
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    <strong>Catatan (opsional)</strong> untuk informasi tambahan pembayaran
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
