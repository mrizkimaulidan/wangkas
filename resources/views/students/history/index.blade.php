@extends('layouts.mazer.app', ['title' => 'Pelajar', 'page_heading' => 'Histori Daftar Pelajar Yang Telah Dihapus'])

@section('content')
<section class="row">
    @include('utilities.alert-flash-message')
    <div class="col-md-12 card px-3 py-3 table-responsive">
        <div class="col-md-12 py-2">
            <a href="{{ route('pelajar.index') }}" class="btn btn-primary float-end mx-2">
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
                @foreach ($students as $student)
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
                                <form action="{{ route('pelajar.restore.history', $student->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm restore-button">
                                        <i class="bi bi-arrow-bar-left"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="mx-1">
                                <form action="{{ route('pelajar.destroy.history', $student->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-permanent-button">
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