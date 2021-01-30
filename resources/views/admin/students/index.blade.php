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
                @forelse ($students as $student)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->school_classes->name }}
                    <td>{{ $student->school_majors->name }}</td>
                    <td>{{ $student->school_year_start }}-{{ $student->school_year_end }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <div class="mx-1">
                                <button type="button" data-id="{{ $student->id }}"
                                    class="btn btn-primary btn-sm school-class-detail" data-bs-toggle="modal"
                                    data-bs-target="#showStudentModal">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>

                            <div class="mx-1">
                                <button type="button" data-id="{{ $student->id }}"
                                    class="btn btn-success btn-sm school-class-detail" data-bs-toggle="modal"
                                    data-bs-target="#editStudentModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </div>

                            <div class="mx-1">
                                <form action="{{ route('admin.siswa.destroy', $student->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-notification">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty

                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection

@push('modal')
@include('admin.students.modal.create')
@include('admin.students.modal.show')
@include('admin.students.modal.edit')
@endpush