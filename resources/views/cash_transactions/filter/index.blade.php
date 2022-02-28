@extends('layouts.main', ['title' => 'Filter Kas', 'page_heading' => 'Filter Kas'])

@section('content')
<section class="row">
	<div class="card px-3 py-3">
		<label for="start_date" class=" fw-bold pb-3">Filter Data dengan Rentang Tanggal :</label>
		<div class="input-group">
			<input type="date" name="start_date" class="form-control" id="start_date" placeholder="Pilih tanggal awal..">
			<input type="date" name="end_date" class="form-control" id="end_date" placeholder="Pilih tanggal akhir..">
			<button type="button" class="btn btn-primary" id="filter">Filter</button>
		</div>
	</div>

	@include('utilities.alert-flash-message')
	<div class="col card px-3 py-3" id="datatable-wrap" style="display: none;">
		<div class="table-responsive">
			<table class="table table-sm w-100" id="datatable">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama Pelajar</th>
						<th scope="col">Tagihan</th>
						<th scope="col">Total Bayar</th>
						<th scope="col">Tanggal</th>
						<th scope="col">Admin Pencatat</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</section>
@endsection

@push('js')
@include('cash_transactions.filter.script')
@endpush