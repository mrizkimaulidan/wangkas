<div>
  <div class="row">
    <div class="col-6">
      <div class="card">
        <div class="card-body px-4">
          <div class="row">
            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
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
            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
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
            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
              <div class="stats-icon red">
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
            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
              <div class="stats-icon purple">
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
            <div class="col-sm-12 col-md-6 mb-3">
              <div class="p-3 border rounded">
                <h5 class="mb-1">{{ $student->name }}</h5>
                <h6 class="text-muted mb-0">{{ $student->identification_number }}</h6>
              </div>
            </div>
            @endforeach
          </div>

          <button type="button" class="btn btn-primary btn-block btn-xl font-bold" data-bs-toggle="modal"
            data-bs-target="#notPaidModal">
            Lihat Selengkapnya
          </button>

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

  <div wire:ignore.self data-bs-backdrop="static" class="modal fade" id="notPaidModal" tabindex="-1"
    aria-labelledby="notPaidModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="notPaidModalLabel">Daftar Pelajar Yang Belum Membayar</h1>
          <button wire:loading.attr="disabled" type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="row">
            @foreach ($statistics['studentsNotPaidThisWeek'] as $student)
            <div class="col-sm-12 col-md-6 mb-3">
              <div class="card border rounded">
                <div class="card-body">
                  <h5 class="card-title fw-bold">{{ $student->name }}</h5>
                  <p class="card-text text-muted">{{ $student->identification_number }}</p>
                  <p class="card-text text-muted">
                    <span class="badge bg-secondary"><i class="bi bi-telephone-fill"></i> {{ $student->phone_number
                      }}</span>
                  </p>
                  <span class="badge bg-primary"><i class="bi bi-bookmark"></i> {{ $student->schoolClass->name }}</span>
                  <span class="badge bg-success"><i class="bi bi-briefcase"></i> {{ $student->schoolMajor->name
                    }}</span>
                  <span class="badge bg-light-{{ $student->gender == 1 ? 'primary' : 'danger' }}">
                    <i class="bi bi-gender-{{ $student->gender == 1 ? 'male' : 'female' }}"></i>
                  </span>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>

        <div class="modal-footer">
          <button wire:loading.attr="disabled" type="button" class="btn btn-secondary"
            data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Daftar Transaksi Kas Minggu Ini</h5>
          <div class="d-flex flex-wrap justify-content-end mb-3 gap-3">
            <select wire:model.live="limit" class="form-select form-select-sm w-auto rounded">
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="15">15</option>
            </select>

            <select wire:model.live="orderByColumn" class="form-select form-select-sm w-auto rounded">
              <option value="amount">Total Bayar</option>
              <option value="date_paid">Tanggal Transaksi</option>
            </select>

            <select wire:model.live="orderBy" class="form-select form-select-sm w-auto rounded">
              <option value="asc">A-Z</option>
              <option value="desc">Z-A</option>
            </select>

            <button wire:click="resetFilter" type="button" class="btn btn-outline-warning btn-sm rounded">
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
                <div class="col-sm-12 col-md-6">
                  <label for="user_id" class="form-label">Dicatat Oleh:</label>
                  <select wire:model.live="filters.user_id" class="form-select" id="user_id">
                    <option value="" selected>Pilh Dicatat Oleh</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
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
                  <th scope="col">Nama Pelajar</th>
                  <th scope="col">Nama Total Bayar</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Dicatat Oleh</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr wire:loading>
                  <td colspan="6" class="text-center">
                    <div class="spinner-border" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                  </td>
                </tr>

                @php
                $startIndex = ($cashTransactions->currentPage() - 1) * $cashTransactions->perPage() + 1;
                @endphp

                @forelse ($cashTransactions as $index => $cashTransaction)
                <tr wire:key="{{ $cashTransaction->id }}">
                  <th scope="row">{{ $startIndex + $index }}</th>
                  <td class="text-uppercase fw-bold">{{ $cashTransaction->student->name }}</td>
                  <td>{{ local_amount_format($cashTransaction->amount) }}</td>
                  <td>{{ $cashTransaction->date_paid }}</td>
                  <td class="text-center">
                    <span class="badge bg-primary w-100">
                      <i class="bi bi-person-badge-fill"></i>
                      {{ $cashTransaction->createdBy->name }}
                    </span>
                  </td>
                  <td>
                    <div class="btn-group gap-1" role="group">
                      <button wire:loading.attr="disabled"
                        wire:click="$dispatch('cash-transaction-edit', {cashTransaction: {{ $cashTransaction->id }}})"
                        type="button" class="btn btn-sm btn-success rounded" data-bs-toggle="modal"
                        data-bs-target="#editModal">
                        <i class="bi bi-pencil-square"></i>
                      </button>
                      <button wire:loading.attr="disabled"
                        wire:click="$dispatch('cash-transaction-delete', {cashTransaction: {{ $cashTransaction->id }}})"
                        type="button" class="btn btn-sm btn-danger rounded" data-bs-toggle="modal"
                        data-bs-target="#deleteModal">
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
            {{ $cashTransactions->links(data: ['scrollTo' => false]) }}
          </div>
        </div>
      </div>
    </div>

    <livewire:cash-transactions.create-cash-transaction :$students />
    <livewire:cash-transactions.edit-cash-transaction :$students />
    <livewire:cash-transactions.delete-cash-transaction />
  </div>

  @script
  <script>
    const formCreate = document.getElementById('form.student_ids');
    new TomSelect(formCreate, {
      plugins: {
        remove_button: {
          title: 'Hapus'
        },
        clear_button: {
          title: 'Hapus semua'
        },
      }
    });
  </script>
  @endscript
</div>
