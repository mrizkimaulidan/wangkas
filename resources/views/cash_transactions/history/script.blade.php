<script>
	$(function () {
		$('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('cash-transactions.index.history') }}",
			columns: [
				{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
				{ data: 'students.name', name: 'student_id' },
				{ data: 'date', name: 'date' },
				{ data: 'action', name: 'action' },
			]
		});
	});
</script>
