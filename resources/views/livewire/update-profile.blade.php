<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Ubah Profil</h5>
      <form wire:submit="edit">
        <div class="row">
          <div class="col">
            <x-forms.input-with-icon wire:model="form.name" label="Nama Lengkap" name="form.name" type="text"
              icon="bi bi-person" placeholder="Masukan nama lengkap.." />

            <x-forms.input-with-icon wire:model="form.email" label="Alamat Email" name="form.email" type="email"
              icon="bi bi-envelope-at" placeholder="Masukan alamat email.." />

            <x-forms.input-with-icon wire:model="form.current_password" label="Kata Sandi Saat Ini"
              name="form.current_password" type="password" icon="bi bi-lock"
              placeholder="Masukan kata sandi saat ini.." />

            <x-forms.input-with-icon wire:model="form.password" label="Kata Sandi Baru" name="form.password"
              type="password" icon="bi bi-lock" placeholder="Masukan kata sandi baru.." />

            <x-forms.input-with-icon wire:model="form.password_confirmation" label="Konfirmasi Kata Sandi Baru"
              name="form.password_confirmation" type="password" icon="bi bi-lock"
              placeholder="Masukan konfirmasi kata sandi baru.." />
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
