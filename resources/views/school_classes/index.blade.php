@extends('layouts.main', ['title' => 'Kelas', 'page_heading' => 'Data Kelas'])

@section('content')
<section class="row">
	@include('utilities.alert-flash-message')
	<div class="col card px-3 py-3">
		<div class="d-flex justify-content-end pb-3">
			<div class="btn-group d-gap gap-2">
				<a href="{{ route('school-classes.index.history') }}" class="btn btn-secondary">
					<span class="badge">{{ $schoolClassesTrashedCount }}</span> Histori Data Kelas
				</a>
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSchoolClassModal">
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
@include('school_classes.modal.create')
@include('school_classes.modal.show')
@include('school_classes.modal.edit')
@endpush

@push('js')
@include('school_classes.script')
@endpush