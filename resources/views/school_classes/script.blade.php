<script>
    $(function () {
        let loading_alert = $('.modal-body #loading-alert');

        $('.school-class-detail').click(function () {
            loading_alert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.class.show', ':id') }}";
            url = url.replace(':id', id);

            $('#showSchoolClassModal .modal-content .modal-body :input').val("Sedang mengambil data..");

            $.ajax({
                url: url,
                success: function (res) {
                    loading_alert.slideUp();

                    $('#showSchoolClassModal .modal-content .modal-body #name').val(res.data.name);
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan, reload halaman ini atau lapor kepada administrator!'
                    });
                }
            });
        });

        $('.school-class-edit').click(function () {
            loading_alert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.class.show', ':id') }}";
            url = url.replace(':id', id);

            let edit_school_class_modal_input = $('#editSchoolClassModal .modal-content .modal-body :input').val('Sedang mengambil data..').prop('disabled', true);

            let form_action_url = "{{ route('classes.update', ':id') }}";
            form_action_url = form_action_url.replace(':id', id)

            let edit_school_class_button = $('#editSchoolClassModal .modal-content .modal-body .modal-footer button[type=submit]');

            edit_school_class_button.prop('disabled', true);

            $.ajax({
                url: url,
                success: function (res) {
                    loading_alert.slideUp();

                    $('#editSchoolClassModal #edit-school-class-form').attr('action', form_action_url);
                    $('#editSchoolClassModal .modal-content .modal-body #name').val(res.data.name);

                    edit_school_class_modal_input.prop('disabled', false);
                    edit_school_class_button.prop('disabled', false)
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan, reload halaman ini atau lapor kepada administrator!'
                    });
                }
            });
        });
    });
</script>