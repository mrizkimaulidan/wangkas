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

    $('.administrator-edit').click(function() {
    let id = $(this).data('id');
    let url = "{{ route('api.administrator.show', ':id') }}";
    url = url.replace(':id', id);
    
    let form_action_url = "{{ route('administrator.update', ':id') }}";
    form_action_url = form_action_url.replace(':id', id);

    $('#editAdministratorModal input:not([name=_method], [name=_token]').val('Sedang mengambil data..');
    $('#editAdministratorModal input').prop('disabled', true);
    
    $.ajax({
    url: url,
    success: function(data) {
                $('#editAdministratorModal #administrator-edit-form').attr('action', form_action_url);
                $('#editAdministratorModal input').prop('disabled', false);

                $('#editAdministratorModal #name').val(data.data.name);
                $('#editAdministratorModal #email').val(data.data.email);
            }
        });
    });
</script>