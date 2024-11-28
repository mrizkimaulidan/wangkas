<div>
  <div id="auth">
    <div class="row h-100">
      <div class="col-lg-5 col-12">
        <div id="auth-left">
          <h1 class="auth-title">Log in.</h1>
          <p class="auth-subtitle mb-5">Log in untuk melanjutkan ke dalam dashboard.</p>

          @if (session('error'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          @error('email')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @enderror

          @error('password')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @enderror

          <form wire:submit.prevent="authenticate">
            <div class="form-group position-relative has-icon-left mb-4">
              <input type="email" wire:model.blur="email"
                class="form-control form-control-xl @error('email') is-invalid @enderror" placeholder="Alamat Email"
                autofocus>
              <div class="form-control-icon">
                <i class="bi bi-person"></i>
              </div>
            </div>

            <div class="form-group mb-4 position-relative has-icon-left">
              <input type="{{ $input_type }}" wire:model.blur="password"
                class="form-control form-control-xl pe-5 @error('password') is-invalid @enderror"
                placeholder="Kata Sandi" />
              <span wire:click="togglePasswordVisibility" title="{{ $input_title }}"
                class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted" style="cursor: pointer;">
                <i class="{{ $icon }}"></i>
              </span>

              <div class="form-control-icon">
                <i class="bi bi-lock"></i>
              </div>
            </div>

            <div class="form-check d-flex align-items-center">
              <input class="form-check-input me-2" wire:model="remember_me" type="checkbox" id="rememberMe">
              <label class="form-check-label text-gray-600" for="rememberMe">
                Ingat Saya
              </label>
            </div>

            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">Masuk</button>
          </form>
        </div>
      </div>

      {{-- Right Column --}}
      <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right"></div>
      </div>
    </div>
  </div>
</div>
