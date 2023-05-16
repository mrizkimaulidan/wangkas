<script>
	$(function () {
		let loadingAlert = $('.modal-body #loading-alert');

		$('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('school-majors.index') }}",
			columns: [
				{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
				{ data: 'name', name: 'name' },
				{ data: 'abbreviated_word', name: 'abbreviated_word' },
				{ data: 'action', name: 'action' },
			]
		});

		$('#datatable').on('click', '.school-major-detail', function () {
			loadingAlert.show();

			let id = $(this).data('id');
			let url = "{{ route('api.school-major.show', ':param') }}";
			url = url.replace(':param', id);

			$('#showSchoolMajorModal :input').val('Sedang mengambil data..');

			$.ajax({
				url: url,
				headers: {
					'Authorization': 'Bearer ' + localStorage.getItem('token'),
					'Accept': 'application/json',
				},
				success: function (response) {
					loadingAlert.slideUp();

					$('#showSchoolMajorModal #name').val(response.data.name);
					$('#showSchoolMajorModal #abbreviated_word').val(response.data.abbreviated_word);
				}
			});
		});

		$('#datatable').on('click', '.school-major-edit', function () {
			loadingAlert.show();

			let id = $(this).data('id');
			let url = "{{ route('api.school-major.edit', ':param') }}";
			url = url.replace(':param', id);

			let formActionURL = "{{ route('school-majors.update', ':param') }}";
			formActionURL = formActionURL.replace(':param', id);

			let editSchoolMajorModalEveryInput = $('#editSchoolMajorModal :input').not('button[type=button], input[name=_token], input[name=_method]')
				.each(function () {
					$(this).not('select').val('Sedang mengambil data..');
					$(this).prop('disabled', true);
				});

			$.ajax({
				url: url,
				headers: {
					'Authorization': 'Bearer ' + localStorage.getItem('token'),
					'Accept': 'application/json',
				},
				success: function (response) {
					loadingAlert.slideUp();

					$('#editSchoolMajorModal #school-major-edit-form').attr('action', formActionURL);

					editSchoolMajorModalEveryInput.prop('disabled', false);

					$('#editSchoolMajorModal #name').val(response.data.name);
					$('#editSchoolMajorModal #abbreviated_word').val(response.data.abbreviated_word);
				}
			});
		});
	});
</script>
