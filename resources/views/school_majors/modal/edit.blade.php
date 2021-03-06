<div class="modal fade" id="editSchoolMajorModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Jurusan</h5>
                <button type="button" class="btn-close clear-input" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="school-major-edit-form">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Jurusan</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Masukkan nama jurusan..">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Singkatan Jurusan</label>
                                <input type="text" class="form-control" name="abbreviated_word" id="abbreviated_word"
                                    placeholder="Masukkan singkatan jurusan">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary clear-input" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>