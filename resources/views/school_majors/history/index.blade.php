@extends('layouts.main', ['title' => 'Jurusan', 'page_heading' => 'Histori Daftar Jurusan Yang Telah Dihapus'])

@section('content')
<section class="row">
    @include('utilities.alert-flash-message')
    <div class="col-md-12 card px-3 py-3 table-responsive">
        <div class="col-md-12 py-2">
            <a href="{{ route('school-majors.index') }}" class="btn btn-primary float-end mx-2">
                <i class="bi bi-caret-left-square"></i> Kembali Ke Daftar Jurusan
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
                {{-- @foreach ($school_majors as $school_major)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $school_major->name }}</td>
                <td>
                    <span class="badge w-100 rounded-pill bg-primary">
                        {{ $school_major->abbreviated_word }}
                    </span>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        <div class="mx-1">
                            <form action="{{ route('school-majors.restore.history', $school_major->id) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm restore-button">
                                    <i class="bi bi-arrow-bar-left"></i>
                                </button>
                            </form>
                        </div>

                        <div class="mx-1">
                            <form action="{{ route('school-majors.destroy.history', $school_major->id) }}"
                                method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-permanent-button">
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

@push('js')
@include('school_majors.history.script')
@endpush