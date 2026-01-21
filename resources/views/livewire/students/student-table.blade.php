<div>
  <div class="row">
    <div class="col-6">
      <x-cards.statistic title="Laki-laki" icon="iconly-boldProfile" color="blue" :count="$studentGenders['male']" />
    </div>

    <div class="col-6">
      <x-cards.statistic title="Perempuan" icon="iconly-boldProfile" color="red" :count="$studentGenders['female']" />
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Daftar Pelajar</h5>
          <div class="d-flex flex-wrap justify-content-end mb-3 gap-3">
            <select wire:model.live="perPage" class="form-select form-select-sm w-auto rounded">
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="15">15</option>
              <option value="20">20</option>
              <option value="25">25</option>
            </select>

            <select wire:model.live="sortBy" class="form-select form-select-sm w-auto rounded">
              <option value="identification_number">Nomor Identitas</option>
              <option value="name">Nama Lengkap</option>
              <option value="created_at">Baru Ditambahkan</option>
            </select>

            <select wire:model.live="sortOrder" class="form-select form-select-sm w-auto rounded">
              <option value="asc">A-Z</option>
              <option value="desc">Z-A</option>
            </select>

            <button wire:click="resetFilters" type="button" class="btn btn-outline-warning btn-sm rounded">
              <i class="bi bi-x-circle me-1"></i> Reset Filter
            </button>

            <a class="btn btn-primary btn-sm" data-bs-toggle="collapse" href="#filterCollapse" role="button"
              aria-expanded="false" aria-controls="filterCollapse">
              <i class="bi bi-funnel me-1"></i> Menu Filter
            </a>

            <button type="button" class="btn btn-primary btn-sm rounded" data-bs-toggle="modal"
              data-bs-target="#createModal">
              <i class="bi bi-plus-circle me-1"></i> Tambah Data
            </button>

            <button wire:click="$refresh" class="btn btn-outline-secondary btn-sm rounded">
              <i class="bi bi-arrow-clockwise me-1"></i> Refresh
            </button>
          </div>

          <div wire:ignore.self class="collapse border mb-3" id="filterCollapse">
            <div class="card card-body">
              <div class="row">
                <div class="col-sm-12 col-md-4">
                  <label for="school_class_id" class="form-label">Kelas:</label>
                  <select wire:model.live="filterSchoolClassID" class="form-select" id="school_class_id">
                    <option value="" selected>Pilih Kelas</option>
                    @foreach ($schoolClasses as $schoolClass)
                    <option value="{{ $schoolClass->id }}">{{ $schoolClass->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-12 col-md-4">
                  <label for="school_major_id" class="form-label">Jurusan:</label>
                  <select wire:model.live="filterSchoolMajorID" class="form-select" id="school_major_id">
                    <option value="" selected>Pilih Jurusan</option>
                    @foreach ($schoolMajors as $schoolMajor)
                    <option value="{{ $schoolMajor->id }}">{{ $schoolMajor->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-12 col-md-4">
                  <label for="gender" class="form-label">Jenis Kelamin:</label>
                  <select wire:model.live="gender" class="form-select" id="gender">
                    <option value="" selected>Pilih Jenis Kelamin</option>
                    <option value="1">Laki-laki</option>
                    <option value="2">Perempuan</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          @if($this->validSelectedCount > 0)
          <div class="alert alert-warning border-start border-warning border-5 bg-warning bg-opacity-10" role="alert">
            <div
              class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
              <div class="d-flex align-items-center gap-3">
                <span class="badge rounded-pill bg-warning text-dark fs-6 px-3 py-2">
                  {{ $this->validSelectedCount }}
                </span>
                <span class="fw-medium">Data pelajar terpilih untuk dihapus</span>
              </div>
              <div class="d-flex flex-wrap align-items-center gap-2">
                <div class="form-check mb-0">
                  <input wire:model.live="isSelectAllChecked" class="form-check-input" type="checkbox" id="select-all">
                  <label class="form-check-label fw-medium" for="select-all">
                    Pilih semua
                  </label>
                </div>
                <div class="vr d-none d-md-block"></div>
                <div class="d-flex gap-2">
                  <button
                    wire:click="$dispatch('student-delete', {student: {{ json_encode($this->validSelectedIDs) }}})"
                    class="btn btn-sm btn-danger d-flex align-items-center gap-1" data-bs-toggle="modal"
                    data-bs-target="#deleteModal">
                    <span>Hapus</span>
                  </button>
                  <button wire:click="$set('selectedIDs', [])"
                    class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
                    <span>Batal</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
          @endif

          <div class="mb-3">
            <div class="form-group has-icon-left">
              <div class="position-relative">
                <input wire:model.live="search" type="text" class="form-control form-control shadow-sm rounded fw-bold"
                  placeholder="Masukan keyword pencarian...">
                <div class="form-control-icon">
                  <i class="bi bi-search"></i>
                </div>
              </div>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">#</th>
                  <th scope="col">Nomor Identitas</th>
                  <th scope="col">Nama Lengkap</th>
                  <th scope="col">Jurusan</th>
                  <th scope="col">Kelas</th>
                  <th scope="col">TA (Tahun Ajaran)</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr wire:loading>
                  <td colspan="8" class="text-center">
                    <div class="spinner-border" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                  </td>
                </tr>

                @php
                $startIndex = ($students->currentPage() - 1) * $students->perPage() + 1;
                @endphp

                @forelse ($students as $index => $student)
                <tr wire:loading.remove wire:key="{{ $student->id }}">
                  <th>
                    <div class="form-check">
                      <input wire:model.live="selectedIDs" class="form-check-input" type="checkbox"
                        value="{{ $student->id }}" id="check">
                    </div>
                  </th>
                  <th scope="row">{{ $startIndex + $index }}</th>
                  <td class="fw-bold">{{ $student->identification_number }}</td>
                  <td>
                    <span class="text-uppercase">{{ $student->name }}</span>
                    <span class="badge bg-light-{{ $student->gender == 1 ? 'primary' : 'danger' }}">
                      <i class="bi bi-gender-{{ $student->gender == 1 ? 'male' : 'female' }}"></i>
                    </span>
                  </td>
                  <td class="text-center">
                    <span class="badge bg-success w-100">
                      <i class="bi bi-briefcase-fill"></i>
                      {{ $student->schoolMajor->name }}
                    </span>
                  </td>
                  <td class="text-center">
                    <span class="badge bg-primary w-100">
                      <i class="bi bi-bookmark-fill"></i>
                      {{ $student->schoolClass->name }}
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
                        wire:click="$dispatch('student-edit', {student: {{ $student->id }}})" type="button"
                        class="btn btn-sm btn-success rounded" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i class="bi bi-pencil-square"></i>
                      </button>
                      <button wire:loading.attr="disabled"
                        wire:click="$dispatch('student-delete', {student: {{ $student->id }}})" type="button"
                        class="btn btn-sm btn-danger rounded" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="bi bi-trash-fill"></i>
                      </button>
                    </div>
                  </td>
                </tr>
                @empty
                <tr wire:loading.remove class="text-center">
                  <th colspan="8" class="fw-bold">Tidak ada data yang ditemukan!</th>
                </tr>
                @endforelse
              </tbody>
            </table>

            {{ $students->links(data: ['scrollTo' => false]) }}
          </div>
        </div>
      </div>
    </div>

    <livewire:students.create-student :$schoolClasses :$schoolMajors />
    <livewire:students.edit-student :$schoolClasses :$schoolMajors />
    <livewire:students.delete-student />
  </div>
</div>