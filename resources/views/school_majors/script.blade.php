<script>
    $(function () {
        let loading_alert = $('.modal-body #loading-alert');

        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('school-majors.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'abbreviated_word', name: 'abbreviated_word' },
                { data: 'action', name: 'action' },
            ]
        });

        $('#datatable').on('click', '.school-major-detail', function () {
            loading_alert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.school-major.show', ':id') }}";
            url = url.replace(':id', id);

            $('#showSchoolMajorModal :input').val('Sedang mengambil data..');

            $.ajax({
                url: url,
                success: function (res) {
                    loading_alert.slideUp();

                    $('#showSchoolMajorModal .modal-content .modal-body #name').val(res.data.name);
                    $('#showSchoolMajorModal .modal-content .modal-body #abbreviated_word').val(res.data.abbreviated_word);
                }
            })
        });

        $('#datatable').on('click', '.school-major-edit', function () {
            loading_alert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.school-major.show', ':id') }}";
            url = url.replace(':id', id);

            let form_input_url = "{{ route('school-majors.update', ':id') }}";
            form_input_url = form_input_url.replace(':id', id);

            let edit_school_major_input = $('#editSchoolMajorModal .modal-content .modal-body :input:not(input[name=_token], input[name=_method])')
                .val('Sedang mengambil data..')
                .prop('disabled', true);

            let edit_school_major_button = $('#editSchoolMajorModal .modal-content .modal-footer button[type=submit]')
                .prop('disabled', true);

            $.ajax({
                url: url,
                success: function (res) {
                    loading_alert.slideUp();

                    $('#editSchoolMajorModal .modal-content .modal-body #school-major-edit-form').attr('action', form_input_url);

                    $('#editSchoolMajorModal .modal-content .modal-body #name').val(res.data.name);
                    $('#editSchoolMajorModal .modal-content .modal-body #abbreviated_word').val(res.data.abbreviated_word);

                    edit_school_major_input.prop('disabled', false);
                    edit_school_major_button.prop('disabled', false);
                }
            })
        });
    });
</script>