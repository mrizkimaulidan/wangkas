@extends('layouts.main', ['title' => 'Pelajar', 'page_heading' => 'Data Pelajar'])

@section('content')
<section class="row">
    <div class="col-6 col-lg-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon green">
                            <i class="iconly-boldProfile"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Laki-laki</h6>
                        <h6 class="font-extrabold mb-0">
                            {{ $count_male_student }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon blue">
                            <i class="iconly-boldProfile"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Perempuan</h6>
                        <h6 class="font-extrabold mb-0">
                            {{ $count_female_student }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('utilities.alert-flash-message')
    <div class="col-md-12 card px-3 py-3 table-responsive">
        <div class="col-md-12 py-2">
            <a href="{{ route('students.export') }}" class="btn btn-success btn-sm mb-3">
                <i class="bi bi-file-earmark-excel-fill"></i>
                Export Excel
            </a>
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                data-bs-target="#addStudentModal">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </button>
            <a href="{{ route('students.index.history') }}" class="btn btn-secondary float-end mx-2">
                <span class="badge">{{ $count_students_trashed }}</span> Histori Data Pelajar
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
                {{-- @foreach ($students as $student)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $student->student_identification_number }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->school_classes->name }}
                <td>
                    <span class="badge w-100 rounded-pill bg-success" data-bs-toggle="tooltip" data-placement="top"
                        title="{{ $student->school_majors->name }}">
                        {{ $student->school_majors->abbreviated_word }}
                    </span>
                </td>
                <td>
                    <span class="badge w-100 rounded-pill bg-primary">
                        {{ $student->school_year_start }}-{{ $student->school_year_end }}
                    </span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <div class="mx-1">
                            <button type="button" data-id="{{ $student->id }}"
                                class="btn btn-primary btn-sm student-detail" data-bs-toggle="modal"
                                data-bs-target="#showStudentModal">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>

                        <div class="mx-1">
                            <button type="button" data-id="{{ $student->id }}"
                                class="btn btn-success btn-sm student-edit" data-bs-toggle="modal"
                                data-bs-target="#editStudentModal">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </div>

                        <div class="mx-1">
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-notification">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
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