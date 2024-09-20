<div>
  <div wire:ignore.self data-bs-backdrop="static" class="modal fade" id="showModal" tabindex="-1"
    aria-labelledby="showModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="showModalLabel">Detail Data Administrator</h1>
          <button wire:loading.attr="disabled" type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap:</label>
                <input wire:model="name" type="text" class="form-control" disabled>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Alamat Email:</label>
                <input wire:model="email" type="email" class="form-control" disabled>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button wire:loading.attr="disabled" type="button" class="btn btn-secondary"
              data-bs-dismiss="modal">Tutup</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>