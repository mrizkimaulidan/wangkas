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
                $('#showCashTransactionModal #student_id').val(data.data.student_id);
                $('#showCashTransactionModal #bill').val(data.data.bill);
                $('#showCashTransactionModal #amount').val(data.data.amount);

                $('#showCashTransactionModal #is_paid').val(data.data.is_paid);
                $('#showCashTransactionModal #date').val(data.data.date);
                $('#showCashTransactionModal #note').val(data.data.note);
            }
        });
    });
</script>