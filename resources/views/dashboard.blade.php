@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-heading')
<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Dashboard</h3>
				<p class="text-subtitle text-muted">Dashboard.</p>
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">Dashboard</a>
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content')
<section class="row">
	<div class="col-12 col-lg-9">
		<div class="row">
			<div class="col-6 col-lg-3 col-md-6">
				<div class="card">
					<div class="card-body px-4 py-4-5">
						<div class="row">
							<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
								<div class="stats-icon purple mb-2">
									<i class="iconly-boldProfile"></i>
								</div>
							</div>
							<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
								<h6 class="text-muted font-semibold">
									Pelajar
								</h6>
								<h6 class="font-extrabold mb-0">{{ $charts['counter']['student'] }}</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3 col-md-6">
				<div class="card">
					<div class="card-body px-4 py-4-5">
						<div class="row">
							<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
								<div class="stats-icon blue mb-2">
									<i class="iconly-boldBookmark"></i>
								</div>
							</div>
							<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
								<h6 class="text-muted font-semibold">Kelas</h6>
								<h6 class="font-extrabold mb-0">{{ $charts['counter']['schoolClass'] }}</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3 col-md-6">
				<div class="card">
					<div class="card-body px-4 py-4-5">
						<div class="row">
							<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
								<div class="stats-icon green mb-2">
									<i class="iconly-boldBag"></i>
								</div>
							</div>
							<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
								<h6 class="text-muted font-semibold">Jurusan</h6>
								<h6 class="font-extrabold mb-0">{{ $charts['counter']['schoolMajor'] }}</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6 col-lg-3 col-md-6">
				<div class="card">
					<div class="card-body px-4 py-4-5">
						<div class="row">
							<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
								<div class="stats-icon red mb-2">
									<i class="iconly-boldProfile"></i>
								</div>
							</div>
							<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
								<h6 class="text-muted font-semibold">Administrator</h6>
								<h6 class="font-extrabold mb-0">{{ $charts['counter']['administrator'] }}</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4 id="card-chart-cash-transactions-title">Total Transaksi Tahun Ini</h4>
						<div class="mb-3">
							<label for="year" class="form-label">Isi Tahun:</label>
							<input type="number" id="year" placeholder="Masukan tahun.." value="{{ date('Y') }}" class="form-control">
							<div class="form-text">Tekan tombol `Enter` untuk menampilkan grafik berdasarkan tahun yang dipilih.</div>
						</div>
					</div>
					<div class="card-body">
						<div id="chart-cash-transactions-by-year"></div>
					</div>
					<div class="card-body">
						<div id="chart-cash-transactions-amount-by-year"></div>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="card">
					<x-apexcharts.line-chart chartTitle="Total Transaksi Per Tahun" seriesTitle="Total Transaksi"
						chartID="chart-cash-transactions-count-per-year"
						:series="$charts['lineChart']['cashTransactionCountPerYear']['series']"
						:categories="$charts['lineChart']['cashTransactionCountPerYear']['categories']" />
				</div>
			</div>

			<div class="col-12">
				<div class="card">
					<x-apexcharts.line-chart chartTitle="Total Jumlah Pembayaran Transaksi Per Tahun"
						seriesTitle="Total Pembayaran" chartID="chart-cash-transactions-amount-per-year"
						:series="$charts['lineChart']['cashTransactionAmountPerYear']['series']"
						:categories="$charts['lineChart']['cashTransactionAmountPerYear']['categories']" />
				</div>
			</div>
		</div>
		<div class="row">
			{{-- <div class="col-12 col-xl-4">
				<div class="card">
					<div class="card-header">
						<h4>Profile Visit</h4>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-7">
								<div class="d-flex align-items-center">
									<svg class="bi text-primary" width="32" height="32" fill="blue" style="width:10px">
										<use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
									</svg>
									<h5 class="mb-0 ms-3">Europe</h5>
								</div>
							</div>
							<div class="col-5">
								<h5 class="mb-0 text-end">862</h5>
							</div>
							<div class="col-12">
								<div id="chart-europe"></div>
							</div>
						</div>
						<div class="row">
							<div class="col-7">
								<div class="d-flex align-items-center">
									<svg class="bi text-success" width="32" height="32" fill="blue" style="width:10px">
										<use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
									</svg>
									<h5 class="mb-0 ms-3">America</h5>
								</div>
							</div>
							<div class="col-5">
								<h5 class="mb-0 text-end">375</h5>
							</div>
							<div class="col-12">
								<div id="chart-america"></div>
							</div>
						</div>
						<div class="row">
							<div class="col-7">
								<div class="d-flex align-items-center">
									<svg class="bi text-success" width="32" height="32" fill="blue" style="width:10px">
										<use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
									</svg>
									<h5 class="mb-0 ms-3">India</h5>
								</div>
							</div>
							<div class="col-5">
								<h5 class="mb-0 text-end">625</h5>
							</div>
							<div class="col-12">
								<div id="chart-india"></div>
							</div>
						</div>
						<div class="row">
							<div class="col-7">
								<div class="d-flex align-items-center">
									<svg class="bi text-danger" width="32" height="32" fill="blue" style="width:10px">
										<use xlink:href="assets/static/images/bootstrap-icons.svg#circle-fill" />
									</svg>
									<h5 class="mb-0 ms-3">Indonesia</h5>
								</div>
							</div>
							<div class="col-5">
								<h5 class="mb-0 text-end">1025</h5>
							</div>
							<div class="col-12">
								<div id="chart-indonesia"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-xl-8">
				<div class="card">
					<div class="card-header">
						<h4>Latest Comments</h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-hover table-lg">
								<thead>
									<tr>
										<th>Name</th>
										<th>Comment</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="col-3">
											<div class="d-flex align-items-center">
												<div class="avatar avatar-md">
													<img src="./assets/compiled/jpg/5.jpg">
												</div>
												<p class="font-bold ms-3 mb-0">Si Cantik</p>
											</div>
										</td>
										<td class="col-auto">
											<p class=" mb-0">Congratulations on your graduation!</p>
										</td>
									</tr>
									<tr>
										<td class="col-3">
											<div class="d-flex align-items-center">
												<div class="avatar avatar-md">
													<img src="./assets/compiled/jpg/2.jpg">
												</div>
												<p class="font-bold ms-3 mb-0">Si Ganteng</p>
											</div>
										</td>
										<td class="col-auto">
											<p class=" mb-0">Wow amazing design! Can you make another tutorial for
												this design?</p>
										</td>
									</tr>
									<tr>
										<td class="col-3">
											<div class="d-flex align-items-center">
												<div class="avatar avatar-md">
													<img src="./assets/compiled/jpg/8.jpg">
												</div>
												<p class="font-bold ms-3 mb-0">Singh Eknoor</p>
											</div>
										</td>
										<td class="col-auto">
											<p class=" mb-0">What a stunning design! You are so talented and creative!</p>
										</td>
									</tr>
									<tr>
										<td class="col-3">
											<div class="d-flex align-items-center">
												<div class="avatar avatar-md">
													<img src="./assets/compiled/jpg/3.jpg">
												</div>
												<p class="font-bold ms-3 mb-0">Rani Jhadav</p>
											</div>
										</td>
										<td class="col-auto">
											<p class=" mb-0">I love your design! It’s so beautiful and unique! How did you learn to do this?
											</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div> --}}
		</div>
	</div>
	<div class="col-12 col-lg-3">
		<div class="card">
			<div class="card-body py-4 px-4">
				<div class="d-flex align-items-center">
					<div class="avatar avatar-xl">
						<img src="{{ asset('compiled/jpg/1.jpg') }}" alt=" Face 1" />
					</div>
					<div class="ms-3 name">
						<h5 class="font-bold">{{ auth()->user()->name }}</h5>
						<h6 class="text-muted mb-0">{{ auth()->user()->email }}</h6>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<x-apexcharts.pie-chart chartTitle="Pelajar Berdasarkan Jenis Kelamin" chartID="chart-pie-student-gender"
				:series="$charts['pieChart']['studentGender']['series']"
				:labels="$charts['pieChart']['studentGender']['labels']" :colors="['#57CAEB', '#FF7976']" />
		</div>
		<div class="card">
			<x-apexcharts.pie-chart chartTitle="Pelajar Berdasarkan Jurusan" chartID="chart-pie-student-school-major"
				:series="$charts['pieChart']['studentMajor']['series']"
				:labels="$charts['pieChart']['studentMajor']['labels']" />
		</div>
		<div class="card">
			<x-apexcharts.pie-chart chartTitle="Total Transaksi Berdasarkan Jenis Kelamin"
				chartID="chart-pie-cash-transaction-by-gender"
				:series="$charts['pieChart']['cashTransactionCountByGender']['series']"
				:labels="$charts['pieChart']['cashTransactionCountByGender']['labels']" />
		</div>
	</div>
</section>
@endsection

@pushOnce('scripts')
<script src="{{ asset('extensions/apexcharts/apexcharts.min.js') }}"></script>
@include('script')
@endPushOnce
