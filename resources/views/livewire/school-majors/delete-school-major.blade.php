<div>
  <div wire:ignore.self data-bs-backdrop="static" class="modal fade" id="deleteModal" tabindex="-1"
    aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Data Jurusan</h1>
          <button wire:loading.attr="disabled" type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form wire:submit="destroy">
            <p>Data tersebut akan dihapus!</p>

            <div class="modal-footer">
              <button wire:loading.attr="disabled" type="button" class="btn btn-primary"
                data-bs-dismiss="modal">Tutup</button>
              <button wire:loading.remove type="submit" class="btn btn-danger">Hapus</button>

              <div wire:loading wire:target="destroy">
                <button class="btn btn-danger" type="button" disabled>
                  <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                  <span role="status">Menghapus...</span>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
