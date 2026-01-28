<div>
  <div class="row">
    <div class="col-md-4">
      <livewire:statistic-status label="Total Minggu Ini"
        value="{{ Number::currency($this->totalThisWeek, in: 'IDR', locale: 'id') }}" icon="bi-bar-chart-line"
        color="primary" showTrend="true" trendDirection="{{ $this->weeklyGrowthTrendDirection }}"
        trendPercentage="{{ $this->weekOverWeekGrowthRate }}%" comparisonText="dari minggu lalu" />
    </div>

    <div class="col-md-4">
      <livewire:statistic-status label="Total Bulan Ini"
        value="{{ Number::currency($this->totalThisMonth, in: 'IDR', locale: 'id') }}" icon="bi-bar-chart-line"
        color="success" showTrend="true" trendDirection="{{ $this->monthlyGrowthTrendDirection }}"
        trendPercentage="{{ $this->monthOverMonthGrowthRate }}" comparisonText="dari bulan lalu" />
    </div>

    <div class="col-md-4">
      <livewire:statistic-status label="Total Tahun Ini"
        value="{{ Number::currency($this->totalThisYear, in: 'IDR', locale: 'id') }}" icon="bi-bar-chart-line"
        color="primary" showTrend="true" trendDirection="{{ $this->yearlyGrowthTrendDirection }}"
        trendPercentage="{{ $this->yearOverYearGrowthRate }}%" comparisonText="dari tahun lalu" />
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <livewire:statistic-status label="Total Pelajar" value="{{ $this->studentCount }}" icon="bi-people" color="info"
        subLabel="pelajar terdaftar" />
    </div>

    <div class="col-md-4">
      <livewire:statistic-status label="Sudah Bayar Minggu Ini" value="{{ $this->studentPaidThisWeekCount }}"
        icon="bi-check-circle" color="success" subValue="{{ $this->paidPercentageThisWeek }}%"
        subLabel="dari total pelajar" />
    </div>

    <div class="col-md-4">
      <livewire:statistic-status label="Belum Bayar Minggu Ini" value="{{ $this->studentNotPaidThisWeekCount }}"
        icon="bi-clock" color="warning" subValue="{{ $this->unpaidPercentageThisWeek }}%" subLabel="perlu penagihan" />
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
            <div>
              <h5 class="fw-semibold">Daftar Kas Minggu Ini</h5>
              <div class="d-flex flex-wrap align-items-center gap-2">
                <span class="badge text-bg-light border">
                  <i class="bi bi-grid-3x3-gap me-1"></i>0 Kelas
                </span>
                <span class="badge text-bg-light border">
                  <i class="bi bi-people me-1"></i>30 Pelajar
                </span>
              </div>
            </div>

            <div class="d-flex flex-wrap gap-2">
              <button wire:click="resetFilters" type="button" class="btn btn-outline-warning btn-sm"
                title="Reset semua filter">
                <i class="bi bi-funnel me-1"></i>
                <span class="d-none d-sm-inline">Reset Filter</span>
              </button>
              <a wire:navigate href="{{ route('kelas.create') }}" class="btn btn-primary btn-sm"
                title="Tambah kelas baru">
                <i class="bi bi-plus-circle me-1"></i>
                <span>Tambah Data</span>
              </a>
              <button wire:click="$refresh" type="button" class="btn btn-outline-secondary btn-sm" title="Refresh data">
                <i class="bi bi-arrow-clockwise me-1"></i>
                <span class="d-none d-sm-inline">Refresh</span>
              </button>
            </div>
          </div>

          <div class="row mb-4 g-3">
            <div class="col-md-6 col-lg-4">
              <div class="form-group position-relative has-icon-left">
                <input wire:model.live.debounce.300ms="search" type="search" class="form-control"
                  placeholder="Masukan kata kunci pencarian..." aria-label="Pencarian">
                <div class="form-control-icon">
                  <i class="bi bi-search"></i>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-lg-8">
              <div class="d-flex flex-wrap gap-2 justify-content-md-end align-items-center">
                <div class="flex-shrink-0">
                  <div class="input-group input-group-sm">
                    <span class="input-group-text d-flex align-items-center">
                      <i class="bi bi-list-ol"></i>
                    </span>
                    <select wire:model.live="perPage" class="form-select form-select-sm"
                      aria-label="Jumlah data per halaman">
                      <option value="">Tampilkan</option>
                      @foreach (range(5, 25, 5) as $range)
                      <option value="{{ $range }}">{{ $range }} data</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="flex-shrink-0">
                  <div class="input-group input-group-sm">
                    <span class="input-group-text d-flex align-items-center">
                      <i class="bi bi-sort-down"></i>
                    </span>
                    <select wire:model.live="sortBy" class="form-select form-select-sm" aria-label="Urutkan data">
                      <option value="">Urutkan</option>
                      <option value="student_name_asc">Nama Pelajar (A-Z)</option>
                      <option value="student_name_desc">Nama Pelajar (Z-A)</option>
                      <option disabled>──────────</option>
                      <option value="amount_asc">Total Bayar Terkecil</option>
                      <option value="amount_desc">Total Bayar Terbesar</option>
                      <option disabled>──────────</option>
                      <option value="newest">Ditambahkan Terbaru</option>
                      <option value="oldest">Ditambahkan Terlama</option>
                    </select>
                  </div>
                </div>

                <button type="button" class="btn btn-outline-success btn-sm" title="Ekspor data">
                  <i class="bi bi-download me-1"></i>
                  <span class="d-none d-sm-inline">Export</span>
                </button>
              </div>
            </div>
          </div>

          @livewire('alert')

          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead>
                <tr>
                  <th scope="col" style="width: 40px">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="selectAll" title="Pilih semua">
                    </div>
                  </th>
                  <th scope="col" style="width: 60px">No</th>
                  <th scope="col">Nama Pelajar</th>
                  <th scope="col">Total Bayar</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Dicatat Oleh</th>
                  <th scope="col" class="text-center" style="width: 180px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($this->cashTransactions as $cashTransaction)
                <tr wire:key="{{ $cashTransaction->id }}">
                  <td>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox">
                    </div>
                  </td>
                  <td class="fw-medium">{{ $this->cashTransactions->firstItem() + $loop->index }}</td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="me-3">
                        <div class="fw-medium mb-1">{{ $cashTransaction->student->name }}</div>
                        <div class="d-flex flex-wrap align-items-center gap-2 small">
                          <span class="text-muted">
                            <i class="bi bi-briefcase me-1"></i>
                            {{ $cashTransaction->student->schoolMajor->name }}
                          </span>
                          <span class="text-muted">
                            <i class="bi bi-bookmark me-1"></i>
                            {{ $cashTransaction->student->schoolClass->name }}
                          </span>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>{{ Number::currency($cashTransaction->amount, in: 'IDR', locale: 'id') }}</td>
                  <td>{{ $cashTransaction->date_paid }}</td>
                  <td>{{ $cashTransaction->createdBy->name }}</td>
                  <td>
                    <div class="d-flex justify-content-center gap-1">
                      {{-- <a wire:navigate href="{{ route('kelas.edit', $cashTransaction) }}"
                        class="btn btn-sm btn-outline-success" title="Edit kelas">
                        <i class="bi bi-pencil"></i>
                        <span class="visually-hidden">Edit</span>
                      </a>

                      <livewire:pages::school_classes.delete :cashTransaction="$cashTransaction" /> --}}
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="4" class="text-center py-4">
                    <div class="text-muted">
                      <p class="mb-0">Tidak ada data yang ditemukan</p>
                    </div>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
            <div class="pt-3">{{ $this->cashTransactions->links(data: ['scrollTo' => false]) }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>