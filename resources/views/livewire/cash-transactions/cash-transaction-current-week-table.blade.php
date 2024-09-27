<div class="row">
  <div class="row">
    <div class="col-6">
      <div class="card">
        <div class="card-body px-4">
          <div class="row">
            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
              <div class="stats-icon">
                <i class="iconly-boldChart"></i>
              </div>
            </div>
            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
              <h6 class="text-muted font-semibold">Total Bulan Ini</h6>
              <h6 class="font-extrabold mb-0">{{ $statistics['totalCurrentMonth'] }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card">
        <div class="card-body px-4">
          <div class="row">
            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
              <div class="stats-icon">
                <i class="iconly-boldChart"></i>
              </div>
            </div>
            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
              <h6 class="text-muted font-semibold">Total Tahun Ini</h6>
              <h6 class="font-extrabold mb-0">{{ $statistics['totalCurrentYear'] }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-6">
      <div class="card">
        <div class="card-body px-4">
          <div class="row">
            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
              <div class="stats-icon green">
                <i class="iconly-boldActivity"></i>
              </div>
            </div>
            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
              <h6 class="text-muted font-semibold">Sudah Membayar Minggu Ini</h6>
              <h6 class="font-extrabold mb-0">{{ $statistics['studentsPaidThisWeekCount'] }}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card">
        <div class="card-body px-4">
          <div class="row">
            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
              <div class="stats-icon red">
                <i class="iconly-boldActivity"></i>
              </div>
            </div>
            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
              <h6 class="text-muted font-semibold">Belum Membayar Minggu Ini</h6>
              <h6 class="font-extrabold mb-0">{{ $statistics['studentsNotPaidThisWeekCount'] }}</h6>
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
          @if($statistics['studentsNotPaidThisWeekCount'] > 0)
          <h4>
            Daftar Yang Belum Membayar Minggu Ini
            <span class="fw-bolder fst-italic">({{ $currentWeek['startOfWeek'] }} sampai {{ $currentWeek['endOfWeek']
              }})</span>
          </h4>
          @endif
        </div>

        <div class="card-body">
          @if($statistics['studentsNotPaidThisWeekCount'] > 0)
          <button type="button" class="btn btn-danger btn-block btn-xl font-bold" data-bs-toggle="modal"
            data-bs-target="#notPaidModal">
            Ada <b>{{ $statistics['studentsNotPaidThisWeekCount'] }}</b> orang belum membayar pada minggu ini! <i
              class="bi bi-exclamation-triangle"></i>
          </button>

          <div class="row text-center mt-3">
            @foreach ($statistics['studentsNotPaidThisWeekLimit'] as $student)
            <div class="col-6 mb-3">
              <div class="p-3 border rounded">
                <h5 class="mb-1">{{ $student->name }}</h5>
                <h6 class="text-muted mb-0">{{ $student->identification_number }}</h6>
              </div>
            </div>
            @endforeach
          </div>
          <button type="button" class="btn btn-primary btn-block btn-xl font-bold" data-bs-toggle="modal"
            data-bs-target="#notPaidModal">Lihat Selengkapnya</button>

          <livewire:cash-transactions.not-paid-modal :students="$statistics['studentsNotPaidThisWeek']" />
          @else
          <button type="button" class="btn btn-success btn-block btn-xl font-bold" data-bs-toggle="modal"
            data-bs-target="#notPaidModal">
            Semua sudah membayar pada minggu ini! <i class="bi bi-emoji-smile"></i>
          </button>
          @endif
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
              <tr wire:key="{{ $cashTransaction->id }}">
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
                <th colspan="6" class="fw-bold">Tidak ada data yang ditemukan!</th>
              </tr>
              @endforelse
            </tbody>
          </table>

          {{ $cashTransactions->links() }}
        </div>
      </div>
    </div>
  </div>

  <livewire:cash-transactions.create-cash-transaction :$students />
  <livewire:cash-transactions.edit-cash-transaction :$students />
  <livewire:cash-transactions.delete-cash-transaction />
</div>
