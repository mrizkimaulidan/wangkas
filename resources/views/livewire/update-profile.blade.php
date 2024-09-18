<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Ubah Profil</h5>
      <form wire:submit="edit">
        <div class="row">
          <div class="col">
            <div class="mb-3">
              <label for="name" class="form-label">Nama Lengkap:</label>
              <input wire:model.blur="form.name" type="text"
                class="form-control @error('form.name') is-invalid @enderror" id="name"
                placeholder="Masukan nama lengkap..">
              <div>
                @error('form.name')
                <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Alamat Email:</label>
              <input wire:model.blur="form.email" type="email"
                class="form-control @error('form.email') is-invalid @enderror" id="email"
                placeholder="Masukan alamat email..">
              <div>
                @error('form.email')
                <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="mb-3">
              <label for="current_password" class="form-label">Kata Sandi Saat Ini:</label>
              <input wire:model.blur="form.current_password" type="password"
                class="form-control @error('form.current_password') is-invalid @enderror" id="current_password"
                placeholder="Masukan kata sandi saat ini..">
              <div>
                @error('form.current_password')
                <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Kata Sandi Baru:</label>
              <input wire:model.blur="form.password" type="password"
                class="form-control @error('form.password') is-invalid @enderror" id="password"
                placeholder="Masukan kata sandi baru..">
              <div>
                @error('form.password')
                <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru:</label>
              <input wire:model.blur="form.password_confirmation" type="password"
                class="form-control @error('form.password_confirmation') is-invalid @enderror"
                id="password_confirmation" placeholder="Masukan konfirmasi kata sandi baru..">
              <div>
                @error('form.password_confirmation')
                <div class="d-block invalid-feedback fw-bold">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
        </div>

        <button wire:loading.remove type="submit" class="btn btn-primary">Simpan</button>

        <div wire:loading wire:target="save">
          <button class="btn btn-primary" type="button" disabled>
            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
            <span role="status">Menyimpan...</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
