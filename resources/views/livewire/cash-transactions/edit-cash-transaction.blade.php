<div>
  <div wire:ignore.self data-bs-backdrop="static" class="modal fade" id="editModal" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Ubah Data Transaksi Kas</h1>
          <button wire:loading.attr="disabled" type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form wire:submit="edit">
            <div class="row">
              <div class="col-md-6">
                <x-forms.select-with-icon wire:model.blur="form.student_id" label="Pilih Pelajar" name="form.student_id"
                  icon="bi bi-people-fill">
                  @foreach ($students as $student)
                  <option value="{{ $student->id }}">{{ $student->identification_number }} - {{ $student->name }}
                  </option>
                  @endforeach
                </x-forms.select-with-icon>
              </div>

              <div class="col-sm-12 col-md-6">
                <x-forms.input-with-icon wire:model.blur="form.amount" label="Tagihan" name="form.amount"
                  placeholder="Masukan tagihan.." type="number" icon="bi bi-cash" />

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
                <x-forms.textarea-with-icon label="Catatan" name="form.transaction_note"
                  placeholder="Masukan catatan.. (opsional)" icon="bi bi-card-text" cols="30" rows="5" />
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