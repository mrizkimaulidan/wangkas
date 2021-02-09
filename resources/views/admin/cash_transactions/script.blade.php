<script>
    $('.cash-transaction-detail').click(function() {
        let id = $(this).data('id');
        let url = "{{ route('api.kas.show', ':id') }}";
        url = url.replace(':id', id);

        $('#showCashTransactionModal input').val('Sedang mengambil data..');
        $('#showCashTransactionModal textarea').val('Sedang mengambil data..');
        $('#showCashTransactionModal input[type=number]').prop('type', 'text').val('Sedang mengambil data..');

        $.ajax({
            url: url,
            success: function(data) {
                $('#showCashTransactionModal #user_id').val(data.data.user_id);
                $('#showCashTransactionModal #student_id').val(data.data.student_name);
                $('#showCashTransactionModal #bill').val(data.data.bill);
                $('#showCashTransactionModal #amount').val(data.data.amount);

                $('#showCashTransactionModal #is_paid').val(data.data.is_paid);
                $('#showCashTransactionModal #date').val(data.data.date);
                $('#showCashTransactionModal #note').val(data.data.note);
            }
        });
    });

    $('.cash-transaction-edit').click(function() {
    let id = $(this).data('id');
    let url = "{{ route('api.kas.show', ':id') }}";
    url = url.replace(':id', id);

    let form_action_url = "{{ route('admin.kas.update', ':id') }}";
    form_action_url = form_action_url.replace(':id', id);

    $('#editCashTransactionModal input:not([name=_method], [name=_token]').val('Sedang mengambil data..');
    $('#editCashTransactionModal input').prop('disabled', true);
    $('#editCashTransactionModal select').prop('disabled', true);
    $('#editCashTransactionModal textarea').prop('disabled', true);
    $('#editCashTransactionModal textarea').val('Sedang mengambil data..');
    $('#editCashTransactionModal input[type=number]').prop('type', 'text').val('Sedang mengambil data..');
    
    $.ajax({
        url: url,
        success: function(data) {
                let is_paid = data.data.is_paid === 'Lunas' ? 1 : 0;
                $('#editCashTransactionModal input').prop('disabled', false);
                $('#editCashTransactionModal textarea').prop('disabled', false);
                $('#editCashTransactionModal select').prop('disabled', false);
                $('#editCashTransactionModal #student_id').val(data.data.student_id);
                $('#editCashTransactionModal #bill').val(data.data.bill);
                $('#editCashTransactionModal #amount').val(data.data.amount);
                
                $('#editCashTransactionModal #is_paid').val(is_paid);
                $('#editCashTransactionModal #date').val(data.data.date_update);
                $('#editCashTransactionModal #note').val(data.data.note);

                $('#editCashTransactionModal #cash-transaction-edit-form').attr('action', form_action_url);
            }
        });
    });
</script>