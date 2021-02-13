@extends('layouts.mazer.app', ['title' => 'Jurusan', 'page_heading' => 'Data Jurusan'])

@section('content')
<section class="row">
    @include('utilities.alert-flash-message')
    <div class="col-md-12 card px-3 py-3 table-responsive">
        <div class="col-md-12 py-2">
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                data-bs-target="#addSchoolMajorModal">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </button>
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
                @foreach($school_majors as $key => $school_major)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $school_major->name }}</td>
                    <td>
                        <span class="badge rounded-pill bg-primary">
                            {{ $school_major->abbreviated_word }}
                        </span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <div class="mx-1">
                                <button type="button" data-id="{{ $school_major->id }}"
                                    class="btn btn-primary btn-sm school-major-detail" data-bs-toggle="modal"
                                    data-bs-target="#showSchoolMajorModal">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>

                            <div class="mx-1">
                                <button type="button" data-id="{{ $school_major->id }}"
                                    class="btn btn-success btn-sm school-major-edit" data-bs-toggle="modal"
                                    data-bs-target="#editSchoolMajorModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </div>

                            <div class="mx-1">
                                <form action="{{ route('jurusan.destroy', $school_major->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-notification">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
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