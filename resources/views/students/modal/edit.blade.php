<div class="modal fade" id="editStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Siswa</h5>
                <button type="button" class="btn-close clear-input" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="edit-student-form">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="gender" id="gender">
                                    <option selected>Pilih jenis kelamin</option>
                                    <option value="1">Laki-laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label for="school_class_id" class="form-label">Kelas</label>
                                <select class="form-select" name="school_class_id" id="school_class_id">
                                    <option selected>Pilih kelas</option>
                                    @foreach($school_classes as $school_class)
                                    <option value="{{ $school_class->id }}">{{ $school_class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label for="school_major_id" class="form-label">Jurusan</label>
                                <select class="form-select" name="school_major_id" id="school_major_id">
                                    <option selected>Pilih jurusan</option>
                                    @foreach ($school_majors as $school_major)
                                    <option value="{{ $school_major->id }}">{{ $school_major->abbreviated_word }} -
                                        {{ $school_major->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Nomor Handphone</label>
                                <input type="text" class="form-control" name="phone_number" id="phone_number">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <label for="school_year_start">Tahun Ajaran</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="school_year_start" id="school_year_start">
                                <span class="input-group-text">-</span>
                                <input type="text" class="form-control" name="school_year_end" id="school_year_end">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary clear-input" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Ubah</button>
            </div>
            </form>
        </div>
    </div>
</div>