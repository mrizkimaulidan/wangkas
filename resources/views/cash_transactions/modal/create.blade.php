<div class="modal fade" id="addCashTransactionModal" data-bs-backdrop="static" data-bs-keyboard="false"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Data Kas</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('cash-transactions.store') }}" method="POST" id="addCashTransactionForm">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="mb-3">
								<label for="name" class="form-label">Nama Pelajar</label>
								<select class="form-select select2 @error('student_id') is-invalid @enderror" name="student_id[]"
									multiple>
									@foreach ($students as $student)
									<option value="{{ $student->id }}" {{ collect(old('student_id'))->
										contains($student->id) ? 'selected' : '' }}>
										{{ $student->student_identification_number }} - {{ $student->name }}
									</option>
									@endforeach
								</select>

								@error('student_id')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="mb-3">
								<label for="bill" class="form-label">Tagihan</label>
								<input type="number" class="form-control @error('bill') is-invalid @enderror" name="bill"
									value="{{ old('bill') }}" id="bill" placeholder="Masukkan tagihan..">

								@error('bill')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>

						<div class="col-md-6">
							<div class="mb-3">
								<label for="amount" class="form-label">Total Bayar</label>
								<input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount"
									id="amount" value="{{ old('amount') }}" placeholder="Masukkan total bayar..">

								@error('amount')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="mb-3">
								<label for="date" class="form-label">Tanggal</label>
								<input type="date" class="form-control @error('date') is-invalid @enderror" name="date" id="date"
									placeholder="Pilih tanggal..">

								@error('date')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>

					<div class="row">
						<div class="mb-3">
							<label for="note" class="form-label">Catatan</label>
							<textarea class="form-control @error('note') is-invalid @enderror" name="note" id="note" rows="3"
								placeholder="Masukkan catatan (opsional)..">{{ old('note') }}</textarea>

							@error('note')
							<div class="d-block invalid-feedback">
								{{ $message }}
							</div>
							@enderror
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
