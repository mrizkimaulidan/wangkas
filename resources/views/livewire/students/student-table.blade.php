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
            <select wire:model.live="orderBy" class="form-select form-select-sm w-auto">
              <option value="asc">A-Z</option>
              <option value="desc">Z-A</option>
            </select>
          </div>

          <div class="col-auto">
            <select wire:model.live="orderByColumn" class="form-select form-select-sm w-auto">
              <option value="name">Name</option>
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
              <tr wire:loading.remove wire:key="{{ $student->id }}">
                <th scope="row">{{ $startIndex + $index }}</th>
                <td>{{ $student->identification_number }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->schoolClass->name }}</td>
                <td>{{ $student->schoolMajor->name }}</td>
                <td>{{ $student->school_year_start }} - {{ $student->school_year_end }}</td>
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

  <livewire:students.create-student />
  <livewire:students.edit-student />
  <livewire:students.delete-student />
</div>
