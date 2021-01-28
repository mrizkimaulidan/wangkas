@extends('layouts.mazer.app', ['title' => 'Kelas', 'page_heading' => 'Data Kelas'])

@section('content')
<section class="row">
    @include('utilities.alert-flash-message')
    <div class="col-md-12 card px-3 py-3 table-responsive">
        <div class="col-md-12 py-2">
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                data-bs-target="#addSchoolClassModal">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </button>
        </div>

        <table class="table table-sm" id="datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($school_classes as $school_class)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $school_class->name }}
                    <td>
                        <div class="btn-group" role="group">
                            <div class="mx-1">
                                <button type="button" data-id="{{ $school_class->id }}"
                                    class="btn btn-primary btn-sm school-class-detail" data-bs-toggle="modal"
                                    data-bs-target="#showSchoolClassModal">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>

                            <div class="mx-1">
                                <a class="btn btn-success btn-sm">
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
                @empty
                <span>Data kosong</span>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection

@push('modal')
@include('admin.school_classes.modal.create')
@include('admin.school_classes.modal.show')
@endpush

@push('js')
@include('admin.school_classes.script')
@endpush