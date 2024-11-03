<div>
  <div class="row">
    <div class="col-6">
      <div class="card">
        <div class="card-body px-4">
          <div class="row">
            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
              <div class="stats-icon purple">
                <i class="iconly-boldChart"></i>
              </div>
            </div>
            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
              <h6 class="text-muted font-semibold">Total Hari Ini</h6>
              <h6 class="font-extrabold mb-0">{{ $statistics['totalToday'] }}</h6>
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
              <div class="stats-icon purple">
                <i class="iconly-boldChart"></i>
              </div>
            </div>
            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
              <h6 class="text-muted font-semibold">Total Minggu Ini</h6>
              <h6 class="font-extrabold mb-0">{{ $statistics['totalCurrentWeek'] }}</h6>
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
              <div class="stats-icon purple">
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
              <div class="stats-icon purple">
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
    <div class="col-12">
      <div class="card">

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

          @if($statistics['studentsNotPaidCount'] > 0)
          <div class="card">
            <div class="card-body">
              <button type="button" class="btn btn-danger btn-block btn-xl font-bold" data-bs-toggle="modal"
                data-bs-target="#notPaidModal">
                Ada <b>{{ $statistics['studentsNotPaidCount'] }}</b> orang belum membayar pada rentang tanggal tersebut!
                <i class="bi bi-exclamation-triangle"></i>
              </button>

              <div class="row text-center mt-3">
                @foreach ($statistics['studentsNotPaidLimit'] as $student)
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

              <livewire:cash-transactions.student-paid-status-modal
                modalTitle="Daftar Pelajar Yang Belum Membayar di Tanggal Tersebut"
                :students="$statistics['studentsNotPaid']" />
            </div>

            <div class="d-flex flex-wrap flex-row-reverse mb-3 gap-2">
              <div class="col-auto">
                <button wire:click="$refresh" class="btn btn-sm btn-light"><i
                    class="bi bi-arrow-clockwise"></i></button>
              </div>

              <div class="col-12 col-md mt-2 mt-md-0">
                <form class="d-inline-block w-100">
                  <input wire:model.live="query" type="text" class="form-control form-control shadow-sm fw-bold"
                    placeholder="Masukan keyword pencarian..">
                </form>
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
                  <td colspan="3">
                    <div class="d-flex justify-content-center">
                      <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </div>
                    </div>
                  </td>
                </tr>

                @php
                $startIndex = ($filteredResult->currentPage() - 1) * $filteredResult->perPage() + 1;
                @endphp

                @forelse ($filteredResult as $index => $cashTransaction)
                <tr wire:key="{{ $cashTransaction->id }}">
                  <th scope="row">{{ $startIndex + $index }}</th>
                  <td>
                    <span class="text-uppercase badge bg-primary">{{ $cashTransaction->student->name }}</span>
                  </td>
                  <td>{{ local_amount_format($cashTransaction->amount) }}</td>
                  <td>{{ $cashTransaction->date_paid }}</td>
                  <td class="text-center">
                    <span class="badge bg-primary">
                      <i class="bi bi-person-badge-fill"></i>
                      {{ $cashTransaction->createdBy->name }}
                    </span>
                  </td>
                </tr>
                @empty
                <tr wire:loading.remove class="text-center">
                  <th colspan="6" class="fw-bold">Tidak ada data yang ditemukan!</th>
                </tr>
                @endforelse
              </tbody>
              @empty(!$filteredResult)
              <tfoot>
                <tr role="row">
                  <td colspan="4" class="fw-bold">Total</td>
                  <td colspan="4">
                    <span class="fw-bold">{{ local_amount_format($sumAmountDateRange) }}</span>
                  </td>
                </tr>
              </tfoot>
              @endempty
            </table>

            {{ $filteredResult->links(data: ['scrollTo' => false]) }}
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
