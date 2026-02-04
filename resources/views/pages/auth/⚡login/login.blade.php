<div>
  <div id="auth">
    <div class="row h-100">
      <div class="col-lg-5 col-12">
        <div id="auth-left">
          <h1 class="auth-title">Log in.</h1>
          <p class="auth-subtitle mb-5">Masuk untuk melanjutkan ke dalam aplikasi.</p>

          @livewire('alert')

          <form wire:submit="login">
            <div class="form-group position-relative has-icon-left mb-4">
              <input wire:model="email" type="email"
                class="form-control form-control-xl @error('email') is-invalid @enderror" placeholder="Alamat Email"
                autofocus>
              <div class="form-control-icon">
                <i class="bi bi-person"></i>
              </div>
              @error('email')
              <div class="invalid-feedback">{{ $errors->first('email') }}</div>
              @enderror
            </div>
            <div class="form-group position-relative has-icon-left mb-4">
              <input wire:model="password" type="password" class="form-control form-control-xl"
                placeholder="Kata Sandi">
              <div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
              </div>
            </div>
            <div class="form-check form-check-lg d-flex align-items-end">
              <input wire:model="remember" class="form-check-input me-2" type="checkbox" value="" id="remember_me">
              <label class="form-check-label text-gray-600" for="remember_me">
                Ingat saya
              </label>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
          </form>
        </div>
      </div>
      <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
      </div>
    </div>
  </div>