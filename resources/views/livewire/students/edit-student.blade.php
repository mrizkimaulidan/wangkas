<div>
  <div wire:ignore.self data-bs-backdrop="static" class="modal fade" id="editModal" tabindex="-1"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Ubah Data Pelajar</h1>
          <button wire:loading.attr="disabled" type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form wire:submit="edit">
            <div class="row">
              <div class="col-6">
                <div class="mb-3">
                  <label for="identification_number" class="form-label">Nomor Identitas:</label>
                  <input wire:model.blur="form.identification_number" type="text"
                    class="form-control @error('form.identification_number') is-invalid @enderror"
                    id="identification_number" placeholder="Masukan nomor identitas..">
                  <div>
                    @error('form.identification_number')
                    <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-6">
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
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="mb-3">
                  <label for="gender" class="form-label">Jenis Kelamin:</label>
                  <select wire:model.blur="form.gender" class="form-select @error('form.gender') is-invalid @enderror"
                    id="gender">
                    <option selected>Pilih Jenis Kelamin</option>
                    <option value="1">Laki-laki</option>
                    <option value="2">Perempuan</option>
                  </select>
                  <div>
                    @error('form.gender')
                    <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="col-6">
                <div class="mb-3">
                  <label for="phone_number" class="form-label">Nomor Telepon:</label>
                  <input wire:model.blur="form.phone_number" type="text"
                    class="form-control @error('form.phone_number') is-invalid @enderror" id="phone_number"
                    placeholder="Masukan nomor telepon..">
                  <div>
                    @error('form.phone_number')
                    <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="mb-3">
                  <label for="school_class_id" class="form-label">Kelas:</label>
                  <select wire:model.blur="form.school_class_id"
                    class="form-select @error('form.school_class_id') is-invalid @enderror" id="school_class_id">
                    <option selected>Pilih Kelas</option>
                    @foreach ($schoolClasses as $schoolClass)
                    <option value="{{ $schoolClass->id }}">{{ $schoolClass->name }}</option>
                    @endforeach
                  </select>
                  <div>
                    @error('form.school_class_id')
                    <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="mb-3">
                  <label for="school_major_id" class="form-label">Jurusan:</label>
                  <select wire:model.blur="form.school_major_id"
                    class="form-select @error('form.school_major_id') is-invalid @enderror" id="school_major_id">
                    <option selected>Pilih Jurusan</option>
                    @foreach ($schoolMajors as $schoolMajor)
                    <option value="{{ $schoolMajor->id }}">{{ $schoolMajor->name }}</option>
                    @endforeach
                  </select>
                  <div>
                    @error('form.school_major_id')
                    <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <label for="school_year_start" class="form-label">Tahun Masuk dan Lulus:</label>
                <div class="input-group mb-3">
                  <input wire:model.blur="form.school_year_start" type="text"
                    class="form-control @error('form.school_year_start') is-invalid @enderror" id="school_year_start"
                    placeholder="Masukan tahun masuk..">
                  <span class="input-group-text">-</span>
                  <input wire:model.blur="form.school_year_end" type="text"
                    class="form-control @error('form.school_year_end') is-invalid @enderror" id="school_year_end"
                    placeholder="Masukan tahun lulus..">
                </div>
                <div>
                  @error('form.school_year_start')
                  <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                  @enderror
                </div>
                <div>
                  @error('form.school_year_end')
                  <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                  @enderror
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
