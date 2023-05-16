<script>
	$(function () {
		let loadingAlert = $('.modal-body #loading-alert');

		$('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('school-classes.index') }}",
			columns: [
				{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
				{ data: 'name', name: 'name' },
				{ data: 'action', name: 'action' },
			]
		});

		$('#datatable').on('click', '.school-class-detail', function () {
			loadingAlert.show();

			let id = $(this).data('id');
			let url = "{{ route('api.school-class.show', ':param') }}";
			url = url.replace(':param', id);

			$('#showSchoolClassModal :input').val("Sedang mengambil data..");

			$.ajax({
				url: url,
				headers: {
					'Authorization': 'Bearer ' + localStorage.getItem('token'),
					'Accept': 'application/json',
					'Content-Type': 'application/json'
				},
				success: function (response) {
					loadingAlert.slideUp();

					$('#showSchoolClassModal #name').val(response.data.name);
				}
			});
		});

		$('#datatable').on('click', '.school-class-edit', function () {
			loadingAlert.show();

			let id = $(this).data('id');
			let url = "{{ route('api.school-class.edit', ':param') }}";
			url = url.replace(':param', id);

			let formActionURL = "{{ route('school-classes.update', ':param') }}";
			formActionURL = formActionURL.replace(':param', id)

			let editSchoolClassModalEveryInput = $('#editSchoolClassModal :input').not('button[type=button], input[name=_token], input[name=_method]')
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

					editSchoolClassModalEveryInput.prop('disabled', false);

					$('#editSchoolClassModal #edit-school-class-form').attr('action', formActionURL);
					$('#editSchoolClassModal #name').val(response.data.name);
				}
			});
		});
	});
</script>
