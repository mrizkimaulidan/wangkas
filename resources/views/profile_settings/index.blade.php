@extends('layouts.app')

@section('title', 'Pengaturan Profil')

@section('page-heading')
<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Pengaturan Profil</h3>
				<p class="text-subtitle text-muted">Halaman untuk mengubah informasi pengguna.
				</p>
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							Pengaturan Profil
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="col-12 col-lg-12">
		@include('utilities.alert')
		<div class="card">
			<div class="card-body">
				<form action="{{ route('profile-settings.update') }}" method="POST">
					@csrf
					@method('PUT')
					<div class="form-group">
						<label for="name" class="form-label">Nama Lengkap</label>
						<input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama lengkap..."
							value="{{ auth()->user()->name }}">
					</div>
					<div class="form-group">
						<label for="email" class="form-label">Email</label>
						<input type="text" name="email" id="email" class="form-control" placeholder="Masukkan email..."
							value="{{ auth()->user()->email }}">
					</div>
					<div class="form-group">
						<label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
						<input type="password" name="current_password" id="current_password" class="form-control"
							placeholder="Masukkan kata sandi saat ini...">
						<div class="form-text">Kosongkan kata sandi jika tidak ingin diubah.</div>
					</div>
					<div class="form-group">
						<label for="password" class="form-label">Kata Sandi Baru</label>
						<input type="password" name="password" id="password" class="form-control"
							placeholder="Masukkan kata sandi baru...">
					</div>
					<div class="form-group">
						<label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
							placeholder="Konfirmasi kata sandi baru...">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success">Ubah Profil</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
