<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Daftar Kelas</h5>
        <div class="d-flex flex-wrap justify-content-end mb-3 gap-3">
          <select wire:model.live="limit" class="form-select form-select-sm w-auto rounded">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
          </select>

          <select wire:model.live="orderByColumn" class="form-select form-select-sm w-auto rounded">
            <option value="name">Nama Kelas</option>
            <option value="created_at">Baru Ditambahkan</option>
          </select>

          <select wire:model.live="orderBy" class="form-select form-select-sm w-auto rounded">
            <option value="asc">A-Z</option>
            <option value="desc">Z-A</option>
          </select>

          <button wire:click="resetFilter" type="button" class="btn btn-outline-warning btn-sm rounded">
            <i class="bi bi-x-circle me-1"></i> Reset Filter
          </button>

          <button type="button" class="btn btn-primary btn-sm rounded" data-bs-toggle="modal"
            data-bs-target="#createModal">
            <i class="bi bi-plus-circle me-1"></i> Tambah Data
          </button>

          <button wire:click="$refresh" class="btn btn-outline-secondary btn-sm rounded">
            <i class="bi bi-arrow-clockwise me-1"></i> Refresh
          </button>
        </div>

        <div class="mb-3">
          <div class="form-group has-icon-left">
            <div class="position-relative">
              <input wire:model.live="query" type="text" class="form-control form-control shadow-sm rounded fw-bold"
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
                <th scope="col">#</th>
                <th scope="col">Nama Kelas</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr wire:loading>
                <td colspan="3" class="text-center">
                  <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                </td>
              </tr>

              @php
              $startIndex = ($schoolClasses->currentPage() - 1) * $schoolClasses->perPage() + 1;
              @endphp
              @forelse ($schoolClasses as $index => $schoolClass)
              <tr wire:key="{{ $schoolClass->id }}">
                <th scope="row">{{ $startIndex + $index }}</th>
                <td>{{ $schoolClass->name }}</td>
                <td>
                  <div class="btn-group grid gap-1" role="group">
                    <button wire:loading.attr="disabled"
                      wire:click="$dispatch('school-class-edit', {schoolClass: {{ $schoolClass->id }}})" type="button"
                      class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal">
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <button wire:loading.attr="disabled"
                      wire:click="$dispatch('school-class-delete', {schoolClass: {{ $schoolClass->id }}})" type="button"
                      class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                      <i class="bi bi-trash-fill"></i>
                    </button>
                  </div>
                </td>
              </tr>
              @empty
              <tr wire:loading.remove class="text-center">
                <td colspan="3" class="fw-bold">Tidak ada data yang ditemukan!</td>
              </tr>
              @endforelse
            </tbody>
          </table>

          {{ $schoolClasses->links(data: ['scrollTo' => false]) }}
        </div>
      </div>
    </div>
  </div>

  <livewire:school-classes.create-school-class />
  <livewire:school-classes.edit-school-class />
  <livewire:school-classes.delete-school-class />
</div>
