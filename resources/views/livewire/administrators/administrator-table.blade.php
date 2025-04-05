<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Daftar Administrator</h5>
        <div class="d-flex flex-wrap justify-content-end mb-3 gap-3">
          <select wire:model.live="limit" class="form-select form-select-sm w-auto rounded">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
          </select>

          <select wire:model.live="orderByColumn" class="form-select form-select-sm w-auto rounded">
            <option value="name">Nama Lengkap</option>
            <option value="email">Alamat Email</option>
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
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Alamat Email</th>
                <th scope="col">Tanggal Ditambahkan</th>
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
              $startIndex = ($administrators->currentPage() - 1) * $administrators->perPage() + 1;
              @endphp

              @forelse ($administrators as $index => $administrator)
              <tr wire:key="{{ $administrator->id }}">
                <th scope="row">{{ $startIndex + $index }}</th>
                <td>{{ $administrator->name }}</td>
                <td>{{ $administrator->masked_email }}</td>
                <td>{{ $administrator->created_at }}</td>
                <td>
                  <div class="btn-group grid gap-1" role="group">
                    <button wire:loading.attr="disabled"
                      wire:click="$dispatch('administrator-show', {user: {{ $administrator->id }}})" type="button"
                      class="btn btn-sm btn-success rounded" data-bs-toggle="modal" data-bs-target="#showModal">
                      <i class="bi bi-info-circle-fill"></i>
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

          {{ $administrators->links(data: ['scrollTo' => false]) }}
        </div>
      </div>
    </div>
  </div>

  <livewire:administrators.create-administrator />
  <livewire:administrators.show-administrator />
</div>
