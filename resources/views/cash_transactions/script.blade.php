<script>
	$(function () {
		const table = $('#table').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('api.v1.datatables.cash-transactions.index') }}",
			columns: [
				{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
				{ data: 'student.name', name: 'student_id' },
				{ data: 'amount', name: 'amount' },
				{ data: 'date_paid', name: 'date_paid' },
				{ data: 'created_by.name', name: 'created_by' },
				{ data: 'action', name: 'action' }
			]
		});

		$('.modal').on('hidden.bs.modal', function () {
			$(this).find('form :input').val('');
		});

		$('.modal').on('shown.bs.modal', function () {
			$(this).find('input:first').focus();
		});
	});
</script>
