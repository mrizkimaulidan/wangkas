<div>
  <div wire:ignore.self data-bs-backdrop="static" class="modal fade" id="createModal" tabindex="-1"
    aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createModalLabel">Tambah Data Pelajar</h1>
          <button wire:loading.attr="disabled" type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form wire:submit="save">
            <div class="row">
              <div class="col-6">
                <x-forms.input-with-icon wire:model.blur="form.identification_number" label="Nomor Identitas"
                  name="form.identification_number" type="number" placeholder="Masukan nomor identitas.."
                  icon="bi bi-person-badge" />
              </div>
              <div class="col-6">
                <x-forms.input-with-icon wire:model.blur="form.name" label="Nama Lengkap" name="form.name" type="text"
                  placeholder="Masukan nama lengkap.." icon="bi bi-person" />
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
                <x-forms.input-with-icon wire:model.blur="form.phone_number" label="Nomor Telepon"
                  name="form.phone_number" type="number" placeholder="Masukan nomor telepon.." icon="bi bi-telephone" />
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
