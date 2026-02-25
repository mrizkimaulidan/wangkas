<div>
  <section class="row" aria-labelledby="statistik-title">
    <h2 id="statistik-title" class="visually-hidden">Statistik Pelajar</h2>
    <div class="col-md-4">
      <livewire:statistic-status label="Total Pelajar" value="{{ $this->studentCount }}" icon="bi-people"
        color="primary" lazy />
    </div>
    <div class="col-md-4">
      <livewire:statistic-status label="Laki-laki" value="{{ $this->countMaleStudent }}" icon="bi-gender-male"
        color="info" lazy />
    </div>
    <div class="col-md-4">
      <livewire:statistic-status label="Perempuan" value="{{ $this->countFemaleStudent }}" icon="bi-gender-female"
        color="danger" lazy />
    </div>
  </section>

  <main>
    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-body">
            <header class="d-flex justify-content-between align-items-center mb-3">
              <h1 class="h5 fw-semibold mb-0">Daftar Pelajar</h1>

              <nav class="d-flex gap-2" aria-label="Aksi tabel">
                <button wire:click="resetFilters" type="button" class="btn btn-outline-warning btn-sm"
                  title="Reset semua filter" aria-label="Reset filter" @if(!$this->hasActiveFilters()) disabled @endif>
                  <i class="bi bi-funnel me-1"></i>
                  <span class="d-none d-sm-inline">Reset Filter</span>
                </button>
                <a wire:navigate href="{{ route('pelajar.create') }}" class="btn btn-primary btn-sm"
                  title="Tambah pelajar baru" aria-label="Tambah data pelajar">
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
                <label for="searchInput" class="visually-hidden">Pencarian pelajar</label>
                <input wire:model.live.debounce.300ms="search" type="search" class="form-control" id="searchInput"
                  placeholder="Masukan kata kunci pencarian..." aria-label="Pencarian pelajar" autofocus>
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
                      <option value="identification_number_asc">Nomor Identitas (A-Z)</option>
                      <option value="identification_number_desc">Nomor Identitas (Z-A)</option>
                      <option value="name_asc">Nama Pelajar (A-Z)</option>
                      <option value="name_desc">Nama Pelajar (Z-A)</option>
                      <option value="newest">Ditambahkan Terbaru</option>
                      <option value="oldest">Ditambahkan Terlama</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="d-flex flex-column gap-3 mb-3">
              <div class="row g-3">
                <div class="col-md-4">
                  <label for="schoolMajorSelect" class="form-label small text-muted">Jurusan</label>
                  <select wire:model.live="school_major_id" class="form-select form-select-sm" id="schoolMajorSelect">
                    <option value="">Semua Jurusan</option>
                    @foreach ($this->schoolMajors as $schoolMajor)
                    <option value="{{ $schoolMajor->id }}">{{ $schoolMajor->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="schoolClassSelect" class="form-label small text-muted">Kelas</label>
                  <select wire:model.live="school_class_id" class="form-select form-select-sm" id="schoolClassSelect">
                    <option value="">Semua Kelas</option>
                    @foreach ($this->schoolClasses as $schoolClass)
                    <option value="{{ $schoolClass->id }}">{{ $schoolClass->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="genderSelect" class="form-label small text-muted">Jenis Kelamin</label>
                  <select wire:model.live="gender" class="form-select form-select-sm" id="genderSelect">
                    <option value="">Semua Jenis Kelamin</option>
                    <option value="1">Laki-laki</option>
                    <option value="2">Perempuan</option>
                  </select>
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
                <span class="fw-medium">Tersaring: {{ $this->students->total() }}</span> dari
                <span class="fw-medium">{{ $this->studentCount }}</span> data
              </small>
            </div>
            @endif

            @livewire('alert')

            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0" aria-label="Daftar pelajar">
                <thead>
                  <tr>
                    <th scope="col" style="width: 40px">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll" title="Pilih semua"
                          aria-label="Pilih semua data">
                      </div>
                    </th>
                    <th scope="col" style="width: 60px">No</th>
                    <th scope="col">Nomor Identitas</th>
                    <th scope="col">Nama Pelajar</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Nomor Telepon</th>
                    <th scope="col">Tahun Ajaran</th>
                    <th scope="col" class="text-center" style="width: 180px">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($this->students as $student)
                  <tr wire:key="{{ $student->id }}">
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" aria-label="Pilih data {{ $student->name }}">
                      </div>
                    </td>
                    <td class="fw-medium">{{ $this->students->firstItem() + $loop->index }}</td>
                    <td>{{ $student->identification_number }}</td>
                    <td>
                      <div>
                        <div class="fw-medium mb-1">{{ $student->name }}</div>
                        <div class="d-flex flex-wrap gap-2 small">
                          <span class="text-muted">
                            <i class="bi bi-briefcase me-1"></i>
                            {{ $student->schoolMajor->name }}
                          </span>
                          <span class="text-muted">
                            <i class="bi bi-bookmark me-1"></i>
                            {{ $student->schoolClass->name }}
                          </span>
                        </div>
                      </div>
                    </td>
                    <td>
                      <span class="text-muted small">
                        <i class="bi bi-gender-{{ $student->gender === 1 ? 'male' : 'female' }} me-1"></i>
                        {{ $student->gender === 1 ? 'Laki-laki' : 'Perempuan' }}
                      </span>
                    </td>
                    <td>{{ $student->phone_number }}</td>
                    <td>{{ $student->school_year_start }}/{{ $student->school_year_end }}</td>
                    <td>
                      <div class="d-flex justify-content-center gap-1">
                        <a wire:navigate href="{{ route('pelajar.edit', $student) }}"
                          class="btn btn-sm btn-outline-success" title="Edit pelajar"
                          aria-label="Edit {{ $student->name }}">
                          <i class="bi bi-pencil"></i>
                        </a>

                        <livewire:pages::students.delete :student="$student" :wire:key="'delete-'.$student->id" />
                      </div>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="8" class="text-center py-4">
                      <div class="text-muted">
                        <p class="mb-0">Tidak ada data yang ditemukan</p>
                      </div>
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>

              <div class="pt-3">
                {{ $this->students->links(data: ['scrollTo' => false]) }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
