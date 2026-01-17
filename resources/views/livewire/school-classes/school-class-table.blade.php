<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Daftar Kelas</h5>
        <div class="d-flex flex-wrap justify-content-end mb-3 gap-3">
          <select wire:model.live="perPage" class="form-select form-select-sm w-auto rounded">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="25">25</option>
          </select>

          <select wire:model.live="sortBy" class="form-select form-select-sm w-auto rounded">
            <option value="name">Nama Kelas</option>
            <option value="created_at">Baru Ditambahkan</option>
          </select>

          <select wire:model.live="sortOrder" class="form-select form-select-sm w-auto rounded">
            <option value="asc">A-Z</option>
            <option value="desc">Z-A</option>
          </select>

          <button wire:click="resetFilters" type="button" class="btn btn-outline-warning btn-sm rounded">
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

        @if($this->validSelectedCount > 0)
        <div class="alert alert-warning border-start border-warning border-5 bg-warning bg-opacity-10" role="alert">
          <div
            class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
              <span class="badge rounded-pill bg-warning text-dark fs-6 px-3 py-2">
                {{ $this->validSelectedCount }}
              </span>
              <span class="fw-medium">Data kelas terpilih untuk dihapus</span>
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
                  wire:click="$dispatch('school-class-delete', {schoolClass: {{ json_encode($this->validSelectedIDs) }}})"
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
                <th scope="col">Nama Kelas</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr wire:loading>
                <td colspan="4" class="text-center">
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
                <th>
                  <div class="form-check">
                    <input wire:model.live="selectedIDs" class="form-check-input" type="checkbox"
                      value="{{ $schoolClass->id }}" id="check">
                  </div>
                </th>
                <th scope="row">{{ $startIndex + $index }}</th>
                <td>{{ $schoolClass->name }}</td>
                <td>
                  <div class="btn-group grid gap-1" role="group">
                    <button wire:loading.attr="disabled"
                      wire:click="$dispatch('school-class-edit', {schoolClass: {{ $schoolClass->id }}})" type="button"
                      class="btn btn-sm btn-success rounded" data-bs-toggle="modal" data-bs-target="#editModal">
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <button wire:loading.attr="disabled"
                      wire:click="$dispatch('school-class-delete', {schoolClass: {{ $schoolClass->id }}})" type="button"
                      class="btn btn-sm btn-danger rounded" data-bs-toggle="modal" data-bs-target="#deleteModal">
                      <i class="bi bi-trash-fill"></i>
                    </button>
                  </div>
                </td>
              </tr>
              @empty
              <tr wire:loading.remove class="text-center">
                <td colspan="4" class="fw-bold">Tidak ada data yang ditemukan!</td>
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
