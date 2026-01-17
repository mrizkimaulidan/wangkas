<div>
  <div class="row">
    <div class="col-6">
      <x-cards.statistic title="Total Bulan Ini" icon="iconly-boldChart"
        :count="$this->statistics['totalCurrentMonth']" />
    </div>

    <div class="col-6">
      <x-cards.statistic title="Total Tahun Ini" icon="iconly-boldChart"
        :count="$this->statistics['totalCurrentYear']" />
    </div>
  </div>

  <div class="row">
    <div class="col-6">
      <x-cards.statistic title="Sudah Membayar Minggu Ini" icon="iconly-boldActivity" color="green"
        :count="$this->statistics['studentsPaidThisWeekCount']" />
    </div>

    <div class="col-6">
      <x-cards.statistic title="Belum Membayar Minggu Ini" icon="iconly-boldActivity" color="red"
        :count="$this->statistics['studentsNotPaidThisWeekCount']" />
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header text-center">
          @if($this->statistics['studentsNotPaidThisWeekCount'] > 0)
          <h4>
            Daftar Yang Belum Membayar Minggu Ini
            <span class="fw-bolder fst-italic">({{ $currentWeek['startOfWeek'] }} sampai {{ $currentWeek['endOfWeek']
              }})</span>
          </h4>
          @endif
        </div>

        <div class="card-body">
          @if($this->statistics['studentsNotPaidThisWeekCount'] > 0)
          <button type="button" class="btn btn-danger btn-block btn-xl font-bold" data-bs-toggle="modal"
            data-bs-target="#notPaidModal">
            Ada <b>{{ $this->statistics['studentsNotPaidThisWeekCount'] }}</b> orang belum membayar pada minggu ini! <i
              class="bi bi-exclamation-triangle"></i>
          </button>

          <div class="row text-center mt-3">
            @foreach ($this->statistics['studentsNotPaidThisWeekLimit'] as $student)
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
            @foreach ($this->statistics['studentsNotPaidThisWeek'] as $student)
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

          @if($this->validSelectedCount > 0)
          <div class="alert alert-warning border-start border-warning border-5 bg-warning bg-opacity-10" role="alert">
            <div
              class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
              <div class="d-flex align-items-center gap-3">
                <span class="badge rounded-pill bg-warning text-dark fs-6 px-3 py-2">
                  {{ $this->validSelectedCount }}
                </span>
                <span class="fw-medium">Data transaksi terpilih untuk dihapus</span>
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
                    wire:click="$dispatch('cash-transaction-delete', {cashTransaction: {{ json_encode($this->validSelectedIDs) }}})"
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

          <div wire:ignore.self class="collapse border mb-3" id="filterCollapse">
            <div class="card card-body">
              <div class="row g-3">
                <div class="col-12 col-md-6">
                  <label for="user_id" class="form-label">Dicatat Oleh:</label>
                  <select wire:model.live="filterByUserID" class="form-select" id="user_id">
                    <option value="" selected>Pilih Dicatat Oleh</option>
                    @foreach ($this->users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-12 col-md-6">
                  <label for="school_major_id" class="form-label">Jurusan:</label>
                  <select wire:model.live="filterBySchoolMajorID" class="form-select" id="school_major_id">
                    <option value="" selected>Pilih Jurusan</option>
                    @foreach ($this->schoolMajors as $schoolMajor)
                    <option value="{{ $schoolMajor->id }}">{{ $schoolMajor->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-12 col-md-6">
                  <label for="school_class_id" class="form-label">Kelas:</label>
                  <select wire:model.live="filterBySchoolClassID" class="form-select" id="school_class_id">
                    <option value="" selected>Pilih Kelas</option>
                    @foreach ($this->schoolClasses as $schoolClass)
                    <option value="{{ $schoolClass->id }}">{{ $schoolClass->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
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
                  <th scope="col"></th>
                  <th scope="col">#</th>
                  <th scope="col">Nama Pelajar</th>
                  <th scope="col">Total Bayar</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Dicatat Oleh</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr wire:loading>
                  <td colspan="7" class="text-center">
                    <div class="spinner-border" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                  </td>
                </tr>

                @php
                $startIndex = ($this->cashTransactions->currentPage() - 1) * $this->cashTransactions->perPage() + 1;
                @endphp

                @forelse ($this->cashTransactions as $index => $cashTransaction)
                <tr wire:key="{{ $cashTransaction->id }}">
                  <th>
                    <div class="form-check">
                      <input wire:model.live="selectedIDs" class="form-check-input" type="checkbox"
                        value="{{ $cashTransaction->id }}" id="check">
                    </div>
                  </th>
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
                  <th colspan="7" class="fw-bold">Tidak ada data yang ditemukan!</th>
                </tr>
                @endforelse
              </tbody>
            </table>
            {{ $this->cashTransactions->links(data: ['scrollTo' => false]) }}
          </div>
        </div>
      </div>
    </div>

    <livewire:cash-transactions.create-cash-transaction :students="$this->students" />
    <livewire:cash-transactions.edit-cash-transaction :students="$this->students" />
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
