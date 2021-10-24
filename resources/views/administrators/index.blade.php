@extends('layouts.main', ['title' => 'Administrator', 'page_heading' => 'Data Administrator'])

@section('content')
<section class="row">
    @include('utilities.alert-flash-message')
    <div class="col card px-3 py-3">
        <div class="d-flex justify-content-end pb-3">
            <div class="btn-group d-gap gap-2">
                <a href="{{ route('administrators.export') }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-excel-fill"></i>
                    Export Excel
                </a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addAdministratorModal">
                    <i class="bi bi-plus-circle"></i> Tambah Data
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-sm w-100" id="datatable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tanggal Ditambahkan</th>
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
@include('administrators.modal.create')
@include('administrators.modal.show')
@include('administrators.modal.edit')
@endpush

@push('js')
@include('administrators.script')
@endpush