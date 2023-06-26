<script>
	$(function () {
		const table = $('#table').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('api.v1.datatables.school-classes.index') }}",
			columns: [
				{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
				{ data: 'name', name: 'name' },
				{ data: 'action', name: 'action' }
			]
		});

		$('#table').on('click', '.show-modal', function () {
			const id = $(this).data('id');
			let url = "{{ route('api.v1.datatables.school-classes.show', ':paramID') }}".replace(':paramID', id);

			$.ajax({
				url: url,
				method: 'GET',
				header: {
					'Content-Type': 'application/json'
				},
				success: res => {
					$('#showModal form #name').val(res.data.name);
				},
				error: err => {
					alert('error occured, check console');
					console.log(err);
				}
			});
		});

		$('#table').on('click', '.update-modal', function () {
			const id = $(this).data('id');
			let url = "{{ route('api.v1.datatables.school-classes.show', ':paramID') }}".replace(':paramID', id);
			let updateURL = "{{ route('api.v1.datatables.school-classes.update', ':paramID') }}".replace(':paramID', id);

			$.ajax({
				url: url,
				method: 'GET',
				header: {
					'Content-Type': 'application/json'
				},
				success: res => {
					$('#updateModal form #name').val(res.data.name);
					$('#updateModal form').attr('action', updateURL);
				},
				error: err => {
					alert('error occured, check console');
					console.log(err);
				}
			});
		});

		$('#updateModal form').submit(function (e) {
			e.preventDefault();

			const formData = {
				name: $('#updateModal form #name').val()
			};

			const updateURL = $('#updateModal form').attr('action');

			$.ajax({
				url: updateURL,
				method: 'PUT',
				header: {
					'Content-Type': 'application/json'
				},
				data: formData,
				success: res => {
					table.ajax.reload();
					$('#updateModal').modal('hide');

					Swal.fire({
						icon: 'success',
						title: 'Data kelas berhasil diubah!',
						toast: true,
						position: 'top-end',
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer)
							toast.addEventListener('mouseleave', Swal.resumeTimer)
						}
					});
				},
				error: err => {
					alert('error occured, check console');
					console.log(err);
				}
			});
		});

		$('.modal').on('hidden.bs.modal', function () {
			$(this).find('form :input').val('');
		});
	});
</script>
