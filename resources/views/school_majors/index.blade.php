@extends('layouts.main', ['title' => 'Jurusan', 'page_heading' => 'Data Jurusan'])

@section('content')
<section class="row">
    @include('utilities.alert-flash-message')
    <div class="col-md-12 card px-3 py-3 table-responsive">
        <div class="col-md-12 py-2">
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                data-bs-target="#addSchoolMajorModal">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </button>

            <a href="{{ route('school-majors.index.history') }}" class="btn btn-secondary float-end mx-2">
                <span class="badge">{{ $count_school_majors_trashed }}</span> Histori Data Jurusan
            </a>
        </div>

        <table class="table table-sm" id="datatable">
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