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
              <h6 class="font-extrabold mb-0">123</h6>
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
              <h6 class="font-extrabold mb-0">123</h6>
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
              <h6 class="font-extrabold mb-0">123</h6>
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
              <h6 class="font-extrabold mb-0">123</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="card">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <div class="card-body">
          <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true">Filter Keseluruhan</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                aria-controls="profile" aria-selected="false" tabindex="-1">Status Pembayaran Pelajar</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab"
                aria-controls="contact" aria-selected="false" tabindex="-1">Contact</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
              <p class="my-2">
              <div class="row">
                <div class="col-6">
                  <div class="mb-3">
                    <label for="student_id" class="form-label">Pilih Pelajar:</label>
                    <select wire:model.live="student_id" class="form-select" id="student_id">
                      <option selected>Pilih Pelajar</option>
                      @foreach ($students as $student)
                      <option value="{{ $student->id }}">{{ $student->name }}</option>
                      @endforeach
                    </select>
                    <div>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="mb-3">
                    <label for="user_id" class="form-label">Pilih Pencatat:</label>
                    <select wire:model.live="user_id" class="form-select" id="user_id">
                      <option selected>Pilih Pencatat</option>
                      @foreach ($users as $user)
                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                      @endforeach
                    </select>
                    <div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="mb-3">
                    <label for="school_major_id" class="form-label">Pilih Jurusan:</label>
                    <select wire:model.live="school_major_id" class="form-select" id="school_major_id">
                      <option selected>Pilih Jurusan</option>
                      @foreach ($schoolMajors as $schoolMajor)
                      <option value="{{ $schoolMajor->id }}">{{ $schoolMajor->name }}</option>
                      @endforeach
                    </select>
                    <div>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="mb-3">
                    <label for="school_class_id" class="form-label">Pilih Kelas:</label>
                    <select wire:model.live="school_class_id" class="form-select" id="school_class_id">
                      <option selected>Pilih Kelas</option>
                      @foreach ($schoolClasses as $schoolClass)
                      <option value="{{ $schoolClass->id }}">{{ $schoolClass->name }}</option>
                      @endforeach
                    </select>
                    <div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="mb-3">
                    <label for="start_date" class="form-label">Tamggal Awal:</label>
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
                    <tr wire:loading.remove wire:key="{{ $cashTransaction->id }}">
                      <th scope="row">{{ $startIndex + $index }}</th>
                      <td>
                        <p>
                          <a class="btn btn-sm btn-primary" data-bs-toggle="collapse"
                            href="#collapseTransaction-{{ $cashTransaction->id }}" role="button" aria-expanded="true"
                            aria-controls="collapseTransaction-{{ $cashTransaction->id }}">
                            {{ $cashTransaction->student->name }}
                          </a>
                        </p>
                        <div class="collapse" id="collapseTransaction-{{ $cashTransaction->id }}">
                          <p class="card-text text-muted">
                            <span class="badge bg-secondary">
                              <i class="bi bi-telephone-fill"></i> {{ $cashTransaction->student->phone_number }}
                            </span>
                          </p>
                          <span class="badge bg-primary"><i class="bi bi-bookmark"></i> {{
                            $cashTransaction->student->schoolClass->name
                            }}</span>
                          <span class="badge bg-success"><i class="bi bi-briefcase"></i> {{
                            $cashTransaction->student->schoolMajor->name
                            }}</span>
                          <span
                            class="badge bg-light-{{ $cashTransaction->student->gender == 1 ? 'primary' : 'danger' }}"><i
                              class="bi bi-gender-{{ $cashTransaction->student->gender == 1 ? 'male' : 'female' }}"></i></span>
                        </div>
                      </td>
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
                </table>

                {{ $filteredResult->links() }}
              </div>
              </p>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              Integer interdum diam eleifend metus lacinia, quis gravida eros mollis. Fusce non sapien
              sit amet magna dapibus
              ultrices. Morbi tincidunt magna ex, eget faucibus sapien bibendum non. Duis a mauris ex.
              Ut finibus risus sed massa
              mattis porta. Aliquam sagittis massa et purus efficitur ultricies. Integer pretium dolor
              at sapien laoreet ultricies.
              Fusce congue et lorem id convallis. Nulla volutpat tellus nec molestie finibus. In nec
              odio tincidunt eros finibus
              ullamcorper. Ut sodales, dui nec posuere finibus, nisl sem aliquam metus, eu accumsan
              lacus felis at odio. Sed lacus
              quam, convallis quis condimentum ut, accumsan congue massa. Pellentesque et quam vel
              massa pretium ullamcorper vitae eu
              tortor.
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
              <p class="mt-2">Duis ultrices purus non eros fermentum hendrerit. Aenean ornare interdum
                viverra. Sed ut odio velit. Aenean eu diam
                dictum nibh rhoncus mattis quis ac risus. Vivamus eu congue ipsum. Maecenas id
                sollicitudin ex. Cras in ex vestibulum,
                posuere orci at, sollicitudin purus. Morbi mollis elementum enim, in cursus sem
                placerat ut.</p>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
