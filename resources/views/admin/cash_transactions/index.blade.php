@extends('layouts.mazer.app', ['title' => 'Kas', 'page_heading' => 'Data Kas'])

@section('content')
<section class="row">
    {{-- Start Statistics --}}
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon purple">
                            <i class="iconly-boldProfile"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Siswa</h6>
                        <h6 class="font-extrabold mb-0">
                            1</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon blue">
                            <i class="iconly-boldBookmark"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Kelas</h6>
                        <h6 class="font-extrabold mb-0">
                            1</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon green">
                            <i class="iconly-boldWork"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Jurusan</h6>
                        <h6 class="font-extrabold mb-0">
                            1</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon red">
                            <i class="iconly-boldTicket"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Kas Bulan Ini</h6>
                        <h6 class="font-extrabold mb-0">112</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon purple">
                            <i class="iconly-boldProfile"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Siswa</h6>
                        <h6 class="font-extrabold mb-0">
                            1</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon blue">
                            <i class="iconly-boldBookmark"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Kelas</h6>
                        <h6 class="font-extrabold mb-0">
                            1</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon green">
                            <i class="iconly-boldWork"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Jurusan</h6>
                        <h6 class="font-extrabold mb-0">
                            1</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon red">
                            <i class="iconly-boldTicket"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Kas Bulan Ini</h6>
                        <h6 class="font-extrabold mb-0">112</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End of Statistics --}}

    @include('utilities.alert-flash-message')
    <div class="col-md-12 card px-3 py-3 table-responsive">
        <div class="col-md-12 py-2">
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                data-bs-target="#addCashTransactionModal">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </button>
        </div>

        <table class="table table-sm" id="datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Siswa</th>
                    <th scope="col">Tagihan</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cash_transactions as $cash_transaction)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $cash_transaction->students->name }}</td>
                    <td>{{ indonesian_currency($cash_transaction->bill) }}</td>
                    <td>{{ indonesian_currency($cash_transaction->amount) }}</td>
                    <td>{{ date('d-m-Y', strtotime($cash_transaction->date)) }}</td>
                    <td>
                        <span
                            class="badge rounded-pill shadow mb-2 {{ $cash_transaction->is_paid === 1 ? 'bg-success' : 'bg-danger' }}"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            title="{{ paid_status($cash_transaction->is_paid) }}">{{ paid_status($cash_transaction->is_paid) }}</span>
                    </td>
                    <td>
                        <div class=" btn-group" role="group">
                            <div class="mx-1">
                                <button type="button" data-id="#" class="btn btn-primary btn-sm school-class-detail"
                                    data-bs-toggle="modal" data-bs-target="#showSchoolClassModal">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>

                            <div class="mx-1">
                                <button type="button" data-id="#" class="btn btn-success btn-sm school-class-edit"
                                    data-bs-toggle="modal" data-bs-target="#editSchoolClassModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </div>

                            <div class="mx-1">
                                <form action="#" method="POST">
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
@include('admin.cash_transactions.modal.create')
@endpush

@push('js')
{{--  --}}
@endpush