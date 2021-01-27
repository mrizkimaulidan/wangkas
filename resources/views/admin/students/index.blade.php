@extends('layouts.mazer.app', ['title' => 'Siswa', 'page_heading' => 'Data Siswa'])

@section('content')
<section class="row">
    <div class="col-md-12 card px-3 py-3 table-responsive">
        <div class="col-md-12 py-2">
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                data-bs-target="#addStudentModal">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </button>
        </div>

        <table class="table table-sm" id="datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Tahun Ajaran</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Muhammad Rizki Maulidan</td>
                    <td>XII RPL 1</td>
                    <td>Rekayasa Perangkat Lunak</td>
                    <td>2018-2021</td>
                    <td>
                        <div class="btn-group" role="group">
                            <div class="mx-1">
                                <a href="#" class="btn btn-primary btn-sm">
                                    <i class="bi bi-search"></i>
                                </a>
                            </div>

                            <div class="mx-1">
                                <a href="#" class="btn btn-success btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </div>

                            <div class="mx-1">
                                <form action="#" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
@endsection

@push('modal')
@include('admin.students.modal.create')
@endpush