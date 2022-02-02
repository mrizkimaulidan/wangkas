@extends('layouts.main', ['title' => 'Pelajar', 'page_heading' => 'Data Pelajar'])

@section('content')
<section class="row">
	<div class="col-6">
		<div class="card">
			<div class="card-body px-3 py-4-5">
				<div class="row">
					<div class="col-4">
						<div class="stats-icon green">
							<i class="iconly-boldProfile"></i>
						</div>
					</div>
					<div class="col-8">
						<h6 class="text-muted font-semibold">Laki-laki</h6>
						<h6 class="font-extrabold mb-0">
							{{ $maleStudentCount }}
						</h6>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-6">
		<div class="card">
			<div class="card-body px-3 py-4-5">
				<div class="row">
					<div class="col-4">
						<div class="stats-icon blue">
							<i class="iconly-boldProfile"></i>
						</div>
					</div>
					<div class="col-8">
						<h6 class="text-muted font-semibold">Perempuan</h6>
						<h6 class="font-extrabold mb-0">
							{{ $femaleStudentCount }}
						</h6>
					</div>
				</div>
			</div>
		</div>
	</div>

	@include('utilities.alert-flash-message')
	<div class="col card px-3 py-3">
		<div class="d-flex justify-content-end pb-3">
			<div class="btn-group d-gap gap-2">
				<a href="{{ route('students.export') }}" class="btn btn-success">
					<i class="bi bi-file-earmark-excel-fill"></i>
					Export Excel
				</a>
				<a href="{{ route('students.index.history') }}" class="btn btn-secondary">
					<span class="badge">{{ $studentTrashedCount }}</span> Histori Data Pelajar
				</a>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
					<i class="bi bi-plus-circle"></i> Tambah Data
				</button>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-sm w-100" id="datatable">
				<thead>
					<tr>
						<th scope=" col">#</th>
						<th scope="col">NIS/NISN/NIM</th>
						<th scope="col">Nama Lengkap</th>
						<th scope="col">Kelas</th>
						<th scope="col">Jurusan</th>
						<th scope="col">TA</th>
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
@include('students.modal.create')
@include('students.modal.show')
@include('students.modal.edit')
@endpush

@push('js')
@include('students.script')
@endpush
