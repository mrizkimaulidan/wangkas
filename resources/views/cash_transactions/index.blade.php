@extends('layouts.mazer.app', ['title' => 'Kas', 'page_heading' => 'Data Kas'])

@section('content')
<section class="row">
    {{-- Start Statistics --}}
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon green">
                            <i class="iconly-boldPaper-Plus"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Lunas</h6>
                        <h6 class="font-extrabold mb-0">
                            {{ $has_paid_count }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon red">
                            <i class="iconly-boldPaper-Fail"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Belum Lunas</h6>
                        <h6 class="font-extrabold mb-0">
                            {{ $has_not_paid_count }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon">
                            <i class="iconly-boldChart"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Total Bulan Ini</h6>
                        <h6 class="font-extrabold mb-0">
                            {{ $total_this_month }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon">
                            <i class="iconly-boldChart"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Total Tahun Ini</h6>
                        <h6 class="font-extrabold mb-0">
                            {{ $total_this_year }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon green">
                            <i class="iconly-boldActivity"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Sudah Membayar Minggu Ini</h6>
                        <h6 class="font-extrabold mb-0">
                            {{ $count_student_who_paid_this_week }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body px-3 py-4-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="stats-icon red">
                            <i class="iconly-boldActivity"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6 class="text-muted font-semibold">Belum Membayar Minggu Ini</h6>
                        <h6 class="font-extrabold mb-0">
                            {{ $count_student_who_not_paid_this_week }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Belum Membayar Minggu Ini </h4>
            </div>
            <div class="px-4">
                <button type="button" class='btn btn-block btn-xl btn-light-danger font-bold mt-3'
                    data-bs-toggle="modal" data-bs-target="#lookMoreModal">Ada
                    <b>{{ $count_student_who_not_paid_this_week }}</b> orang belum membayar pada minggu
                    ini!</button>
            </div>
            <span class="badge w-100 rounded-pill bg-warning mb-3"></span>
            <div class="card-content pb-4">
                <div class="row">
                    @foreach($students_who_not_paid_this_week_by_limit as $student_who_not_paid_this_week_by_limit)
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="name ms-4">
                                <h5 class="mb-1">{{ $student_who_not_paid_this_week_by_limit->name }}</h5>
                                <h6 class="text-muted mb-0">
                                    {{ $student_who_not_paid_this_week_by_limit->student_identification_number }}</h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="px-4">
                    <button type="button" class='btn btn-block btn-xl btn-light-primary font-bold mt-3'
                        data-bs-toggle="modal" data-bs-target="#lookMoreModal">Lihat
                        Selengkapnya</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End of Statistics --}}

    @include('utilities.alert-flash-message')
    <div class="col-md-12 card px-3 py-3 table-responsive">
        <div class="col-md-12 py-2">
            <a href="{{ route('kas.export') }}" class="btn btn-success btn-sm mb-3">
                <i class="bi bi-file-earmark-excel-fill"></i>
                Export Excel
            </a>
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                data-bs-target="#addCashTransactionModal">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </button>
        </div>

        <table class="table table-sm" id="datatable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Pelajar</th>
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
                            class="badge w-100 rounded-pill mb-2 {{ $cash_transaction->is_paid === 1 ? 'bg-success' : 'bg-danger' }}"
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            title="{{ paid_status($cash_transaction->is_paid) }}">{{ paid_status($cash_transaction->is_paid) }}</span>
                    </td>
                    <td>
                        <div class=" btn-group" role="group">
                            <div class="mx-1">
                                <button type="button" data-id="{{ $cash_transaction->id }}"
                                    class="btn btn-primary btn-sm cash-transaction-detail" data-bs-toggle="modal"
                                    data-bs-target="#showCashTransactionModal">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>

                            <div class="mx-1">
                                <button type="button" data-id="{{ $cash_transaction->id }}"
                                    class="btn btn-success btn-sm cash-transaction-edit" data-bs-toggle="modal"
                                    data-bs-target="#editCashTransactionModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </div>

                            <div class="mx-1">
                                <form action="{{ route('kas.destroy', $cash_transaction->id) }}" method="POST">
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
@include('cash_transactions.modal.create')
@include('cash_transactions.modal.show')
@include('cash_transactions.modal.edit')
@include('cash_transactions.modal.look-more')
@endpush

@push('js')
@include('cash_transactions.script')
@endpush