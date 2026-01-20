<div>
  <!-- Bagian Statistik -->
  <div class="row">
    <div class="col-md-6">
      <x-cards.statistic title="Total Hari Ini" icon="iconly-boldChart" color="purple"
        :count="$statistics['totalToday']" />
    </div>

    <div class="col-md-6">
      <x-cards.statistic title="Total Minggu Ini" icon="iconly-boldChart" color="purple"
        :count="$statistics['totalCurrentWeek']" />
    </div>

    <div class="col-md-6">
      <x-cards.statistic title="Total Bulan Ini" icon="iconly-boldChart" color="purple"
        :count="$statistics['totalCurrentMonth']" />
    </div>

    <div class="col-md-6">
      <x-cards.statistic title="Total Tahun Ini" icon="iconly-boldChart" color="purple"
        :count="$statistics['totalCurrentYear']" />
    </div>
  </div>

  <!-- Form Filter Tanggal -->
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header text-center">
          <h4>Filter Data dengan Rentang Tanggal</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="mb-3">
                <label for="start_date" class="form-label">Tanggal Awal:</label>
                <input wire:model.live="start_date" type="date" class="form-control" id="start_date"
                  placeholder="Pilih tanggal awal..">
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="mb-3">
                <label for="end_date" class="form-label">Tanggal Akhir:</label>
                <input wire:model.live="end_date" type="date" class="form-control" id="end_date"
                  placeholder="Pilih tanggal akhir..">
              </div>
            </div>
          </div>
          <div class="divider">
            <div class="divider-text fw-bold">Pilih menu filter di atas untuk mencari data</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bagian Belum Bayar -->
  @if($this->start_date && $this->end_date)
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header text-center">
          <h4>
            Daftar Yang Belum Membayar
            <span class="fw-bolder fst-italic">({{ $start_date }} sampai {{ $end_date }})</span>
          </h4>
        </div>
        <div class="card-body">
          <button type="button" class="btn btn-danger btn-block btn-xl font-bold" data-bs-toggle="modal"
            data-bs-target="#notPaidModal">
            Ada <b>{{ $statistics['studentsNotPaidCount'] }}</b> orang belum membayar pada rentang tanggal tersebut!
            <i class="bi bi-exclamation-triangle"></i>
          </button>

          <div class="row text-center mt-3">
            @foreach ($statistics['studentsNotPaidLimit'] as $student)
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
        </div>
      </div>
    </div>
  </div>
  @endif

  <!-- Modal Not Paid -->
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
            @foreach ($statistics['studentsNotPaid'] as $student)
            <div class="col-sm-12 col-md-6 mb-3">
              <div class="card border rounded">
                <div class="card-body">
                  <h5 class="card-title fw-bold">{{ $student->name }}</h5>
                  <p class="card-text text-muted">{{ $student->identification_number }}</p>
                  <p class="card-text text-muted">
                    <span class="badge bg-secondary">
                      <i class="bi bi-telephone-fill"></i> {{ $student->phone_number }}
                    </span>
                  </p>
                  <span class="badge bg-primary"><i class="bi bi-bookmark"></i> {{ $student->schoolClass->name }}</span>
                  <span class="badge bg-success"><i class="bi bi-briefcase"></i> {{ $student->schoolMajor->name
                    }}</span>
                  <span class="badge bg-light-{{ $student->gender == 1 ? 'primary' : 'danger' }}"><i
                      class="bi bi-gender-{{ $student->gender == 1 ? 'male' : 'female' }}"></i></span>
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

  @if($this->start_date && $this->end_date)
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Daftar Transaksi Kas Berdasarkan Filter Tanggal</h5>

          <div class="d-flex flex-wrap justify-content-end mb-3 gap-3">
            <select wire:model.live="perPage" class="form-select form-select-sm w-auto rounded">
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="15">15</option>
              <option value="20">20</option>
              <option value="25">25</option>
            </select>

            <select wire:model.live="sortBy" class="form-select form-select-sm w-auto rounded">
              <option value="amount">Total Bayar</option>
              <option value="date_paid">Tanggal Transaksi</option>
            </select>

            <select wire:model.live="sortOrder" class="form-select form-select-sm w-auto rounded">
              <option value="asc">A-Z</option>
              <option value="desc">Z-A</option>
            </select>

            <button wire:click="resetFilters" type="button" class="btn btn-outline-warning btn-sm rounded">
              <i class="bi bi-x-circle me-1"></i> Reset Filter
            </button>

            <button wire:click="$refresh" class="btn btn-outline-secondary btn-sm rounded">
              <i class="bi bi-arrow-clockwise me-1"></i> Refresh
            </button>
          </div>

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
                  <th scope="col">#</th>
                  <th scope="col">Nama Pelajar</th>
                  <th scope="col">Total Bayar</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Dicatat Oleh</th>
                </tr>
              </thead>
              <tbody>
                <tr wire:loading>
                  <td colspan="5" class="text-center">
                    <div class="spinner-border" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                  </td>
                </tr>

                @php
                $startIndex = ($filteredResult->currentPage() - 1) * $filteredResult->perPage() + 1;
                @endphp

                @forelse ($filteredResult as $index => $cashTransaction)
                <tr wire:key="{{ $cashTransaction->id }}">
                  <th scope="row">{{ $startIndex + $index }}</th>
                  <td class="text-uppercase fw-bold">
                    <div>{{ $cashTransaction->student->name }}</div>

                    <span class="badge bg-success mt-1">
                      <i class="bi bi-briefcase-fill"></i>
                      {{ $cashTransaction->student->schoolMajor->name }}
                    </span>

                    <span class="badge bg-primary mt-1">
                      <i class="bi bi-bookmark-fill"></i>
                      {{ $cashTransaction->student->schoolClass->name }}
                    </span>
                  </td>
                  <td>{{ local_amount_format($cashTransaction->amount) }}</td>
                  <td>{{ $cashTransaction->date_paid }}</td>
                  <td class="text-center">
                    <span class="badge bg-primary w-100">
                      <i class="bi bi-person-badge-fill"></i>
                      {{ $cashTransaction->createdBy->name }}
                    </span>
                  </td>
                </tr>
                @empty
                <tr wire:loading.remove class="text-center">
                  <th colspan="5" class="fw-bold">Tidak ada data yang ditemukan!</th>
                </tr>
                @endforelse
              </tbody>

              @if($filteredResult->isNotEmpty())
              <tfoot>
                <tr>
                  <td colspan="2" class="fw-bold">Total</td>
                  <td colspan="3">
                    <span class="fw-bold">{{ local_amount_format($sumAmountDateRange) }}</span>
                  </td>
                </tr>
              </tfoot>
              @endif
            </table>
            {{ $filteredResult->links(data: ['scrollTo' => false]) }}
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
</div>
