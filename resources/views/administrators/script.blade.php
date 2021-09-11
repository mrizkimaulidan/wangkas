<script>
    $(function () {
        let loading_alert = $('.modal-body #loading-alert');

        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('administrators.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action' },
            ]
        });

        $('#datatable').on('click', '.administrator-detail', function () {
            loading_alert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.administrator.show', ':id') }}";
            url = url.replace(':id', id);

            $('#showAdministratorModal :input').val('Sedang mengambil data..');

            $.ajax({
                url: url,
                success: function (res) {
                    loading_alert.slideUp();

                    $('#showAdministratorModal .modal-content .modal-body #name').val(res.data.name);
                    $('#showAdministratorModal .modal-content .modal-body #email').val(res.data.email);
                }
            });
        });

        $('#datatable').on('click', '.administrator-edit', function () {
            loading_alert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.administrator.show', ':id') }}";
            url = url.replace(':id', id);

            let form_action_url = "{{ route('administrators.update', ':id') }}";
            form_action_url = form_action_url.replace(':id', id);

            let edit_administrator_modal_input = $('#editAdministratorModal .modal-content .modal-body input:not([name=_method], [name=_token], [id=password], [id=password_confirmation]')
            edit_administrator_modal_input.val('Sedang mengambil data..');

            $('#editAdministratorModal .modal-content .modal-body input').prop('disabled', true);

            let edit_administrator_modal_submit_button = $('#editAdministratorModal .modal-footer button[type=submit]');
            edit_administrator_modal_submit_button.prop('disabled', true);

            $.ajax({
                url: url,
                success: function (res) {
                    loading_alert.slideUp();

                    $('#editAdministratorModal .modal-content .modal-body #administrator-edit-form').attr('action', form_action_url);

                    $('#editAdministratorModal .modal-content .modal-body input').prop('disabled', false);
                    edit_administrator_modal_input.prop('disabled', false);
                    edit_administrator_modal_submit_button.prop('disabled', false);

                    $('#editAdministratorModal .modal-content .modal-body #name').val(res.data.name);
                    $('#editAdministratorModal .modal-content .modal-body #email').val(res.data.email);
                }
            });
        });
    })

</script>