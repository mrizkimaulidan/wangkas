<div>
  <div class="row g-3 mb-3">
    <div class="col-md-4">
      <livewire:statistic-status label="Total Minggu Ini"
        value="{{ Number::currency($this->totalThisWeek, in: 'IDR', locale: 'id') }}" icon="bi-bar-chart-line"
        color="primary" showTrend="true" trendDirection="{{ $this->weeklyGrowthTrendDirection }}"
        trendPercentage="{{ $this->weekOverWeekGrowthRate }}%" comparisonText="dari minggu lalu" lazy />
    </div>

    <div class="col-md-4">
      <livewire:statistic-status label="Total Bulan Ini"
        value="{{ Number::currency($this->totalThisMonth, in: 'IDR', locale: 'id') }}" icon="bi-bar-chart-line"
        color="success" showTrend="true" trendDirection="{{ $this->monthlyGrowthTrendDirection }}"
        trendPercentage="{{ $this->monthOverMonthGrowthRate }}" comparisonText="dari bulan lalu" lazy />
    </div>

    <div class="col-md-4">
      <livewire:statistic-status label="Total Tahun Ini"
        value="{{ Number::currency($this->totalThisYear, in: 'IDR', locale: 'id') }}" icon="bi-bar-chart-line"
        color="primary" showTrend="true" trendDirection="{{ $this->yearlyGrowthTrendDirection }}"
        trendPercentage="{{ $this->yearOverYearGrowthRate }}%" comparisonText="dari tahun lalu" lazy />
    </div>
  </div>

  <div class="row g-3 mb-3">
    <div class="col-md-4">
      <livewire:statistic-status label="Total Pelajar" value="{{ $this->studentCount }}" icon="bi-people" color="info"
        subLabel="pelajar terdaftar" lazy />
    </div>

    <div class="col-md-4">
      <livewire:statistic-status label="Sudah Bayar Minggu Ini" value="{{ $this->studentPaidThisWeekCount }}"
        icon="bi-check-circle" color="success" subValue="{{ $this->paidPercentageThisWeek }}%"
        subLabel="dari total pelajar" lazy />
    </div>

    <div class="col-md-4">
      <livewire:statistic-status label="Belum Bayar Minggu Ini" value="{{ $this->studentNotPaidThisWeekCount }}"
        icon="bi-clock" color="warning" subValue="{{ $this->unpaidPercentageThisWeek }}%" subLabel="perlu penagihan"
        lazy />
    </div>
  </div>

  <main>
    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-body">
            <header class="d-flex justify-content-between align-items-center mb-3">
              <h1 class="h5 fw-semibold mb-0">Daftar Kas Minggu Ini</h1>

              <nav class="d-flex gap-2" aria-label="Aksi tabel">
                <button wire:click="resetFilters" type="button" class="btn btn-outline-warning btn-sm"
                  title="Reset semua filter" aria-label="Reset filter" @if(!$this->hasActiveFilters()) disabled @endif>
                  <i class="bi bi-funnel me-1"></i>
                  <span class="d-none d-sm-inline">Reset Filter</span>
                </button>
                <a wire:navigate href="{{ route('kas.create') }}" class="btn btn-primary btn-sm" title="Tambah kas baru"
                  aria-label="Tambah data kas">
                  <i class="bi bi-plus-circle me-1"></i>
                  <span>Tambah Data</span>
                </a>
                <button wire:click="$refresh" type="button" class="btn btn-outline-secondary btn-sm"
                  title="Refresh data" aria-label="Refresh data" wire:loading.attr="disabled">
                  <span wire:loading.remove wire:target="$refresh">
                    <i class="bi bi-arrow-clockwise me-1"></i>
                  </span>
                  <span wire:loading wire:target="$refresh">
                    <span class="spinner-border spinner-border-sm me-1"></span>
                  </span>
                  <span class="d-none d-sm-inline">Refresh</span>
                </button>
              </nav>
            </header>

            <div class="card border-start border-end border-primary border-4 mb-4">
              <div class="card-body p-3">
                <div class="row align-items-center g-3">
                  <div class="col-md-7">
                    <div class="d-flex align-items-center">
                      <div class="flex-grow-1">
                        <div class="d-flex align-items-center mb-2">
                          <div class="text-center me-3">
                            <div class="fw-bold text-primary fs-5">{{ now()->parse($startOfWeek)->format('d') }}</div>
                            <div class="small text-muted">{{ now()->parse($startOfWeek)->translatedFormat('M') }}</div>
                            <div class="small text-muted">{{ now()->parse($startOfWeek)->format('Y') }}</div>
                          </div>

                          <div class="position-relative flex-grow-1 mx-3">
                            <div class="progress">
                              <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                style="width: {{ $this->paidPercentageThisWeek }}%;">
                              </div>
                            </div>
                            <div class="position-absolute top-50 start-50 translate-middle">
                              <span class="badge bg-primary text-white px-4 py-2 shadow-sm">
                                <i class="bi bi-calendar-week me-1"></i>
                                Minggu {{ ceil(now()->day / 7) }}
                              </span>
                            </div>
                          </div>

                          <div class="text-center ms-3">
                            <div class="fw-bold text-primary fs-5">{{ now()->parse($endOfWeek)->format('d') }}</div>
                            <div class="small text-muted">{{ now()->parse($endOfWeek)->translatedFormat('M') }}</div>
                            <div class="small text-muted">{{ now()->parse($endOfWeek)->format('Y') }}</div>
                          </div>
                        </div>

                        <div class="d-flex align-items-center text-muted">
                          <span class="fw-medium">{{ now()->translatedFormat('F Y') }}</span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-5">
                    <div class="d-flex justify-content-around">
                      <div class="text-center">
                        <div class="fw-bold text-info fs-5">{{ $this->studentCount }}</div>
                        <div class="small text-muted">Total Pelajar</div>
                      </div>
                      <div class="text-center">
                        <div class="fw-bold text-success fs-5">{{ $this->studentPaidThisWeekCount }}</div>
                        <div class="small text-muted">Sudah Bayar</div>
                      </div>
                      <div class="text-center">
                        <div class="fw-bold text-warning fs-5">{{ $this->studentNotPaidThisWeekCount }}</div>
                        <div class="small text-muted">Belum Bayar</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row g-2 mb-3">
              <div class="col-12 col-md-6">
                <label for="searchInput" class="visually-hidden">Pencarian kas</label>
                <input wire:model.live.debounce.300ms="search" type="search" class="form-control" id="searchInput"
                  placeholder="Masukan kata kunci pencarian..." aria-label="Pencarian kas" autofocus>
              </div>

              <div class="col-12 col-md-6">
                <div class="row g-2">
                  <div class="col-6">
                    <label for="perPageSelect" class="visually-hidden">Jumlah data per halaman</label>
                    <select wire:model.live="perPage" class="form-select" id="perPageSelect">
                      <option value="">Tampilkan</option>
                      <option value="5">5 data</option>
                      <option value="10">10 data</option>
                      <option value="25">25 data</option>
                      <option value="50">50 data</option>
                    </select>
                  </div>

                  <div class="col-6">
                    <label for="sortBySelect" class="visually-hidden">Urutkan data</label>
                    <select wire:model.live="sortBy" class="form-select" id="sortBySelect">
                      <option value="">Urutkan</option>
                      <option value="student_name_asc">Nama Pelajar (A-Z)</option>
                      <option value="student_name_desc">Nama Pelajar (Z-A)</option>
                      <option value="amount_asc">Total Bayar Terkecil</option>
                      <option value="amount_desc">Total Bayar Terbesar</option>
                      <option value="newest">Ditambahkan Terbaru</option>
                      <option value="oldest">Ditambahkan Terlama</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row g-2 mb-3">
              <div class="col-md-4">
                <label for="schoolMajorSelect" class="form-label small text-muted mb-1">Jurusan</label>
                <select wire:model.live="school_major_id" class="form-select form-select-sm" id="schoolMajorSelect">
                  <option value="">Semua Jurusan</option>
                  @foreach ($this->schoolMajors as $schoolMajor)
                  <option value="{{ $schoolMajor->id }}">{{ $schoolMajor->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-4">
                <label for="schoolClassSelect" class="form-label small text-muted mb-1">Kelas</label>
                <select wire:model.live="school_class_id" class="form-select form-select-sm" id="schoolClassSelect">
                  <option value="">Semua Kelas</option>
                  @foreach ($this->schoolClasses as $schoolClass)
                  <option value="{{ $schoolClass->id }}">{{ $schoolClass->name }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-4">
                <label for="genderSelect" class="form-label small text-muted mb-1">Jenis Kelamin</label>
                <select wire:model.live="gender" class="form-select form-select-sm" id="genderSelect">
                  <option value="">Semua Jenis Kelamin</option>
                  <option value="1">Laki-laki</option>
                  <option value="2">Perempuan</option>
                </select>
              </div>
            </div>

            @if($this->hasActiveFilters())
            <div class="d-flex align-items-center gap-2 mb-3">
              <span class="badge bg-info text-white">
                <i class="bi bi-funnel me-1"></i>
                Filter Aktif
              </span>
              <button wire:click="resetFilters" type="button" class="btn btn-outline-warning btn-sm"
                aria-label="Reset semua filter">
                <i class="bi bi-x-lg me-1"></i> Reset Filter
              </button>
              <small class="text-muted">
                <span class="fw-medium">Tersaring: {{ $this->cashTransactions->total() }}</span>
              </small>
            </div>
            @endif

            @livewire('alert')

            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0" aria-label="Daftar kas">
                <thead>
                  <tr>
                    <th scope="col" style="width: 40px">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll" title="Pilih semua"
                          aria-label="Pilih semua data">
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
                        <input class="form-check-input" type="checkbox"
                          aria-label="Pilih data {{ $cashTransaction->student->name }}">
                      </div>
                    </td>
                    <td class="fw-medium">{{ $this->cashTransactions->firstItem() + $loop->index }}</td>
                    <td>
                      <div>
                        <div class="fw-medium mb-1">{{ $cashTransaction->student->name }}</div>
                        <div class="d-flex flex-wrap gap-2 small">
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
                    </td>
                    <td class="fw-medium text-success">{{ Number::currency($cashTransaction->amount, in: 'IDR', locale:
                      'id') }}</td>
                    <td>{{ $cashTransaction->date_paid }}</td>
                    <td>{{ $cashTransaction->createdBy->name }}</td>
                    <td>
                      <div class="d-flex justify-content-center gap-1">
                        <a wire:navigate href="{{ route('kas.edit', $cashTransaction) }}"
                          class="btn btn-sm btn-outline-success" title="Edit kas"
                          aria-label="Edit {{ $cashTransaction->student->name }}">
                          <i class="bi bi-pencil"></i>
                        </a>

                        <livewire:pages::cash_transactions.delete :cashTransaction="$cashTransaction"
                          :wire:key="'delete-'.$cashTransaction->id" />
                      </div>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="7" class="text-center py-4">
                      <div class="text-muted">
                        <p class="mb-0">Tidak ada data yang ditemukan</p>
                      </div>
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>

              <div class="pt-3">
                {{ $this->cashTransactions->links(data: ['scrollTo' => false]) }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
