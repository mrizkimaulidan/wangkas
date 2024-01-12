<div class="modal fade text-left" id="showModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					Lihat Data Kas
				</h5>
				<button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
					<i data-feather="x"></i>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6">
						<form class="form form-vertical">
							<div class="form-body">
								<div class="row">
									<div class="col-12 text-center">
										<div class="alert alert-primary"><i class="bi bi-person-vcard"></i> Detail Informasi Pelajar
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12 col-lg-12 col-xl-6">
										<div class="form-group has-icon-left">
											<label for="student_identification_number">NIS/NISN/NIM:</label>
											<div class="position-relative">
												<input type="text" class="form-control" id="student_identification_number" disabled />
												<div class="form-control-icon">
													<div class="bi bi-person-bounding-box"></div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-12 col-lg-12 col-xl-6">
										<div class="form-group has-icon-left">
											<label for="student_id">Pelajar:</label>
											<div class="position-relative">
												<input type="text" class="form-control" id="student_id" disabled />
												<div class="form-control-icon">
													<div class="bi bi-person-fill"></div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6 col-xl-6">
										<div class="form-group has-icon-left">
											<label for="school_class_id">Kelas:</label>
											<div class="position-relative">
												<input type="text" class="form-control" id="school_class_id" disabled />
												<div class="form-control-icon">
													<div class="bi bi-bookmark-fill"></div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-6 col-xl-6">
										<div class="form-group has-icon-left">
											<label for="school_major_id">Jurusan:</label>
											<div class="position-relative">
												<input type="text" class="form-control" id="school_major_id" disabled />
												<div class="form-control-icon">
													<div class="bi bi-briefcase-fill"></div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="form-group has-icon-left">
										<label for="phone_number">Nomor Handphone:</label>
										<div class="position-relative">
											<input type="text" class="form-control" id="phone_number" disabled />
											<div class="form-control-icon">
												<div class="bi bi-telephone-fill"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>

					<div class="col-lg-6">
						<form class="form form-vertical">
							<div class="form-body">
								<div class="row">
									<div class="col-md-12 text-center">
										<div class="alert alert-success"><i class="bi bi-card-text"></i> Detail Informasi Tagihan</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6 col-xl-6">
										<div class="form-group has-icon-left">
											<label for="amount">Tagihan:</label>
											<div class="position-relative">
												<input type="text" class="form-control" id="amount" disabled />
												<div class="form-control-icon">
													<div class="bi bi-cash"></div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-xl-6">
										<div class="form-group has-icon-left">
											<label for="date_paid">Tanggal:</label>
											<div class="position-relative">
												<input type="text" class="form-control" id="date_paid" disabled />
												<div class="form-control-icon">
													<div class="bi bi-calendar-fill"></div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="form-group has-icon-left">
										<label for="created_by">Dicatat Oleh:</label>
										<div class="position-relative">
											<input type="text" class="form-control" id="created_by" disabled />
											<div class="form-control-icon">
												<div class="bi bi-person-badge-fill"></div>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="form-group has-icon-left">
										<label for="transaction_note">Catatan:</label>
										<div class="position-relative">
											<textarea class="form-control" id="transaction_note" disabled="" rows="3"></textarea>
											<div class="form-control-icon">
												<div class="bi bi-card-text"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
</div>
