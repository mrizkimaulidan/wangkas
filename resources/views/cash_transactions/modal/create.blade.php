<div class="modal fade text-left" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					Tambah Data Kas
				</h5>
				<button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
					<i data-feather="x"></i>
				</button>
			</div>
			<div class="modal-body">
				<form class="form form-vertical">
					<div class="form-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group has-icon-left">
									<label for="student_id">Pelajar:</label>
									<div class="input-group mb-3">
										<label class="input-group-text" for="student_id">
											<div><i class="bi bi-person-badge-fill"></i></div>
										</label>
										<select class="form-select form-select-sm" id="student_id" multiple>
											@foreach ($students as $student)
											<option value="{{ $student->id }}">{{ $student->student_identification_number }} - {{
												$student->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group has-icon-left">
									<label for="amount">Tagihan:</label>
									<div class="position-relative">
										<input type="number" class="form-control" id="amount" placeholder="Masukan tagihan..." />
										<div class="form-control-icon">
											<div class="bi bi-cash"></div>
										</div>
									</div>
								</div>

								<div class="form-group has-icon-left">
									<label for="date_paid">Tanggal:</label>
									<div class="position-relative">
										<input type="date" class="form-control" id="date_paid" placeholder="Pilih tanggal..." />
										<div class="form-control-icon">
											<div class="bi bi-calendar-fill"></div>
										</div>
									</div>
								</div>

								<div class="form-group has-icon-left">
									<label for="transaction_note">Catatan:</label>
									<div class="position-relative">
										<textarea class="form-control" id="transaction_note" placeholder="Masukan catatan (opsional)..."
											rows="3"></textarea>
										<div class="form-control-icon">
											<div class="bi bi-card-text"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-success">Tambah</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
