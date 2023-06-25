@extends('layouts.app')

@section('page-heading')
<div class="page-heading">
	<div class="page-title">
		<div class="row">
			<div class="col-12 col-md-6 order-md-1 order-last">
				<h3>Data Kelas</h3>
				<p class="text-subtitle text-muted">Halaman untuk manajemen data kelas seperti melihat, mengubah dan menghapus.
				</p>
			</div>
			<div class="col-12 col-md-6 order-md-2 order-first">
				<nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard') }}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							Data Kelas
						</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content')
<div class="row">
	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-xs table-hover" id="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($schoolClasses as $schoolClass)
							<tr>
								<td class="text-bold-500">{{ $loop->iteration }}</td>
								<td>{{ $schoolClass->name }}</td>
								<td class="text-bold-500">
									<div class="btn-group gap gap-2 mb-3" role="group">
										<button type="button" class="btn btn-primary btn-sm">
											<i class="bi bi-search"></i>
										</button>
										<button type="button" class="btn btn-success btn-sm">
											<i class="bi bi-pencil-square"></i>
										</button>
										<button type="button" class="btn btn-danger btn-sm">
											<i class="bi bi-trash-fill"></i>
										</button>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
