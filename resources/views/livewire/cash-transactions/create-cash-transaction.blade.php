<div>
  <div wire:ignore.self data-bs-backdrop="static" class="modal fade" id="createModal" tabindex="-1"
    aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createModalLabel">Tambah Data Transaksi Kas</h1>
          <button wire:loading.attr="disabled" type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form wire:submit="save">
            <div class="row">
              <div class="col-6">
                <div class="mb-3">
                  <label for="student_id" class="form-label">Pilih Pelajar:</label>
                  <select wire:model.blur="form.student_id"
                    class="form-select @error('form.student_id') is-invalid @enderror" id="student_id">
                    <option selected>Pilih Pelajar</option>
                    @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->identification_number }} - {{ $student->name }}
                    </option>
                    @endforeach
                  </select>
                  <div>
                    @error('form.student_id')
                    <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="mb-3">
                  <label for="amount" class="form-label">Tagihan:</label>
                  <input wire:model.blur="form.amount" type="number"
                    class="form-control @error('form.amount') is-invalid @enderror" id="amount"
                    placeholder="Masukan nominal tagihan..">
                  <div>
                    @error('form.amount')
                    <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="mb-3">
                  <label for="date_paid" class="form-label">Pilih Tanggal:</label>
                  <input wire:model.blur="form.date_paid" type="date"
                    class="form-control @error('form.date_paid') is-invalid @enderror" id="date_paid"
                    placeholder="Masukan nominal tagihan..">
                  <div>
                    @error('form.date_paid')
                    <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="mb-3">
                  <label for="transaction_note" class="form-label">Catatan:</label>
                  <textarea wire:model.blur="form.transaction_note"
                    class="form-control @error('form.transaction_note') is-invalid @enderror" id="transaction_note"
                    cols="30" rows="5" placeholder="Masukan catatan... (opsional)"></textarea>
                  <div>
                    @error('form.transaction_note')
                    <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button wire:loading.attr="disabled" type="button" class="btn btn-secondary"
                data-bs-dismiss="modal">Tutup</button>

              <button wire:loading.remove type="submit" class="btn btn-primary">Simpan</button>

              <div wire:loading wire:target="save">
                <button class="btn btn-primary" type="button" disabled>
                  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                  <span role="status">Menyimpan...</span>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
