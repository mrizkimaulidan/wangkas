<div>
  <section class="row">
    <div class="col-md-3">
      <livewire:statistic-status label="Pelajar" value="{{ $this->studentCount }}" icon="bi-backpack" color="primary" />
    </div>
    <div class="col-md-3">
      <livewire:statistic-status label="Kelas" value="{{ $this->schoolClassCount }}" icon="bi-bookmark" color="info" />
    </div>
    <div class="col-md-3">
      <livewire:statistic-status label="Jurusan" value="{{ $this->schoolMajorCount }}" icon="bi-briefcase"
        color="warning" />
    </div>
    <div class="col-md-3">
      <livewire:statistic-status label="Pengguna" value="{{ $this->userCount }}" icon="bi-person-badge"
        color="danger" />
    </div>
  </section>
</div>