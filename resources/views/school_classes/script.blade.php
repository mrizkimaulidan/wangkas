<script>
	$(function () {
		let ajaxRequest;

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
			let url = "{{ route('api.v1.datatables.school-classes.show', ':paramID') }}";
			url = url.replace(':paramID', id)

			ajaxRequest = $.ajax({
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

		$('.modal').on('hidden.bs.modal', function () {
			$(this).find('form :input').val('')
		});
	});
</script>
