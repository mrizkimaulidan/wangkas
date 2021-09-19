<script>
    $(function () {
        let loadingAlert = $('.modal-body #loading-alert');

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
            loadingAlert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.administrator.show', ':id') }}";
            url = url.replace(':id', id);

            $('#showAdministratorModal input').val('Sedang mengambil data..');

            $.ajax({
                url: url,
                success: function (res) {
                    loadingAlert.slideUp();

                    $('#showAdministratorModal #name').val(res.data.name);
                    $('#showAdministratorModal #email').val(res.data.email);
                }
            });
        });

        $('#datatable').on('click', '.administrator-edit', function () {
            loadingAlert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.administrator.edit', 'id') }}";
            url = url.replace('id', id);

            let formActionURL = "{{ route('administrators.update', 'id') }}";
            formActionURL = formActionURL.replace('id', id);

            let editAdministratorModalEveryInput = $('#editAdministratorModal input:not(input[name=_method], input[name=_token], input[name=password], input[name=password_confirmation])');
            editAdministratorModalEveryInput.val('Sedang mengambil data..');

            $('#editAdministratorModal input').prop('disabled', true);

            let editAdministratorModalSubmitButton = $('#editAdministratorModal .modal-footer button[type=submit]');
            editAdministratorModalSubmitButton.prop('disabled', true);

            $.ajax({
                url: url,
                success: function (res) {
                    loadingAlert.slideUp();

                    $('#editAdministratorModal #administrator-edit-form').attr('action', formActionURL);

                    $('#editAdministratorModal').find('input[name=password], input[name=password_confirmation]').prop('disabled', false);
                    editAdministratorModalEveryInput.prop('disabled', false);
                    editAdministratorModalSubmitButton.prop('disabled', false);

                    $('#editAdministratorModal #name').val(res.data.name);
                    $('#editAdministratorModal #email').val(res.data.email);
                }
            });
        });
    })

</script>