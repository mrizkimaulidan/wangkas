<div class="modal fade text-left" id="showModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
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
						<div class="form-group has-icon-left">
							<label for="student_id">Pelajar:</label>
							<div class="position-relative">
								<input type="text" class="form-control" id="student_id" disabled />
								<div class="form-control-icon">
									<div class="bi bi-person-fill"></div>
								</div>
							</div>
						</div>
						<div class="form-group has-icon-left">
							<label for="created_by">Dicatat oleh:</label>
							<div class="position-relative">
								<input type="text" class="form-control" id="created_by" disabled />
								<div class="form-control-icon">
									<div class="bi bi-person-badge-fill"></div>
								</div>
							</div>
						</div>
						<div class="form-group has-icon-left">
							<label for="amount">Tagihan:</label>
							<div class="position-relative">
								<input type="text" class="form-control" id="amount" disabled />
								<div class="form-control-icon">
									<div class="bi bi-cash"></div>
								</div>
							</div>
						</div>
						<div class="form-group has-icon-left">
							<label for="date_paid">Tanggal:</label>
							<div class="position-relative">
								<input type="date" class="form-control" id="date_paid" disabled />
								<div class="form-control-icon">
									<div class="bi bi-calendar-fill"></div>
								</div>
							</div>
						</div>
						<div class="form-group has-icon-left">
							<label for="transaction_note">Catatan:</label>
							<div class="position-relative">
								<textarea class="form-control" id="transaction_note" disabled rows="3"></textarea>
								<div class="form-control-icon">
									<div class="bi bi-card-text"></div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
</div>
