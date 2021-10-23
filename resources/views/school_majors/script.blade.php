<script>
    $(function () {
        let loadingAlert = $('.modal-body #loading-alert');

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
            loadingAlert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.school-major.show', 'id') }}";
            url = url.replace('id', id);

            $('#showSchoolMajorModal :input').val('Sedang mengambil data..');

            fetch(url, {
                method: "GET",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
            }).then(async res => {
                loadingAlert.slideUp();

                let response = await res.json();

                $('#showSchoolMajorModal #name').val(response.data.name);
                $('#showSchoolMajorModal #abbreviated_word').val(response.data.abbreviated_word);
            });
        });

        $('#datatable').on('click', '.school-major-edit', function () {
            loadingAlert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.school-major.edit', 'id') }}";
            url = url.replace('id', id);

            let formActionURL = "{{ route('school-majors.update', 'id') }}";
            formActionURL = formActionURL.replace('id', id);

            let editSchoolMajorEveryInput = $('#editSchoolMajorModal input')
            editSchoolMajorEveryInput.not('input[name=_token], input[name=_method]')
                .val('Sedang mengambil data..')
                .prop('disabled', true);

            let editSchoolMajorSubmitButton = $('#editSchoolMajorModal .modal-content .modal-footer button[type=submit]')
                .prop('disabled', true);

            fetch(url, {
                method: "GET",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
            }).then(async res => {
                loadingAlert.slideUp();

                let response = await res.json();

                $('#editSchoolMajorModal #school-major-edit-form').attr('action', formActionURL);

                $('#editSchoolMajorModal #name').val(response.data.name);
                $('#editSchoolMajorModal #abbreviated_word').val(response.data.abbreviated_word);

                editSchoolMajorEveryInput.prop('disabled', false);
                editSchoolMajorSubmitButton.prop('disabled', false);
            });
        });
    });
</script>