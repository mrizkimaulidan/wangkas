<script>
    $('.administrator-detail').click(function() {
        let id = $(this).data('id');
        let url = "{{ route('api.administrator.show', ':id') }}";
        url = url.replace(':id', id);

        $('#showAdministratorModal input').val('Sedang mengambil data..');

        $.ajax({
            url: url,
            success: function(data) {
                $('#showAdministratorModal #name').val(data.data.name);
                $('#showAdministratorModal #email').val(data.data.email);
            }
        });
    });
</script>