<div class="modal fade" id="addSchoolMajorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('jurusan.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Masukkan nama jurusan.." required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Singkatan</label>
                                <input type="text" class="form-control" name="abbreviated word" id="abbreviated word"
                                    placeholder="Masukkan singkatan jurusan.." required>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>