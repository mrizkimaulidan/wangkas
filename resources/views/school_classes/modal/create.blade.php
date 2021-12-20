<div class="modal fade" id="addSchoolClassModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Data Kelas</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('school-classes.store') }}" method="POST">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="mb-3">
								<label for="name" class="form-label">Nama Kelas</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan nama kelas..">

								@error('name')
								<div class="invalid-feedback d-block">
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