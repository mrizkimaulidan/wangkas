@extends('layouts.mazer.app', ['title' => 'Laporan', 'page_heading' => 'Data Laporan'])

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
                                1</h6>
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
                                1</h6>
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
                                1</h6>
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
                                1</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card px-3 py-3">
            <form>
                <div class="input-group">
                    <input type="date" name="start_date" class="form-control">
                    <input type="date" name="end_date" class="form-control">
                    <button type="submit" class="btn btn-primary mx-3">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="card px-3 py-3">
            <div class="col-lg-12">
                <button type="button" class="btn btn-primary float-end">
                    <i class="bi bi-file-earmark-excel-fill"></i>
                    Export Excel
                </button>
            </div>

            <table class="table table-sm text-center caption-top">
                <caption>Laporan data dari tanggal 01-01-2021 - 31-01-2021</caption>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Pelajar</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status</th>
                        <th scope="col">Telah Membayar Bulan Ini</th>
                        <th scope="col">Nominal Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">#</th>
                        <td>Muhammad Rizki Maulidan</td>
                        <td>18-02-2021</td>
                        <td>Lunas</td>
                        <td>4x</td>
                        <td>Rp10,000.00</td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right"><b>Total</b></td>
                        <td>Rp10,000.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection