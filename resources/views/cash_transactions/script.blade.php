<script>
	$(function () {
		let loadingAlert = $('.modal-body #loading-alert');

		$('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('cash-transactions.index') }}",
			columns: [
				{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
				{ data: 'students.name', name: 'students.name' },
				{ data: 'bill', name: 'bill' },
				{ data: 'amount', name: 'amount' },
				{ data: 'date', name: 'date' },
				{ data: 'action', name: 'action' },
			]
		});

		$('#datatable').on('click', '.cash-transaction-detail', function () {
			loadingAlert.show();

			let id = $(this).data('id');
			let url = "{{ route('api.cash-transaction.show', 'id') }}";
			url = url.replace('id', id);

			$('#showCashTransactionModal :input').val('Sedang mengambil data..');

			$.ajax({
				url: url,
				headers: {
					'Accept': 'application/json',
				},
				success: function (response) {
					loadingAlert.slideUp();

					$('#showCashTransactionModal #user_id').val(response.data.users.name);
					$('#showCashTransactionModal #student_id').val(response.data.students.name);
					$('#showCashTransactionModal #bill').val(response.data.bill);
					$('#showCashTransactionModal #amount').val(response.data.amount);
					$('#showCashTransactionModal #is_paid').val(response.data.is_paid);
					$('#showCashTransactionModal #date').val(response.data.date);
					$('#showCashTransactionModal #note').val(response.data.note);
				}
			});
		});

		$('#datatable').on('click', '.cash-transaction-edit', function () {
			loadingAlert.show();

			let id = $(this).data('id');
			let url = "{{ route('api.cash-transaction.edit', 'id') }}";
			url = url.replace('id', id);

			let formActionURL = "{{ route('cash-transactions.update', 'id') }}";
			formActionURL = formActionURL.replace('id', id);

			let editSchoolClassModalEveryInput = $('#editCashTransactionModal :input').not('button[type=button], input[name=_token], input[name=_method]')
				.each(function () {
					$(this).not('select').val('Sedang mengambil data..');
					$(this).prop('disabled', true);
				});

			$.ajax({
				url: url,
				headers: {
					'Accept': 'application/json',
				},
				success: function (response) {
					loadingAlert.slideUp();

					$('#editCashTransactionModal .modal-body #cash-transaction-edit-form').attr('action', formActionURL);
					editSchoolClassModalEveryInput.prop('disabled', false);

					$('#editCashTransactionModal #student_name').val(response.data.students.name);
					$('#editCashTransactionModal #student_id').val(response.data.student_id);
					$('#editCashTransactionModal #bill').val(response.data.bill);
					$('#editCashTransactionModal #amount').val(response.data.amount);
					$('#editCashTransactionModal #is_paid').val(response.data.is_paid);
					$('#editCashTransactionModal #date').val(response.data.date);
					$('#editCashTransactionModal #note').val(response.data.note);
				}
			});
		});
	});
</script>
