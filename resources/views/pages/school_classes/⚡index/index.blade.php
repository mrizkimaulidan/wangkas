<div>
  <main>
    <div class="row">
      <div class="col-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body p-4">
            <header class="d-flex justify-content-between align-items-center mb-3">
              <div>
                <h1 class="h5 fw-semibold mb-0">Daftar Kelas</h1>
              </div>

              <nav class="d-flex gap-2" aria-label="Aksi tabel">
                <button wire:click="resetFilters" type="button" class="btn btn-outline-warning btn-sm"
                  title="Reset semua filter" aria-label="Reset filter">
                  <i class="bi bi-funnel me-1"></i>
                  <span class="d-none d-sm-inline">Reset Filter</span>
                </button>
                <a wire:navigate href="{{ route('kelas.create') }}" class="btn btn-primary btn-sm"
                  title="Tambah kelas baru" aria-label="Tambah data kelas">
                  <i class="bi bi-plus-circle me-1"></i>
                  <span>Tambah Data</span>
                </a>
                <button wire:click="$refresh" type="button" class="btn btn-outline-secondary btn-sm"
                  title="Refresh data" aria-label="Refresh data">
                  <i class="bi bi-arrow-clockwise me-1"></i>
                  <span class="d-none d-sm-inline">Refresh</span>
                </button>
              </nav>
            </header>

            <div class="row align-items-center mb-3 g-2">
              <div class="col-12 col-md-6">
                <label for="searchInput" class="visually-hidden">Pencarian kelas</label>
                <input wire:model.live.debounce.300ms="search" type="search" class="form-control" id="searchInput"
                  placeholder="Masukan kata kunci pencarian..." aria-label="Pencarian kelas" autofocus>
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
                      <option value="name_asc">Nama Kelas (A-Z)</option>
                      <option value="name_desc">Nama Kelas (Z-A)</option>
                      <option value="students_count_desc">Pelajar Terbanyak</option>
                      <option value="students_count_asc">Pelajar Sedikit</option>
                      <option value="newest">Ditambahkan Terbaru</option>
                      <option value="oldest">Ditambahkan Terlama</option>
                    </select>
                  </div>
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
                    <th scope="col">Nama Kelas</th>
                    <th scope="col" class="text-center" style="width: 180px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($this->schoolClasses as $schoolClass)
                  <tr wire:key="{{ $schoolClass->id }}">
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                      </div>
                    </td>
                    <td class="fw-medium">{{ $this->schoolClasses->firstItem() + $loop->index }}</td>
                    <td>
                      <div class="d-flex align-items-center">
                        <div class="me-3">
                          <div class="fw-medium mb-1">{{ $schoolClass->name }}</div>
                          <div class="d-flex flex-wrap align-items-center gap-2 small">
                            <span class="text-muted">
                              <i class="bi bi-people me-1"></i>
                              {{ $schoolClass->students_count }} Pelajar
                            </span>
                          </div>
                        </div>
                    </td>
                    <td>
                      <div class="d-flex justify-content-center gap-1">
                        <a wire:navigate href="{{ route('kelas.edit', $schoolClass) }}"
                          class="btn btn-sm btn-outline-success" title="Edit kelas"
                          aria-label="Edit {{ $schoolClass->name }}">
                          <i class="bi bi-pencil"></i>
                          <span class="visually-hidden">Edit</span>
                        </a>

                        <livewire:pages::school_classes.delete :schoolClass="$schoolClass" />
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
              <div class="pt-3">{{ $this->schoolClasses->links(data: ['scrollTo' => false]) }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
