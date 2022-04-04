<script>
	$(function () {
		let loadingAlert = $('.modal-body #loading-alert');

		$('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('administrators.index') }}",
			columns: [
				{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
				{ data: 'name', name: 'name' },
				{ data: 'email', name: 'email' },
				{ data: 'created_at', name: 'created_at' },
				{ data: 'action', name: 'action' },
			]
		});

		$('#datatable').on('click', '.administrator-detail', function () {
			loadingAlert.show();

			let id = $(this).data('id');
			let url = "{{ route('api.administrator.show', ':id') }}";
			url = url.replace(':id', id);

			$('#showAdministratorModal input').val('Sedang mengambil data..');

			$.ajax({
				url: url,
				headers: {
					'Accept': 'application/json',
					'Content-Type': 'application/json'
				},
				success: function (response) {
					loadingAlert.slideUp();

					$('#showAdministratorModal #name').val(response.data.name);
					$('#showAdministratorModal #email').val(response.data.email);
				}
			});
		});

		$('#datatable').on('click', '.administrator-edit', function () {
			loadingAlert.show();

			let id = $(this).data('id');
			let url = "{{ route('api.administrator.edit', 'id') }}";
			url = url.replace('id', id);

			let formActionURL = "{{ route('administrators.update', 'id') }}";
			formActionURL = formActionURL.replace('id', id);

			let editSchoolClassModalEveryInput = $('#editAdministratorModal :input').not('button[type=button], input[name=_token], input[name=_method]')
				.each(function () {
					$(this).not('input[id=password], input[id=password_confirmation]').val('Sedang mengambil data..');
					$(this).prop('disabled', true);
				});

			$.ajax({
				url: url,
				headers: {
					'Accept': 'application/json',
					'Content-Type': 'application/json'
				},
				success: function (response) {
					loadingAlert.slideUp();

					$('#editAdministratorModal #administrator-edit-form').attr('action', formActionURL);

					editSchoolClassModalEveryInput.prop('disabled', false);

					$('#editAdministratorModal #name').val(response.data.name);
					$('#editAdministratorModal #email').val(response.data.email);
				}
			});
		});
	});
</script>
