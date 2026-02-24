<div>
  <main>
    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-body">
            <header class="d-flex justify-content-between align-items-center mb-3">
              <h1 class="h5 fw-semibold mb-0">Daftar Jurusan</h1>

              <nav class="d-flex gap-2" aria-label="Aksi tabel">
                <button wire:click="resetFilters" type="button" class="btn btn-outline-warning btn-sm"
                  title="Reset semua filter" aria-label="Reset filter" @if(!$this->hasActiveFilters()) disabled @endif>
                  <i class="bi bi-funnel me-1"></i>
                  <span class="d-none d-sm-inline">Reset Filter</span>
                </button>
                <a wire:navigate href="{{ route('jurusan.create') }}" class="btn btn-primary btn-sm"
                  title="Tambah jurusan baru" aria-label="Tambah data jurusan">
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

            <div class="row g-2 mb-3">
              <div class="col-12 col-md-6">
                <label for="searchInput" class="visually-hidden">Pencarian jurusan</label>
                <input wire:model.live.debounce.300ms="search" type="search" class="form-control" id="searchInput"
                  placeholder="Masukan kata kunci pencarian..." aria-label="Pencarian jurusan" autofocus>
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
                      <option value="name_asc">Nama Jurusan (A-Z)</option>
                      <option value="name_desc">Nama Jurusan (Z-A)</option>
                      <option value="abbreviation_asc">Singkatan (A-Z)</option>
                      <option value="abbreviation_desc">Singkatan (Z-A)</option>
                      <option value="students_count_desc">Pelajar Terbanyak</option>
                      <option value="students_count_asc">Pelajar Tersedikit</option>
                      <option value="newest">Ditambahkan Terbaru</option>
                      <option value="oldest">Ditambahkan Terlama</option>
                    </select>
                  </div>
                </div>
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
                <span class="fw-medium">Tersaring: {{ $this->schoolMajors->total() }}</span> dari
                <span class="fw-medium">{{ $this->totalSchoolMajors }}</span> data
              </small>
            </div>
            @endif

            @livewire('alert')

            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0" aria-label="Daftar jurusan">
                <thead>
                  <tr>
                    <th scope="col" style="width: 40px">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll" title="Pilih semua"
                          aria-label="Pilih semua data">
                      </div>
                    </th>
                    <th scope="col" style="width: 60px">No</th>
                    <th scope="col">Nama Jurusan</th>
                    <th scope="col">Singkatan</th>
                    <th scope="col">Jumlah Pelajar</th>
                    <th scope="col" class="text-center" style="width: 180px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($this->schoolMajors as $schoolMajor)
                  <tr wire:key="{{ $schoolMajor->id }}">
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                          aria-label="Pilih data {{ $schoolMajor->name }}">
                      </div>
                    </td>
                    <td class="fw-medium">{{ $this->schoolMajors->firstItem() + $loop->index }}</td>
                    <td>
                      <div class="fw-medium">{{ $schoolMajor->name }}</div>
                    </td>
                    <td>
                      <span class="badge bg-light text-dark border">{{ $schoolMajor->abbreviation }}</span>
                    </td>
                    <td>
                      <span class="text-muted small">
                        <i class="bi bi-people me-1"></i>
                        {{ $schoolMajor->students_count }} Pelajar
                      </span>
                    </td>
                    <td>
                      <div class="d-flex justify-content-center gap-1">
                        <a wire:navigate href="{{ route('jurusan.edit', $schoolMajor) }}"
                          class="btn btn-sm btn-outline-success" title="Edit jurusan"
                          aria-label="Edit {{ $schoolMajor->name }}">
                          <i class="bi bi-pencil"></i>
                        </a>

                        <livewire:pages::school_majors.delete :schoolMajor="$schoolMajor"
                          :wire:key="'delete-'.$schoolMajor->id" />
                      </div>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="6" class="text-center py-4">
                      <div class="text-muted">
                        <p class="mb-0">Tidak ada data yang ditemukan</p>
                      </div>
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>

              <div class="pt-3">
                {{ $this->schoolMajors->links(data: ['scrollTo' => false]) }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
