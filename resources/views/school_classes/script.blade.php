<script>
    $(function () {
        let loadingAlert = $('.modal-body #loading-alert');

        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('school-classes.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'action', name: 'action' },
            ]
        });

        $('#datatable').on('click', '.school-class-detail', function () {
            loadingAlert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.school-class.show', 'id') }}";
            url = url.replace('id', id);

            $('#showSchoolClassModal :input').val("Sedang mengambil data..");

            $.ajax({
                url: url,
                success: function (res) {
                    loadingAlert.slideUp();

                    $('#showSchoolClassModal #name').val(res.data.name);
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

        $('#datatable').on('click', '.school-class-edit', function () {
            loadingAlert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.school-class.edit', 'id') }}";
            url = url.replace('id', id);

            let editSchoolClassModalEveryInput = $('#editSchoolClassModal input')

            editSchoolClassModalEveryInput.not('input[name=_token], input[name=_method]')
                .val('Sedang mengambil data..')
                .prop('disabled', true);

            let formActionURL = "{{ route('school-classes.update', 'id') }}";
            formActionURL = formActionURL.replace('id', id)

            let editSchoolClassButtonSubmit = $('#editSchoolClassModal .modal-footer button[type=submit]');

            editSchoolClassButtonSubmit.prop('disabled', true);

            $.ajax({
                url: url,
                success: function (res) {
                    loadingAlert.slideUp();

                    $('#editSchoolClassModal #edit-school-class-form').attr('action', formActionURL);
                    $('#editSchoolClassModal #name').val(res.data.name);

                    editSchoolClassModalEveryInput.prop('disabled', false);
                    editSchoolClassButtonSubmit.prop('disabled', false)
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