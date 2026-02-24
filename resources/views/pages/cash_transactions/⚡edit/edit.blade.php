<div>
  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <div>
              <h5 class="fw-semibold">Ubah Kas</h5>
              <p class="text-muted small">
                Mengubah data kas: <span class="fw-medium">{{ $cashTransaction->student->name }}</span>
              </p>
            </div>
            <button type="button" onclick="history.back()" class="btn btn-outline-secondary btn-sm">
              <i class="bi bi-arrow-left me-1"></i>Kembali
            </button>
          </div>

          <div class="row g-3">
            <div class="col-lg-6">
              <form wire:submit="update">
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

                <div class="row g-2">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="amount" class="form-label">Jumlah Bayar <span class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('form.amount') is-invalid @enderror" id="amount"
                        wire:model="form.amount" placeholder="Contoh: 50000">
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

                <livewire:last-updated :timestamp="$cashTransaction->updated_at" />

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
              <div class="border rounded p-3">
                <h6 class="fw-semibold mb-2">
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
