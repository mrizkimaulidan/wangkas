@extends('layouts.main', ['title' => 'Laporan', 'page_heading' => 'Data Laporan'])

@section('content')
<section>
    <div class="row">
        <div class="col-6 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body px-3 py-4-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stats-icon">
                                <i class="iconly-boldChart"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Total Hari Ini</h6>
                            <h6 class="font-extrabold mb-0">
                                {{ indonesian_currency($sum_this_day) }}
                            </h6>
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
                            <div class="stats-icon">
                                <i class="iconly-boldChart"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Total Minggu Ini</h6>
                            <h6 class="font-extrabold mb-0">
                                {{ indonesian_currency($sum_this_week) }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6 col-lg-6 col-md-6">
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
                                {{ indonesian_currency($sum_this_month) }}
                            </h6>
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
                            <div class="stats-icon">
                                <i class="iconly-boldChart"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6 class="text-muted font-semibold">Total Tahun Ini</h6>
                            <h6 class="font-extrabold mb-0">
                                {{ indonesian_currency($sum_this_year) }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card px-3 py-3">
            <form action="{{ route('report.filter') }}" method="GET">
                <label for="start_date" class="pb-3">Filter Data dengan Rentang Tanggal</label>
                <div class="input-group">
                    <input type="date" name="start_date" class="form-control" placeholder="Pilih tanggal awal..">
                    <input type="date" name="end_date" class="form-control" placeholder="Pilih tanggal akhir..">
                    <button type="submit" class="btn btn-primary mx-3">Filter</button>
                </div>
            </form>
        </div>
    </div>

    @isset($reports_data)
    <div class="row">
        <div class="card px-3 py-3">
            <div class="col-lg-12">
                <a href="{{ route('report.export', [request()->get('start_date'), request()->get('end_date')]) }}"
                    class="btn btn-success float-end">
                    <i class="bi bi-file-earmark-excel-fill"></i>
                    Export Excel
                </a>
            </div>

            <div class="table-responsive mt-3">
                <table class="table table-sm text-center caption-top" id="datatable">
                    <caption>Laporan data dari tanggal <span
                            class="fw-bold">{{ date('d-m-Y', strtotime(request()->get('start_date'))) }}</span> -
                        <span class="fw-bold">{{ date('d-m-Y', strtotime(request()->get('end_date'))) }}</span>
                    </caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Pelajar</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                            <th scope="col">Nominal Bayar</th>
                            <th scope="col">Pencatat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports_data as $report_data)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $report_data->students->name }}</td>
                            <td>{{ date('d-m-Y', strtotime($report_data->date)) }}</td>
                            <td>{{ paid_status($report_data->is_paid) }}</td>
                            <td>{{ indonesian_currency($report_data->amount) }}</td>
                            <td>{{ $report_data->users->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" align="right"><b>Total Lunas</b></td>
                            <td>{{ indonesian_currency($total_amount_is_paid) }}</td>
                        </tr>
                        <tr>
                            <td colspan="5" align="right"><b>Total Belum Lunas</b></td>
                            <td>{{ indonesian_currency($total_amount_is_not_paid) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @endisset
</section>
@endsection

@push('js')
@include('reports.script')
@endpush