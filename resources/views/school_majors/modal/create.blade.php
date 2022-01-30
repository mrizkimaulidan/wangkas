<div class="modal fade" id="addSchoolMajorModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Data Jurusan</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('school-majors.store') }}" method="post">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="mb-3">
								<label for="name" class="form-label">Nama Jurusan</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
									value="{{ old('name') }}" placeholder="Masukkan nama jurusan..">

								@error('name')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
							<div class="mb-3">
								<label for="abbreviated_word" class="form-label">Singkatan Jurusan</label>
								<input type="text" class="form-control @error('abbreviated_word') is-invalid @enderror"
									name="abbreviated_word" id="abbreviated_word" value="{{ old('abbreviated_word') }}"
									placeholder="Masukkan singkatan jurusan..">

								@error('abbreviated_word')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
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
