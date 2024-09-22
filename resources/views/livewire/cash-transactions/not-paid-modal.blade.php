<div>
  <div wire:ignore.self data-bs-backdrop="static" class="modal fade" id="notPaidModal" tabindex="-1"
    aria-labelledby="notPaidModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="notPaidModalLabel">Daftar Pelajar Yang Belum Membayar Minggu Ini</h1>
          <button wire:loading.attr="disabled" type="button" class="btn-close" data-bs-dismiss="modal"
            aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            @foreach ($students as $student)
            <div class="col-6 mb-3">
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
</div>
