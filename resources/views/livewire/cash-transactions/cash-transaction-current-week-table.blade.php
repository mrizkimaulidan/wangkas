<div class="row">
  <div class="row">
    <div class="col-6">
      <div class="card">
        <div class="card-body px-4 py-4-5">
          <div class="row">
            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
              <div class="stats-icon">
                <i class="iconly-boldChart"></i>
              </div>
            </div>
            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
              <h6 class="text-muted font-semibold">Total Bulan Ini</h6>
              <h6 class="font-extrabold mb-0">Rp100.000</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card">
        <div class="card-body px-4 py-4-5">
          <div class="row">
            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
              <div class="stats-icon">
                <i class="iconly-boldChart"></i>
              </div>
            </div>
            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
              <h6 class="text-muted font-semibold">Total Tahun Ini</h6>
              <h6 class="font-extrabold mb-0">Rp1.000.000</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-6">
      <div class="card">
        <div class="card-body px-4 py-4-5">
          <div class="row">
            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
              <div class="stats-icon green">
                <i class="iconly-boldActivity"></i>
              </div>
            </div>
            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
              <h6 class="text-muted font-semibold">Sudah Membayar Minggu Ini</h6>
              <h6 class="font-extrabold mb-0">0</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card">
        <div class="card-body px-4 py-4-5">
          <div class="row">
            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
              <div class="stats-icon red">
                <i class="iconly-boldActivity"></i>
              </div>
            </div>
            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
              <h6 class="text-muted font-semibold">Belum Membayar Minggu Ini</h6>
              <h6 class="font-extrabold mb-0">0</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header text-center">
          <h4>
            Belum Membayar Minggu Ini
            <span class="fw-bolder fst-italic">(16-09-2024 sampai 22-09-2024)</span>
          </h4>
        </div>
        <div class="card-body">
          <button type="button" class="btn btn-danger btn-block btn-xl font-bold" data-bs-toggle="modal"
            data-bs-target="#notPaidModal">
            Ada <b>21</b> orang belum membayar pada minggu ini! <i class="bi bi-exclamation-triangle"></i>
          </button>

          <div class="row text-center mt-3">
            <!-- Student Information Cards -->
            <div class="col-6 mb-3">
              <div class="p-3 border rounded">
                <h5 class="mb-1">Antoinette Swift Sr.</h5>
                <h6 class="text-muted mb-0">246125459</h6>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="p-3 border rounded">
                <h5 class="mb-1">Arlie Rutherford</h5>
                <h6 class="text-muted mb-0">246128989</h6>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="p-3 border rounded">
                <h5 class="mb-1">Darwin Rempel</h5>
                <h6 class="text-muted mb-0">246137309</h6>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="p-3 border rounded">
                <h5 class="mb-1">Devonte Rolfson</h5>
                <h6 class="text-muted mb-0">246131946</h6>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="p-3 border rounded">
                <h5 class="mb-1">Dr. Alexandre Braun Jr.</h5>
                <h6 class="text-muted mb-0">246118023</h6>
              </div>
            </div>
            <div class="col-6 mb-3">
              <div class="p-3 border rounded">
                <h5 class="mb-1">Earnest Wilkinson</h5>
                <h6 class="text-muted mb-0">246128443</h6>
              </div>
            </div>
          </div>
          <button type="button" class="btn btn-primary btn-block btn-xl font-bold" data-bs-toggle="modal"
            data-bs-target="#notPaidModal">Lihat Selengkapnya</button>
        </div>

        <!-- Modal -->
        <div wire:ignore.self data-bs-backdrop="static" class="modal fade" id="notPaidModal" tabindex="-1"
          aria-labelledby="notPaidModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="notPaidModalLabel">Daftar Pelajar Yang Belum Membayar Minggu Ini</h1>
                <button wire:loading.attr="disabled" type="button" class="btn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <!-- Student Details Cards -->
                  <div class="col-6 mb-3">
                    <div class="card border rounded">
                      <div class="card-body">
                        <h5 class="card-title fw-bold">Antoinette Swift Sr.</h5>
                        <p class="card-text text-muted">246125459</p>
                        <p class="card-text text-muted">
                          <span class="badge bg-secondary">
                            <i class="bi bi-telephone-fill"></i> (769) 528-2610
                          </span>
                        </p>
                        <span class="badge bg-primary"><i class="bi bi-bookmark"></i> est</span>
                        <span class="badge bg-success"><i class="bi bi-briefcase"></i> voluptatem</span>
                        <span class="badge bg-info"><i class="bi bi-gender-male"></i></span>
                      </div>
                    </div>
                  </div>
                  <!-- Additional student details can be added here -->
                </div>
              </div>
              <div class="modal-footer">
                <button wire:loading.attr="disabled" type="button" class="btn btn-secondary"
                  data-bs-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="card">

      <div class="card-body">
        <h5 class="card-title">Daftar Transaksi Kas Minggu Ini</h5>

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
                <th scope="col">Nama Pelajar</th>
                <th scope="col">Nama Total Bayar</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Dicatat Oleh</th>
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
              $startIndex = ($cashTransactions->currentPage() - 1) * $cashTransactions->perPage() + 1;
              @endphp

              @forelse ($cashTransactions as $index => $cashTransaction)
              <tr wire:loading.remove wire:key="{{ $cashTransaction->id }}">
                <th scope="row">{{ $startIndex + $index }}</th>
                <td>{{ $cashTransaction->student->name }}</td>
                <td>{{ $cashTransaction->amount }}</td>
                <td>{{ $cashTransaction->date_paid }}</td>
                <td>{{ $cashTransaction->createdBy->name }}</td>
                <td>
                  <div class="btn-group grid gap-1" role="group">
                    <button wire:loading.attr="disabled"
                      wire:click="$dispatch('cash-transaction-edit', {id: {{ $cashTransaction->id }}})" type="button"
                      class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal">
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <button wire:loading.attr="disabled"
                      wire:click="$dispatch('cash-transaction-delete', {id: {{ $cashTransaction->id }}})" type="button"
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

          {{ $cashTransactions->links() }}
        </div>
      </div>
    </div>
  </div>

  <livewire:cash-transactions.create-cash-transaction />
  <livewire:cash-transactions.delete-cash-transaction />
</div>
