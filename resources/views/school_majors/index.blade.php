@extends('layouts.main', ['title' => 'Jurusan', 'page_heading' => 'Data Jurusan'])

@section('content')
<section class="row">
	@include('utilities.alert-flash-message')
	<div class="col card px-3 py-3">
		<div class="d-flex justify-content-end pb-3">
			<div class="btn-group d-gap gap-2">
				<a href="{{ route('school-majors.index.history') }}" class="btn btn-secondary">
					<span class="badge">{{ $schoolMajorTrashedCount }}</span> Histori Data Jurusan
				</a>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSchoolMajorModal">
					<i class="bi bi-plus-circle"></i> Tambah Data
				</button>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-sm w-100" id="datatable">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Nama</th>
						<th scope="col">Singkatan</th>
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
@include('school_majors.modal.create')
@include('school_majors.modal.show')
@include('school_majors.modal.edit')
@endpush

@push('js')
@include('school_majors.script')
@endpush