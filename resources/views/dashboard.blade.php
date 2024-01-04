@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-heading')
<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Dashboard</h3>
				<p class="text-subtitle text-muted">Dashboard.</p>
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">Dashboard</a>
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
	<div class="col-12 col-lg-9">
		<div class="row">
			<div class="col-6 col-lg-3 col-md-6">
				<div class="card">
					<div class="card-body px-4 py-4-5">
						<div class="row">
							<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
								<div class="stats-icon purple mb-2">
									<i class="iconly-boldProfile"></i>
								</div>
							</div>
							<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
								<h6 class="text-muted font-semibold">
									Pelajar
								</h6>
								<h6 class="font-extrabold mb-0">{{ $counts['students'] }}</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3 col-md-6">
				<div class="card">
					<div class="card-body px-4 py-4-5">
						<div class="row">
							<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
								<div class="stats-icon blue mb-2">
									<i class="iconly-boldBookmark"></i>
								</div>
							</div>
							<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
								<h6 class="text-muted font-semibold">Kelas</h6>
								<h6 class="font-extrabold mb-0">{{ $counts['schoolClasses'] }}</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3 col-md-6">
				<div class="card">
					<div class="card-body px-4 py-4-5">
						<div class="row">
							<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
								<div class="stats-icon green mb-2">
									<i class="iconly-boldBag"></i>
								</div>
							</div>
							<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
								<h6 class="text-muted font-semibold">Jurusan</h6>
								<h6 class="font-extrabold mb-0">{{ $counts['schoolMajors'] }}</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3 col-md-6">
				<div class="card">
					<div class="card-body px-4 py-4-5">
						<div class="row">
							<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
								<div class="stats-icon red mb-2">
									<i class="iconly-boldProfile"></i>
								</div>
							</div>
							<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
								<h6 class="text-muted font-semibold">Administrator</h6>
								<h6 class="font-extrabold mb-0">{{ $counts['administrators'] }}</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 col-lg-3">
		<div class="card">
			<div class="card-body py-4 px-4">
				<div class="d-flex align-items-center">
					<div class="avatar avatar-xl">
						<img src="{{ asset('compiled/jpg/1.jpg') }}" alt=" Face 1" />
					</div>
					<div class="ms-3 name">
						<h5 class="font-bold">{{ auth()->user()->name }}</h5>
						<h6 class="text-muted mb-0">{{ auth()->user()->email }}</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-9">
		<div class="card">
			<div class="card-header">
				<h4 id="card-chart-cash-transactions-title">Total Transaksi Tahun Ini</h4>
				<div class="mb-3">
					<label for="year" class="form-label">Isi Tahun:</label>
					<input type="number" id="year" placeholder="Masukan tahun.." value="{{ date('Y') }}" class="form-control">
					<div class="form-text">Tekan tombol `Enter` untuk menampilkan grafik berdasarkan tahun yang dipilih.</div>
				</div>
			</div>
			<div class="card-body">
				<div id="chart-cash-transactions-by-year"></div>
			</div>
		</div>
	</div>

	<div class="col-9">
		<div class="card">
			<div class="card-header">
				<h4>Total Transaksi Per Tahun</h4>
			</div>
			<div class="card-body">
				<div id="chart-cash-transactions-per-year"></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-9">
		<div class="card">
			<div class="card-header">
				<h4>Total Jumlah Pembayaran Transaksi Per Tahun</h4>
			</div>
			<div class="card-body">
				<div id="chart-cash-transactions-amount-per-year"></div>
			</div>
		</div>
	</div>
</div>
@endsection

@pushOnce('scripts')
<script src="{{ asset('extensions/apexcharts/apexcharts.min.js') }}"></script>
@include('script')
@endPushOnce
