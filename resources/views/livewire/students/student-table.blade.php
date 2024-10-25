<div class="row">
  <div class="col-12">
    <div class="card">

      <div class="card-body">
        <h5 class="card-title">Daftar Pelajar</h5>

        <div class="d-flex flex-wrap flex-row-reverse mb-3 gap-2">
          <div class="col-auto">
            <button wire:click="$refresh" class="btn btn-sm btn-light"><i class="bi bi-arrow-clockwise"></i></button>
          </div>

          <div class="col-auto">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
              Tambah Data
            </button>
          </div>

          <div class="col-auto">
            <button wire:click="resetFilter" type="button" class="btn btn-outline-warning">Reset filter</button>
          </div>

          <div class="col-auto">
            <p class="d-inline-flex gap-1">
              <a class="btn btn-primary" data-bs-toggle="collapse" href="#filterCollapse" role="button"
                aria-expanded="false" aria-controls="filterCollapse">
                Menu Filter
              </a>
            </p>
          </div>

          <div class="col-auto">
            <select wire:model.live="orderBy" class="form-select form-select-sm w-auto">
              <option value="asc">A-Z</option>
              <option value="desc">Z-A</option>
            </select>
          </div>

          <div class="col-auto">
            <select wire:model.live="orderByColumn" class="form-select form-select-sm w-auto">
              <option value="identification_number">Nomor Identitas</option>
              <option value="name">Nama Lengkap</option>
              <option value="created_at">Baru Ditambahkan</option>
            </select>
          </div>

          <div class="col-auto">
            <select wire:model.live="limit" class="form-select form-select-sm w-auto">
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="15">15</option>
            </select>
          </div>

          <div class="col-12 col-md-auto mt-2 mt-md-0">
            <form class="d-inline-block w-100">
              <input wire:model.live="query" type="text" class="form-control form-control-sm shadow-sm fw-bold"
                placeholder="Masukan keyword pencarian..">
            </form>
          </div>
        </div>

        <div wire:ignore.self class="collapse border mb-3" id="filterCollapse">
          <div class="card card-body">
            <div class="row">
              <div class="col">
                <label for="school_class_id" class="form-label">Kelas:</label>
                <select wire:model.live="filters.schoolClassID" class="form-select" id="school_class_id">
                  <option value="" selected>Pilh Kelas</option>
                  @foreach ($schoolClasses as $schoolClass)
                  <option value="{{ $schoolClass->id }}">{{ $schoolClass->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col">
                <label for="school_major_id" class="form-label">Jurusan:</label>
                <select wire:model.live="filters.schoolMajorID" class="form-select" id="school_major_id">
                  <option value="" selected>Pilh Jurusan</option>
                  @foreach ($schoolMajors as $schoolMajor)
                  <option value="{{ $schoolMajor->id }}">{{ $schoolMajor->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col">
                <label for="gender" class="form-label">Jenis Kelamin:</label>
                <select wire:model.live="filters.gender" class="form-select" id="gender">
                  <option value="" selected>Pilh Jenis Kelamin</option>
                  <option value="1">Laki-laki</option>
                  <option value="2">Perempuan</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nomor Identitas</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Kelas</th>
                <th scope="col">Jurusan</th>
                <th scope="col">TA (Tahun Ajaran)</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr wire:loading>
                <td colspan="3">
                  <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                  </div>
                </td>
              </tr>

              @php
              $startIndex = ($students->currentPage() - 1) * $students->perPage() + 1;
              @endphp

              @forelse ($students as $index => $student)
              <tr wire:key="{{ $student->id }}">
                <th scope="row">{{ $startIndex + $index }}</th>
                <td class="fw-bold">{{ $student->identification_number }}</td>
                <td>
                  <span class="text-uppercase">{{ $student->name }}</span>
                  <span class="badge bg-light-{{ $student->gender == 1 ? 'primary' : 'danger' }}">
                    <i class="bi bi-gender-{{ $student->gender == 1 ? 'male' : 'female' }}"></i>
                  </span>
                </td>
                <td class="text-center">
                  <span class="badge bg-primary w-100">
                    <i class="bi bi-bookmark-fill"></i>
                    {{ $student->schoolClass->name }}
                  </span>
                </td>
                <td class="text-center">
                  <span class="badge bg-success w-100">
                    <i class="bi bi-briefcase-fill"></i>
                    {{ $student->schoolMajor->name }}
                  </span>
                </td>
                <td class="text-center">
                  <span class="badge bg-info w-100">
                    <i class="bi bi-calendar-event"></i>
                    {{ $student->school_year_start }} - {{ $student->school_year_end }}
                  </span>
                </td>
                <td>
                  <div class="btn-group grid gap-1" role="group">
                    <button wire:loading.attr="disabled"
                      wire:click="$dispatch('student-edit', {id: {{ $student->id }}})" type="button"
                      class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal">
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <button wire:loading.attr="disabled"
                      wire:click="$dispatch('student-delete', {id: {{ $student->id }}})" type="button"
                      class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                      <i class="bi bi-trash-fill"></i>
                    </button>
                  </div>
                </td>
              </tr>
              @empty
              <tr wire:loading.remove class="text-center">
                <th colspan="3" class="fw-bold">Tidak ada data yang ditemukan!</th>
              </tr>
              @endforelse
            </tbody>
          </table>

          {{ $students->links() }}
        </div>
      </div>
    </div>
  </div>

  <livewire:students.create-student :$schoolClasses :$schoolMajors />
  <livewire:students.edit-student :$schoolClasses :$schoolMajors />
  <livewire:students.delete-student />
</div>
