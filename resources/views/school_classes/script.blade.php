<script>
    $('.school-class-detail').click(function() {
        let id = $(this).data('id');
        let url = "{{ route('api.classes.show', ':id') }}";
        url = url.replace(':id', id);

        $('#showSchoolClassModal #name').val("Sedang mengambil data..");

        $.ajax({
            url: url
            , success: function(data) {
                $('#showSchoolClassModal #name').val(data.data.name);
            }
            , error: function() {
                Swal.fire({
                    icon: 'error'
                    , title: 'Oops...'
                    , text: 'Terjadi kesalahan, reload halaman ini atau lapor kepada administrator!'
                });
            }
        });
    });

    $('.school-class-edit').click(function() {
        let id = $(this).data('id');
        let url = "{{ route('api.classes.show', ':id') }}";
        url = url.replace(':id', id);

        let edit_button_input = $('#editSchoolClassModal #name');
        edit_button_input.val("Sedang mengambil data..");
        edit_button_input.prop('disabled', true);

        let form_action_url = "{{ route('classes.update', ':id') }}";
        form_action_url = form_action_url.replace(':id', id)

        $('#editSchoolClassModal .modal-footer button[type=submit]').prop('disabled', true);

        $.ajax({
            url: url
            , success: function(data) {
                edit_button_input.val(data.data.name);
                edit_button_input.prop('disabled', false);
                $('#editSchoolClassModal .modal-footer button[type=submit]').prop('disabled', false);
                $('#editSchoolClassModal #edit-school-class-form').attr('action', form_action_url);
            }
            , error: function() {
                Swal.fire({
                    icon: 'error'
                    , title: 'Oops...'
                    , text: 'Terjadi kesalahan, reload halaman ini atau lapor kepada administrator!'
                });
            }
        });
    });

</script>
