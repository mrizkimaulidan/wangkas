<!-- Modal -->
<div class="modal fade" id="lookMoreModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Pelajar Yang Belum Membayar Minggu Ini</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="card-content pb-4">
					<div class="row">
						<div class="col-lg-12">
							<span class="badge w-100 rounded-pill bg-warning mb-3">Ada
								{{ $data['studentCountWho']['notPaidThisWeek'] }} orang belum membayar pada minggu
								ini! <i class="bi bi-exclamation-triangle"></i></span>
						</div>
					</div>


					<div class="row">
						@foreach($data['students']['notPaidThisWeek'] as $studentNotPaidThisWeek)
						<div class="col-6 col-lg-6 col-md-6">
							<div class="recent-message d-flex px-4 py-3">
								<div class="name ms-4">
									<h5 class="mb-1">
										{{ $loop->iteration }}. {{ $studentNotPaidThisWeek->name }}</h5>
									<h6 class="text-muted mb-0">
										{{ $studentNotPaidThisWeek->student_identification_number }}
									</h6>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>