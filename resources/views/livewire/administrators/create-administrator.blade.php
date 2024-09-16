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
                <div class="mb-3">
                  <label for="name" class="form-label">Nama Lengkap:</label>
                  <input wire:model.blur="form.name" type="text"
                    class="form-control @error('form.name') is-invalid @enderror" id="name"
                    placeholder="Masukan nama lengkap..">
                  <div>
                    @error('form.name')
                    <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Alamat Email:</label>
                  <input wire:model.blur="form.email" type="email"
                    class="form-control @error('form.email') is-invalid @enderror" id="email"
                    placeholder="Masukan alamat email..">
                  <div>
                    @error('form.email')
                    <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Kata Sandi:</label>
                  <input wire:model.blur="form.password" type="password"
                    class="form-control @error('form.password') is-invalid @enderror" id="password"
                    placeholder="Masukan kata sandi..">
                  <div>
                    @error('form.password')
                    <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="mb-3">
                  <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi:</label>
                  <input wire:model.blur="form.password_confirmation" type="password"
                    class="form-control @error('form.password_confirmation') is-invalid @enderror"
                    id="password_confirmation" placeholder="Konfirmasi kata sandi..">
                  <div>
                    @error('form.password_confirmation')
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
