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
                success: function (res) {
                    loadingAlert.slideUp();

                    $('#showCashTransactionModal #user_id').val(res.data.users.name);
                    $('#showCashTransactionModal #student_id').val(res.data.students.name);
                    $('#showCashTransactionModal #bill').val(res.data.bill);
                    $('#showCashTransactionModal #amount').val(res.data.amount);
                    $('#showCashTransactionModal #is_paid').val(res.data.is_paid);
                    $('#showCashTransactionModal #date').val(res.data.date);
                    $('#showCashTransactionModal #note').val(res.data.note);
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

            let editCashTransactionModalEveryInput = $('#editCashTransactionModal :input:not(button[type=button])');
            editCashTransactionModalEveryInput.not('input[name=_method], input[name=_token]')
            editCashTransactionModalEveryInput.prop('disabled', true);

            let editCashTransactionModalButtonSubmit = $('#editCashTransactionModal .modal-content .modal-footer button[type=submit]')
            editCashTransactionModalButtonSubmit.prop('disabled', true);

            $.ajax({
                url: url,
                success: function (res) {
                    loadingAlert.slideUp();

                    $('#editCashTransactionModal .modal-body #cash-transaction-edit-form').attr('action', formActionURL);
                    editCashTransactionModalEveryInput.prop('disabled', false);
                    editCashTransactionModalButtonSubmit.prop('disabled', false);

                    $('#editCashTransactionModal #student_name').val(res.data.students.name);
                    $('#editCashTransactionModal #student_id').val(res.data.student_id);
                    $('#editCashTransactionModal #bill').val(res.data.bill);
                    $('#editCashTransactionModal #amount').val(res.data.amount);
                    $('#editCashTransactionModal #is_paid').val(res.data.is_paid);
                    $('#editCashTransactionModal #date').val(res.data.date);
                    $('#editCashTransactionModal #note').val(res.data.note);
                }
            });
        });
    });
</script>