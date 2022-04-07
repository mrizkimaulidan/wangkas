<div class="modal fade" id="showStudentModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
	aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Pelajar</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				@include('utilities.loading-alert')
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-4">
						<div class="mb-3">
							<label for="student_identification_number" class="form-label">NIS/NISN/NIM</label>
							<input type="text" class="form-control" id="student_identification_number" disabled>
						</div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-4">
						<div class="mb-3">
							<label for="name" class="form-label">Nama Lengkap</label>
							<input type="text" class="form-control" id="name" disabled>
						</div>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-4">
						<div class="mb-3">
							<label for="gender" class="form-label">Jenis Kelamin</label>
							<input type="text" class="form-control" id="gender" disabled>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="mb-3">
							<label for="school_class_id" class="form-label">Kelas</label>
							<input type="text" class="form-control" id="school_class_id" disabled>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="mb-3">
							<label for="school_major_id" class="form-label">Jurusan</label>
							<input type="text" class="form-control" id="school_major_id" disabled>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="text" class="form-control" id="email" disabled>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="mb-3">
							<label for="phone_number" class="form-label">Nomor Handphone</label>
							<input type="text" class="form-control" id="phone_number" disabled>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12 col-md-12">
						<label for="school_year_start" class="form-label">Tahun Ajaran</label>
						<div class="input-group mb-3">
							<input type="text" class="form-control" id="school_year_start" disabled>
							<span class="input-group-text">-</span>
							<input type="text" class="form-control" id="school_year_end" disabled>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
</div>
