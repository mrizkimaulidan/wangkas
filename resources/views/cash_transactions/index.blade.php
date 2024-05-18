@extends('layouts.app')

@section('title', 'Data Kas Minggu Ini')

@section('page-heading')
<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Data Kas Minggu Ini</h3>
				<p class="text-subtitle text-muted">Halaman untuk manajemen data kas minggu ini seperti melihat, mengubah dan
					menghapus.
				</p>
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							Data Kas Minggu Ini
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
	<div class="col-6 col-lg-6 col-md-6">
		<div class="card">
			<div class="card-body px-3 py-4-4">
				<div class="row">
					<div class="col-md-4">
						<div class="stats-icon">
							<i class="iconly-boldChart"></i>
						</div>
					</div>
					<div class="col-md-8">
						<h6 class="text-muted font-semibold">Total Bulan Ini</h6>
						<h6 class="font-extrabold mb-0">
							{{ $cashTransaction['total']['thisWeek'] }}</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-6 col-lg-6 col-md-6">
		<div class="card">
			<div class="card-body px-3 py-4-4">
				<div class="row">
					<div class="col-md-4">
						<div class="stats-icon">
							<i class="iconly-boldChart"></i>
						</div>
					</div>
					<div class="col-md-8">
						<h6 class="text-muted font-semibold">Total Tahun Ini</h6>
						<h6 class="font-extrabold mb-0">
							{{ $cashTransaction['total']['thisYear'] }}</h6>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-6 col-lg-6 col-md-6">
		<div class="card">
			<div class="card-body px-3 py-4-4">
				<div class="row">
					<div class="col-md-4">
						<div class="stats-icon green">
							<i class="iconly-boldActivity"></i>
						</div>
					</div>
					<div class="col-md-8">
						<h6 class="text-muted font-semibold">Sudah Membayar Minggu Ini</h6>
						<h6 class="font-extrabold mb-0">
							{{ $cashTransaction['studentsPaidThisWeekCount'] }}</h6>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-6 col-lg-6 col-md-6">
		<div class="card">
			<div class="card-body px-3 py-4-4">
				<div class="row">
					<div class="col-md-4">
						<div class="stats-icon red">
							<i class="iconly-boldActivity"></i>
						</div>
					</div>
					<div class="col-md-8">
						<h6 class="text-muted font-semibold">Belum Membayar Minggu Ini</h6>
						<h6 class="font-extrabold mb-0">
							{{ $cashTransaction['studentsNotPaidThisWeekCount'] }}</h6>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 col-lg-12 col-md-12">
		<div class="card">
			<div class="card-header text-center">
				<h4>Belum Membayar Minggu Ini <span class="fw-bolder fst-italic">({{ $cashTransaction['dateRange']['start']
						}} sampai {{ $cashTransaction['dateRange']['end'] }})</span></h4>
			</div>
			@if($cashTransaction['studentsNotPaidThisWeekCount'] > 0) <div class="card-content pb-4">
				<div class="px-4">
					<button type="button" class='btn btn-block btn-xl btn-light-danger font-bold' data-bs-toggle="modal"
						data-bs-target="#notPaidModal">Ada
						<b>{{ $cashTransaction['studentsNotPaidThisWeekCount'] }}</b> orang belum membayar pada minggu
						ini! <i class="bi bi-exclamation-triangle"></i></button>
				</div>
				<span class="badge w-100 rounded-pill bg-warning mb-3"></span>
				<div class="row">
					@foreach ($cashTransaction['studentsNotPaidThisWeekWithLimit'] as $student)
					<div class="col-6 col-lg-6 col-md-6">
						<div class="recent-message d-flex px-4 py-3">
							<div class="name ms-4">
								<h5 class="mb-1">{{ $student->name }}</h5>
								<h6 class="text-muted mb-0">
									{{ $student->student_identification_number }}</h6>
							</div>
						</div>
					</div>
					@endforeach
				</div>

				<div class="px-4">
					<button type="button" class='btn btn-block btn-xl btn-light-primary font-bold' data-bs-toggle="modal"
						data-bs-target="#notPaidModal">Lihat
						Selengkapnya</button>
				</div>
			</div>
			@else
			<div class="px-4">
				<p class='btn btn-block btn-xl btn-light-success font-bold'>Semua sudah membayar pada minggu ini! <i
						class="bi bi-emoji-laughing"></i></p>
			</div>
			@endif
		</div>
	</div>

	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="col card">
					<div class="d-flex justify-content-end pb-3">
						<div class="btn-group gap gap-2">
							<button type="button" class="btn btn-primary icon icon-left" data-bs-toggle="modal"
								data-bs-target="#createModal">
								<i class="bi bi-plus-circle"></i> Tambah Data Kas
							</button>
						</div>
					</div>

					<div class="table-responsive">
						<table class="table w-100 table-hover" id="table">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Nama Pelajar</th>
									<th scope="col">Total Bayar</th>
									<th scope="col">Tanggal</th>
									<th scope="col">Dicatat Oleh</th>
									<th scope="col">Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@pushOnce('modal')
@include('cash_transactions.modal.create')
@include('cash_transactions.modal.show')
@include('cash_transactions.modal.edit')
@include('cash_transactions.modal.not-paid')
@endPushOnce

@pushOnce('scripts')
@include('cash_transactions.script')
@endPushOnce
