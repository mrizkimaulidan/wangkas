<div class="modal fade" id="addStudentModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Data Pelajar</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('students.store') }}" method="POST">
					@csrf
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-4">
							<div class="mb-3">
								<label for="name" class="form-label">NIS/NISN/NIM</label>
								<input type="number" class="form-control @error('student_identification_number') is-invalid @enderror"
									name="student_identification_number" id="student_identification_number"
									value="{{ old('student_identification_number') }}" placeholder="Masukkan nis/nisn..">

								@error('student_identification_number')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>

						<div class="col-sm-12 col-md-12 col-lg-4">
							<div class="mb-3">
								<label for="name" class="form-label">Nama Lengkap</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
									value="{{ old('name') }}" placeholder="Masukkan nama lengkap..">

								@error('name')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>

						<div class="col-sm-12 col-md-12 col-lg-4">
							<label for="gender" class="form-label">Jenis Kelamin</label>
							<select class="form-select @error('gender') is-invalid @enderror" name="gender" id="gender">
								<option selected>Pilih Jenis Kelamin</option>
								<option value="1" {{ old('gender')==='1' ? 'selected' : '' }}>Laki-laki</option>
								<option value="2" {{ old('gender')==='2' ? 'selected' : '' }}>Perempuan</option>
							</select>

							@error('gender')
							<div class="d-block invalid-feedback">
								{{ $message }}
							</div>
							@enderror
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6 col-md-6">
							<div class="mb-3">
								<label for="school_class_id" class="form-label">Kelas</label>
								<select class="form-select select2" name="school_class_id" id="school_class_id">
									<option value="" selected>Pilih Kelas</option>
									@foreach($schoolClasses as $schoolClass)
									<option value="{{ $schoolClass->id }}" {{ old('school_class_id')==="$schoolClass->id" ? 'selected'
										: '' }}>
										{{ $schoolClass->name }}
									</option>
									@endforeach
								</select>

								@error('school_class_id')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>

						<div class="col-sm-6 col-md-6">
							<div class="mb-3">
								<label for="school_major_id" class="form-label">Jurusan</label>
								<select class="form-select select2" name="school_major_id" id="school_major_id">
									<option value="" selected>Pilih Jurusan</option>
									@foreach ($schoolMajors as $schoolMajor)
									<option value="{{ $schoolMajor->id }}" {{ old('school_major_id')==="$schoolMajor->id" ? 'selected'
										: '' }}>
										{{ $schoolMajor->abbreviated_word }} -
										{{ $schoolMajor->name }}
									</option>
									@endforeach
								</select>

								@error('school_major_id')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6 col-md-6">
							<div class="mb-3">
								<label for="email" class="form-label">Alamat Email</label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
									value="{{ old('email') }}" placeholder="Masukkan alamat email..">

								@error('email')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>

						<div class="col-sm-6 col-md-6">
							<div class="mb-3">
								<label for="phone_number" class="form-label">Nomor Handphone</label>
								<input type="number" class="form-control @error('phone_number') is-invalid @enderror"
									name="phone_number" id="phone_number" value="{{ old('phone_number') }}"
									placeholder="Masukkan nomor handphone..">

								@error('phone_number')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12 col-md-12">
							<label for="school_year_start">Tahun Ajaran</label>
							<div class="input-group mb-3">
								<input type="number" class="form-control @error('school_year_start') is-invalid @enderror"
									name="school_year_start" placeholder="Masukkan awal tahun ajaran.." value="{{ date('Y') - 3 }}">
								<span class="input-group-text">-</span>
								<input type="number" class="form-control @error('school_year_end') is-invalid @enderror"
									name="school_year_end" placeholder="Masukkan akhir tahun ajaran.." value="{{ date('Y') }}">
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
