<script>
    $(function () {
        let loading_alert = $('.modal-body #loading-alert');

        $('.cash-transaction-detail').click(function () {
            loading_alert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.cash-transaction.show', ':id') }}";
            url = url.replace(':id', id);

            $('#showCashTransactionModal .modal-content .modal-body :input')
                .val('Sedang mengambil data..');

            $.ajax({
                url: url,
                success: function (res) {
                    loading_alert.slideUp();

                    $('#showCashTransactionModal .modal-content .modal-body #user_id').val(res.data.users.name);
                    $('#showCashTransactionModal .modal-content .modal-body #student_id').val(res.data.students.name);
                    $('#showCashTransactionModal .modal-content .modal-body #bill').val(res.data.bill);
                    $('#showCashTransactionModal .modal-content .modal-body #amount').val(res.data.amount);
                    $('#showCashTransactionModal .modal-content .modal-body #is_paid').val(res.data.is_paid === 1 ? 'Lunas' : 'Belum Lunas');
                    $('#showCashTransactionModal .modal-content .modal-body #date').val(res.data.date);
                    $('#showCashTransactionModal .modal-content .modal-body #note').val(res.data.note);
                }
            });
        });

        $('.cash-transaction-edit').click(function () {
            loading_alert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.cash-transaction.show', ':id') }}";
            url = url.replace(':id', id);

            let form_action_url = "{{ route('cash-transactions.update', ':id') }}";
            form_action_url = form_action_url.replace(':id', id);

            let edit_cash_transaction_modal_input = $('#editCashTransactionModal .modal-content .modal-body :input:not(button[type=button])');
            edit_cash_transaction_modal_input.not('input[name=_method], input[name=_token]')
            edit_cash_transaction_modal_input.prop('disabled', true);

            let edit_cash_transaction_modal_button_submit = $('#editCashTransactionModal .modal-content .modal-footer button[type=submit]')
            edit_cash_transaction_modal_button_submit.prop('disabled', true);

            $.ajax({
                url: url,
                success: function (res) {
                    loading_alert.slideUp();

                    $('#editCashTransactionModal .modal-body #cash-transaction-edit-form').attr('action', form_action_url);
                    edit_cash_transaction_modal_input.prop('disabled', false);
                    edit_cash_transaction_modal_button_submit.prop('disabled', false);

                    $('#editCashTransactionModal .modal-content .modal-body #student_id').val(res.data.student_id).select2();
                    $('#editCashTransactionModal .modal-content .modal-body #bill').val(res.data.bill);
                    $('#editCashTransactionModal .modal-content .modal-body #amount').val(res.data.amount);
                    $('#editCashTransactionModal .modal-content .modal-body #is_paid').val(res.data.is_paid);
                    $('#editCashTransactionModal .modal-content .modal-body #date').val(res.data.date);
                    $('#editCashTransactionModal .modal-content .modal-body #note').val(res.data.note);
                }
            });
        });
    });
</script>