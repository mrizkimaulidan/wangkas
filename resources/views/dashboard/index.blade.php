@extends('layouts.main', ['title' => 'Dashboard', 'page_heading' => 'Dashboard'])

@section('content')
<section class="row">
    <div class="col-12 col-lg-12">
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <a href="{{ route('students.index') }}">
                    <div class="card card-stat">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pelajar</h6>
                                    <h6 class="font-extrabold {{ $student_count <= 0 ? 'text-danger' : '' }} mb-0">
                                        {{ $student_count }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <a href="{{ route('classes.index') }}">
                    <div class="card card-stat">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Kelas</h6>
                                    <h6 class="font-extrabold {{ $school_class_count <= 0 ? 'text-danger' : '' }} mb-0">
                                        {{ $school_class_count }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <a href="{{ route('majors.index') }}">
                    <div class="card card-stat">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldWork"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jurusan</h6>
                                    <h6 class="font-extrabold {{ $school_major_count <= 0 ? 'text-danger' : '' }} mb-0">
                                        {{ $school_major_count }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <a href="{{ route('cash-transactions.index') }}">
                    <div class="card card-stat">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldTicket"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Kas Bulan Ini</h6>
                                    <h6 class="font-extrabold mb-0">{{ $cash_transaction_this_month }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        @include('dashboard.charts.chart')
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>5 Transaksi Terakhir</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg">
                                <thead>
                                    <tr>
                                        <th>Nama Pelajar</th>
                                        <th>Total Bayar</th>
                                        <th>Tanggal</th>
                                        <th>Pencatat</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($latest_cash_transactions_by_limit as $latest_cash_transaction_by_limit)
                                    <tr>
                                        <td class="col-5">
                                            <div class="d-flex align-items-center">
                                                <p class="font-bold ms-3 mb-0">
                                                    {{ $latest_cash_transaction_by_limit->students->name }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0">
                                                {{ indonesian_currency($latest_cash_transaction_by_limit->amount) }}
                                            </p>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0">
                                                {{ date('d-m-Y', strtotime($latest_cash_transaction_by_limit->date)) }}
                                            </p>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0">
                                                {{ $latest_cash_transaction_by_limit->users->name }}
                                            </p>
                                        </td>
                                        <td class="col-auto">
                                            <p class="mb-0">
                                                <button type="button"
                                                    data-id="{{ $latest_cash_transaction_by_limit->id }}"
                                                    class="btn btn-primary btn-sm cash-transaction-detail"
                                                    data-bs-toggle="modal" data-bs-target="#showCashTransactionModal">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </p>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4">
                                            <p class="fw-bold text-danger text-center text-uppercase">Data kosong!</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('modal')
@include('dashboard.modal.show')
@endpush

@push('js')
@include('dashboard.script')
@endpush