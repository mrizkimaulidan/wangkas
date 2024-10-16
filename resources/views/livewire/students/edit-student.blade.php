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
              <div class="col-sm-12 col-md-6">
                <x-forms.input-with-icon wire:model.blur="form.identification_number" label="Nomor Identitas"
                  name="form.identification_number" type="number" placeholder="Masukan nomor identitas.."
                  icon="bi bi-person-badge" />
              </div>
              <div class="col-sm-12 col-md-6">
                <x-forms.input-with-icon wire:model.blur="form.name" label="Nama Lengkap" name="form.name" type="text"
                  placeholder="Masukan nama lengkap.." icon="bi bi-person" />
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 col-md-6">
                <x-forms.select-with-icon wire:model.blur="form.gender" label="Pilih Jenis Kelamin" name="form.gender"
                  icon="bi bi-gender-male">
                  <option value="1">Laki-laki</option>
                  <option value="2">Perempuan</option>
                </x-forms.select-with-icon>
              </div>

              <div class="col-sm-6 col-md-6">
                <x-forms.input-with-icon wire:model.blur="form.phone_number" label="Nomor Telepon"
                  name="form.phone_number" type="number" placeholder="Masukan nomor telepon.." icon="bi bi-telephone" />
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 col-md-6">
                <x-forms.select-with-icon wire:model.blur="form.school_class_id" label="Pilih Kelas"
                  name="form.school_class_id" icon="bi bi-bookmark-fill">
                  @foreach ($schoolClasses as $schoolClass)
                  <option value="{{ $schoolClass->id }}">{{ $schoolClass->name }}</option>
                  @endforeach
                </x-forms.select-with-icon>
              </div>
              <div class="col-sm-6 col-md-6">
                <x-forms.select-with-icon wire:model.blur="form.school_major_id" label="Pilih Jurusan"
                  name="form.school_major_id" icon="bi bi-briefcase-fill">
                  @foreach ($schoolMajors as $schoolMajor)
                  <option value="{{ $schoolMajor->id }}">{{ $schoolMajor->name }}</option>
                  @endforeach
                </x-forms.select-with-icon>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 col-md-6">
                <x-forms.input-with-icon wire:model.blur="form.school_year_start" label="Tahun Masuk"
                  name="form.school_year_start" type="number" placeholder="Masukan tahun masuk.."
                  icon="bi bi-calendar" />
              </div>
              <div class="col-sm-6 col-md-6">
                <x-forms.input-with-icon wire:model.blur="form.school_year_end" label="Tahun Lulus"
                  name="form.school_year_end" type="number" placeholder="Masukan tahun lulus.."
                  icon="bi bi-calendar-event" />
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