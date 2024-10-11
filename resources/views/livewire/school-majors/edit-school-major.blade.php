<div>
  <div wire:ignore.self data-bs-backdrop="static" class="modal fade" id="editModal" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Ubah Data Jurusan</h1>
          <button wire:loading.attr="disabled" type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form wire:submit="edit">
            <div class="row">
              <div class="col">
                <x-forms.input-with-icon wire:model.blur="form.name" label="Nama Jurusan" name="form.name"
                  placeholder="Masukan nama jurusan.." type="text" icon="bi bi-briefcase" />

                <x-forms.input-with-icon wire:model.blur="form.abbreviation" label="Singkatan Jurusan"
                  name="form.abbreviation" placeholder="Masukan singkatan jurusan.." type="text"
                  icon="bi bi-card-text" />
              </div>
            </div>

            <div class="modal-footer">
              <button wire:loading.attr="disabled" type="button" class="btn btn-secondary"
                data-bs-dismiss="modal">Tutup</button>

              <button wire:loading.remove type="submit" class="btn btn-primary">Simpan</button>

              <div wire:loading wire:target="edit">
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
