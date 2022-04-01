<div class="modal fade" id="editStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ubah Pelajar</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				@include('utilities.loading-alert')
				<form action="#" method="POST" id="edit-student-form">
					@csrf @method('PUT')
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-4">
							<div class="mb-3">
								<label for="student_identification_number" class="form-label">NIS/NISN/NIM</label>
								<input type="number" class="form-control" name="student_identification_number"
									id="student_identification_number" placeholder="Masukkan nis/nisn..">
							</div>
						</div>

						<div class="col-sm-12 col-md-12 col-lg-4">
							<div class="mb-3">
								<label for="name" class="form-label">Nama Lengkap</label>
								<input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama lengkap..">
							</div>
						</div>

						<div class="col-sm-12 col-md-12 col-lg-4">
							<div class="mb-3">
								<label for="gender" class="form-label">Jenis Kelamin</label>
								<select class="form-select" name="gender" id="gender">
									<option selected>Pilih jenis kelamin</option>
									<option value="1">Laki-laki</option>
									<option value="2">Perempuan</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6 col-md-6">
							<div class="mb-3">
								<label for="school_class_id" class="form-label">Kelas</label>
								<select class="form-select" name="school_class_id" id="school_class_id">
									<option selected>Pilih kelas</option>
									@foreach($schoolClasses as $schoolClass)
									<option value="{{ $schoolClass->id }}">{{ $schoolClass->name }}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="col-sm-6 col-md-6">
							<div class="mb-3">
								<label for="school_major_id" class="form-label">Jurusan</label>
								<select class="form-select" name="school_major_id" id="school_major_id">
									<option selected>Pilih jurusan</option>
									@foreach ($schoolMajors as $schoolMajor)
									<option value="{{ $schoolMajor->id }}">{{ $schoolMajor->abbreviated_word }} -
										{{ $schoolMajor->name }}
									</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6 col-md-6">
							<div class="mb-3">
								<label for="email" class="form-label">Email</label>
								<input type="text" class="form-control" name="email" id="email" placeholder="Masukkan email..">
							</div>
						</div>

						<div class="col-sm-6 col-md-6">
							<div class="mb-3">
								<label for="phone_number" class="form-label">Nomor Handphone</label>
								<input type="number" class="form-control" name="phone_number" id="phone_number"
									placeholder="Masukkan nomor handphone..">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12 col-md-12">
							<label for="school_year_start">Tahun Ajaran</label>
							<div class="input-group mb-3">
								<input type="text" class="form-control" name="school_year_start" id="school_year_start"
									placeholder="Masukkan awal tahun ajaran..">
								<span class="input-group-text">-</span>
								<input type="text" class="form-control" name="school_year_end" id="school_year_end"
									placeholder="Masukkan akhir tahun ajaran..">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-success">Ubah</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
