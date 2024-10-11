<div>
  <div wire:ignore.self data-bs-backdrop="static" class="modal fade" id="createModal" tabindex="-1"
    aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createModalLabel">Tambah Data Administrator</h1>
          <button wire:loading.attr="disabled" type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form wire:submit="save">
            <div class="row">
              <div class="col">
                <x-forms.input-with-icon wire:model.blur="form.name" label="Nama Lengkap" name="form.name"
                  placeholder="Masukan nama lengkap.." type="text" icon="bi bi-person" />

                <x-forms.input-with-icon wire:model.blur="form.email" label="Alamat Email" name="form.email"
                  placeholder="Masukan alamat email.." type="email" icon="bi bi-envelope-at" />

                <x-forms.input-with-icon wire:model.blur="form.password" label="Kata Sandi" name="form.password"
                  placeholder="Masukan kata sandi.." type="password" icon="bi bi-lock" />

                <x-forms.input-with-icon wire:model.blur="form.password_confirmation" label="Konfirmasi Kata Sandi"
                  name="form.password_confirmation" placeholder="Konfirmasi kata sandi.." type="password"
                  icon="bi bi-lock" />
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
