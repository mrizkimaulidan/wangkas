@extends('layouts.app')

@section('title', 'Filter Transaksi Kas')

@section('page-heading')
<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Filter Transaksi Kas</h3>
				<p class="text-subtitle text-muted">Halaman filter transaksi kas.</p>

				@isset($cashTransactions['dateRange'])
				<p class="text-subtitle text-muted">Menampilkan filter pada rentang tanggal
					<span class="fw-bold">{{
						$cashTransactions['dateRange']['start'] }} - {{ $cashTransactions['dateRange']['end'] }}</span>
				</p>
				@endisset
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							Filter Transaksi Kas
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
	<div class="col-12">
		@include('utilities.alert')
		<div class="row">
			<div class="col-12 col-lg-6 col-md-6">
				<div class="card">
					<div class="card-body px-3 py-4-4">
						<div class="row">
							<div class="col-md-4">
								<div class="stats-icon green">
									<i class="iconly-boldActivity"></i>
								</div>
							</div>
							<div class="col-md-8">
								<h6 class="text-muted font-semibold">Sudah Membayar Pada Rentang Tanggal Tersebut</h6>
								<h6 class="font-extrabold mb-0">
									{{ $cashTransactions['studentsPaidCount'] ?? 0 }}</h6>
							</div>
						</div>
						<div class="pt-4">
							<button type="button" class='btn btn-block btn-xl btn-light-primary font-bold' data-bs-toggle="modal"
								data-bs-target="#paidModal">Lihat
								Selengkapnya</button>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12 col-lg-6 col-md-6">
				<div class="card">
					<div class="card-body px-3 py-4-4">
						<div class="row">
							<div class="col-md-4">
								<div class="stats-icon red">
									<i class="iconly-boldActivity"></i>
								</div>
							</div>
							<div class="col-md-8">
								<h6 class="text-muted font-semibold">Belum Membayar Pada Rentang Tanggal Tersebut</h6>
								<h6 class="font-extrabold mb-0">
									{{ $cashTransactions['studentsNotPaidCount'] ?? 0 }}</h6>
							</div>
						</div>
						<div class="pt-4">
							<button type="button" class='btn btn-block btn-xl btn-light-primary font-bold' data-bs-toggle="modal"
								data-bs-target="#notPaidModal">Lihat
								Selengkapnya</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12">
		<div class="card text-center">
			<div class="card-header">
				<h4>Filter Data dengan Rentang Tanggal</h4>
			</div>
			<div class="card-body">
				<form action="" method="GET">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group has-icon-left">
								<label for="start_date">Tanggal Mulai:</label>
								<div class="position-relative">
									<input type="date" class="form-control" value="{{ request('start_date') }}" name="start_date"
										id="start_date" placeholder="Masukkan tanggal mulai...">
									<div class="form-control-icon">
										<i class="bi bi-calendar2-fill"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group has-icon-left">
								<label for="end_date">Tanggal Akhir:</label>
								<div class="position-relative">
									<input type="date" class="form-control" value="{{ request('end_date') }}" name="end_date"
										id="end_date" placeholder="Masukkan tanggal akhir...">
									<div class="form-control-icon">
										<i class="bi bi-calendar2-fill"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button type="submit" class="btn btn-primary px-5">Filter</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	@isset($cashTransactions['filteredResult'])
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h6 class="pb-3">Daftar hasil filter data dari rentang tanggal {{ $cashTransactions['dateRange']['start'] }} -
					{{
					$cashTransactions['dateRange']['end'] }}</h6>
				<div class="table-responsive">
					<table class="table w-100 table-hover" id="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Pelajar</th>
								<th>Tanggal Transaksi</th>
								<th>Nominal Pembayaran</th>
								<th>Dicatat Oleh</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($cashTransactions['filteredResult'] as $cashTransaction)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $cashTransaction->student->name }}</td>
								<td>{{ $cashTransaction->date_paid_formatted }}</td>
								<td>{{ $cashTransaction->amount_formatted }}</td>
								<td>{{ $cashTransaction->createdBy->name }}</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td colspan="4" align="right"><b>Total</b></td>
								<td>{{ $cashTransactions['sum'] }}</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	@endisset
</div>
@endsection

@pushIf($cashTransactions,'modal')
@include('cash_transactions.filter.modal.paid')
@include('cash_transactions.filter.modal.not-paid')
@endPushIf

@pushOnce('scripts')
<script>
	$(function () {
		const table = $('#table').DataTable({});
	});
</script>
@endPushOnce
