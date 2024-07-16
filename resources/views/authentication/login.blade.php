@extends('authentication.layouts.app')

@section('content')
<div class="row h-100">
	<div class="col-lg-5 col-12">
		<div id="auth-left">
			<h1 class="auth-title">Log in.</h1>
			<p class="auth-subtitle mb-5">
				Log in untuk melanjutkan ke dalam dashboard.
			</p>
			@include('utilities.alert')
			<form action="{{ route('login') }}" method="POST">
				@csrf
				<div class="form-group position-relative has-icon-left mb-4">
					<input type="text" class="form-control form-control-xl" name="email" placeholder="Email" autofocus />
					<div class="form-control-icon">
						<i class="bi bi-person"></i>
					</div>
				</div>
				<div class="form-group position-relative has-icon-left mb-4">
					<input type="password" class="form-control form-control-xl" name="password" placeholder="Password" />
					<div class="form-control-icon">
						<i class="bi bi-shield-lock"></i>
					</div>
				</div>
				<div class="form-check form-check-lg d-flex align-items-end">
					<input class="form-check-input me-2" type="checkbox" value="1" name="remember_me" id="flexCheckDefault" />
					<label class="form-check-label text-gray-600" for="flexCheckDefault">
						Ingat saya
					</label>
				</div>
				<button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
					Log in
				</button>
			</form>
		</div>
	</div>
	<div class="col-lg-7 d-none d-lg-block">
		<div id="auth-right"></div>
	</div>
</div>
@endsection
