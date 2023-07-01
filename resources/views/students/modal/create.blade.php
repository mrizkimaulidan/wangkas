<div class="modal fade text-left" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					Tambah Data Pelajar
				</h5>
				<button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
					<i data-feather="x"></i>
				</button>
			</div>
			<div class="modal-body">
				<form class="form form-vertical">
					<div class="form-body">
						<div class="row">
							<div class="col-4">
								<div class="form-group has-icon-left">
									<label for="student_identification_number">NIS/NISN/NIM:</label>
									<div class="position-relative">
										<input type="number" class="form-control" id="student_identification_number"
											placeholder="Masukkan nis/nisn/nim..." />
										<div class="form-control-icon">
											<div class="bi bi-person-badge-fill"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-4">
								<div class="form-group has-icon-left">
									<label for="name">Nama Lengkap:</label>
									<div class="position-relative">
										<input type="text" class="form-control" id="name" placeholder="Masukkan nama lengkap..." />
										<div class="form-control-icon">
											<i class="bi bi-person-fill"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="col-4">
								<fieldset class="form-group">
									<label for="gender">Jenis Kelamin:</label>
									<select class="form-select" id="gender">
										<option>Pilih Jenis Kelamin</option>
										<option value="1">Laki-laki</option>
										<option value="2">Perempuan</option>
									</select>
								</fieldset>
							</div>
						</div>

						<div class="row">
							<div class="col-6">
								<fieldset class="form-group">
									<label for="school_class_id">Kelas:</label>
									<select class="form-select" id="school_class_id">
										<option>Pilih Kelas</option>
										@foreach ($schoolClasses as $schoolClass)
										<option value="{{ $schoolClass->id }}">{{ $schoolClass->name }}</option>
										@endforeach
									</select>
								</fieldset>
							</div>
							<div class="col-6">
								<fieldset class="form-group">
									<label for="school_major_id">Jurusan:</label>
									<select class="form-select" id="school_major_id">
										<option>Pilih Jurusan</option>
										@foreach ($schoolMajors as $schoolMajor)
										<option value="{{ $schoolMajor->id }}">{{ $schoolMajor->name }}</option>
										@endforeach
									</select>
								</fieldset>
							</div>
						</div>

						<div class="row">
							<div class="col-6">
								<div class="form-group has-icon-left">
									<label for="email">Alamat Email:</label>
									<div class="position-relative">
										<input type="email" class="form-control" id="email" placeholder="Masukkan alamat email..." />
										<div class="form-control-icon">
											<i class="bi bi-envelope-fill"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group has-icon-left">
									<label for="phone_number">Nomor Handphone:</label>
									<div class="position-relative">
										<input type="number" class="form-control" id="phone_number"
											placeholder="Masukkan nomor handphone..." />
										<div class="form-control-icon">
											<i class="bi bi-telephone-fill"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<label for="school_year_start">Tahun Ajaran Awal:</label>
									<div class="input-group">
										<input type="number" class="form-control" name="school_year_start"
											placeholder="Masukkan tahun ajaran awal..." value="2020">
										<span class="input-group-text">-</span>
										<input type="number" class="form-control " name="school_year_end"
											placeholder="Masukkan tahun ajaran akhir..." value="2023">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
							<i class="bx bx-x d-block d-sm-none"></i>
							<span class="d-none d-sm-block">Tutup</span>
						</button>
						<button type="submit" class="btn btn-success" data-bs-dismiss="modal">
							<i class="bx bx-x d-block d-sm-none"></i>
							<span class="d-none d-sm-block">Tambah</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
