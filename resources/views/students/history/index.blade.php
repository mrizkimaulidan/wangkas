@extends('layouts.main', ['title' => 'Pelajar', 'page_heading' => 'Histori Daftar Pelajar Yang Telah Dihapus'])

@section('content')
<section class="row">
    @include('utilities.alert-flash-message')
    <div class="col-md-12 card px-3 py-3 table-responsive">
        <div class="col-md-12 py-2">
            <a href="{{ route('students.index') }}" class="btn btn-primary float-end mx-2">
                <i class="bi bi-caret-left-square"></i> Kembali Ke Daftar Pelajar
            </a>
        </div>

        <table class="table table-sm" id="datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NIS/NISN</th>
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
</section>
@endsection

@push('js')
@include('students.history.script')
@endpush