<script>
    $(function() {
        $('.cash-transaction-detail').click(function() {
            let id = $(this).data('id');
            let url = "{{ route('api.cash-transaction.show', ':id') }}";
            url = url.replace(':id', id);
            console.log(url);

            $('#showCashTransactionModal input').val('Sedang mengambil data..');
            $('#showCashTransactionModal textarea').val('Sedang mengambil data..');
            $('#showCashTransactionModal input[type=number]').prop('type', 'text').val('Sedang mengambil data..');

            $.ajax({
                url: url,
                success: function(data) {
                    console.log(data);
                    $('#showCashTransactionModal #user_id').val(data.data.users.name);
                    $('#showCashTransactionModal #student_id').val(data.data.students.name);
                    $('#showCashTransactionModal #bill').val(data.data.bill);
                    $('#showCashTransactionModal #amount').val(data.data.amount);

                    $('#showCashTransactionModal #is_paid').val(data.data.is_paid === 1 ? 'Lunas' : 'Belum Lunas');
                    $('#showCashTransactionModal #date').val(data.data.date);
                    $('#showCashTransactionModal #note').val(data.data.note);
                }
            });
        });
    });
</script>