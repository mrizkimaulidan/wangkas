@extends('layouts.main', ['title' => 'Kas', 'page_heading' => 'Data Kas'])

@section('content')
<section class="row">
	{{-- Start Statistics --}}
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
							{{ $data['totals']['thisMonth'] }}</h6>
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
							{{ $data['totals']['thisYear'] }}</h6>
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
							{{ $data['studentCountWho']['paidThisWeek'] }}</h6>
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
							{{ $data['studentCountWho']['notPaidThisWeek'] }}</h6>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 col-lg-12 col-md-12">
		<div class="card">
			<div class="card-header">
				<h4>Belum Membayar Minggu Ini </h4>
			</div>
			@if($data['studentCountWho']['notPaidThisWeek'] > 0)
			<div class="px-4">
				<button type="button" class='btn btn-block btn-xl btn-light-danger font-bold mt-3' data-bs-toggle="modal"
					data-bs-target="#lookMoreModal">Ada
					<b>{{ $data['studentCountWho']['notPaidThisWeek'] }}</b> orang belum membayar pada minggu
					ini! <i class="bi bi-exclamation-triangle"></i></button>
			</div>

			<span class="badge w-100 rounded-pill bg-warning mb-3"></span>
			<div class="card-content pb-4">
				<div class="row">
					@foreach($data['students']['notPaidThisWeekLimit'] as
					$studentNotPaidThisWeek)
					<div class="col-6 col-lg-6 col-md-6">
						<div class="recent-message d-flex px-4 py-3">
							<div class="name ms-4">
								<h5 class="mb-1">{{ $studentNotPaidThisWeek->name }}</h5>
								<h6 class="text-muted mb-0">
									{{ $studentNotPaidThisWeek->student_identification_number }}</h6>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<div class="px-4">
					<button type="button" class='btn btn-block btn-xl btn-light-primary font-bold mt-3' data-bs-toggle="modal"
						data-bs-target="#lookMoreModal">Lihat
						Selengkapnya</button>
				</div>
			</div>
			@else
			<div class="px-4">
				<p class='btn btn-block btn-xl btn-light-success font-bold my-3'>Terima kasih! Semua sudah membayar <i
						class="bi bi-emoji-laughing"></i></p>
			</div>
			@endif
		</div>
	</div>
	{{-- End of Statistics --}}

	@include('utilities.alert-flash-message')
	<div class="col card px-3 py-3">
		<div class="d-flex justify-content-end pb-3">
			<div class="btn-group d-gap gap-2">
				<a href="{{ route('cash-transactions.export') }}" class="btn btn-success">
					<i class="bi bi-file-earmark-excel-fill"></i>
					Export Excel
				</a>
				<a href="{{ route('cash-transactions.index.history') }}" class="btn btn-secondary">
					<span class="badge">{{ $cashTransactionTrashedCount }}</span> Histori Data Kas
				</a>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCashTransactionModal">
					<i class="bi bi-plus-circle"></i> Tambah Data
				</button>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-sm w-100" id="datatable">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Pelajar</th>
						<th scope="col">Tagihan</th>
						<th scope="col">Total Bayar</th>
						<th scope="col">Tanggal</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</section>
@endsection

@push('modal')
@include('cash_transactions.modal.create')
@include('cash_transactions.modal.show')
@include('cash_transactions.modal.edit')

@include('cash_transactions.modal.look-more' )
@endpush

@push('js')
@include('cash_transactions.script')
@endpush
