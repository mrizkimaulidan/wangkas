<div class="row">
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
              <h6 class="font-extrabold mb-0">{{ $statistics['totalCurrentDay'] }}</h6>
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

  <div class="col-12">
    <div class="card">

      <div class="card-header text-center">
        <h4>Filter Data dengan Rentang Tanggal</h4>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <div class="mb-3">
              <label for="start_date" class="form-label">Tanggal Awal:</label>
              <input wire:model.live="start_date" type="date" class="form-control" id="start_date"
                placeholder="Pilih tanggal awal..">
            </div>
          </div>
          <div class="col-6">
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

        <div class="d-flex flex-wrap flex-row-reverse mb-3 gap-2">
          <div class="col-auto">
            <button wire:click="$refresh" class="btn btn-sm btn-light"><i class="bi bi-arrow-clockwise"></i></button>
          </div>

          <div class="col-12 col-md mt-2 mt-md-0">
            <form class="d-inline-block w-100">
              <input wire:model.live="query" type="text" class="form-control form-control shadow-sm fw-bold"
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
                <td><span class="badge text-bg-primary">{{ $cashTransaction->student->name }}</span></td>
                <td>{{ $cashTransaction->amount }}</td>
                <td>{{ $cashTransaction->date_paid }}</td>
                <td>{{ $cashTransaction->createdBy->name }}</td>
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
                <td colspan="4">{{ $sumAmountDateRange }}</td>
              </tr>
            </tfoot>
            @endempty
          </table>

          {{ $filteredResult->links() }}
        </div>
      </div>
    </div>
  </div>
</div>