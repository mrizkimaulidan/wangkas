<div>
  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
              <h5 class="mb-1 fw-semibold">Tambah Kas Baru</h5>
              <p class="text-muted small mb-0">Isi formulir untuk menambahkan kas ke sistem</p>
            </div>
            <button type="button" onclick="history.back()" class="btn btn-outline-secondary btn-sm">
              <i class="bi bi-arrow-left me-1"></i>Kembali
            </button>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <form wire:submit="save">
                <div class="row">
                  <div class="col-lg-12">
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
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="amount" class="form-label">Jumlah Bayar <span class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('form.amount') is-invalid @enderror" id="amount"
                        wire:model="form.amount" placeholder="Masukkan jumlah bayar..." autofocus>
                      @error('form.amount')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="mb-3">
                      <label for="date_paid" class="form-label">Tanggal <span class="text-danger">*</span></label>
                      <input type="date" class="form-control @error('form.date_paid') is-invalid @enderror"
                        id="date_paid" wire:model="form.date_paid" placeholder="Pilih tanggal">
                      @error('form.date_paid')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="mb-3">
                      <label for="transaction_note" class="form-label">Catatan <span
                          class="text-danger">*</span></label>
                      <textarea wire:model="form.transaction_note"
                        class="form-control @error('form.transaction_note') is-invalid @enderror" id="transaction_note"
                        cols="30" rows="5" placeholder="Catatan (opsional)"></textarea>
                      @error('form.transaction_note')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
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
                  <li class="mb-2">
                    <i class="bi bi-check-circle text-success me-2"></i>
                    Pastikan data sudah benar sebelum disimpan
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