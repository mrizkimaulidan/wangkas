<script>
    $(function () {
        let loadingAlert = $('.modal-body #loading-alert');

        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('students.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'student_identification_number', name: 'student_identification_number' },
                { data: 'name', name: 'name' },
                { data: 'school_class_id', name: 'school_classes.name' },
                { data: 'school_major', name: 'school_majors.name' },
                { data: 'school_year', name: 'school_year' },
                { data: 'action', name: 'action' },
            ]
        });

        $('#datatable').on('click', '.student-detail', function () {
            loadingAlert.show();

            let url = "{{ route('api.student.show', 'id') }}";
            let id = $(this).data('id');

            url = url.replace('id', id);

            $('#showStudentModal input').val("Sedang mengambil data..");

            $.ajax({
                url: url,
                success: function (res) {
                    loadingAlert.slideUp();

                    $('#showStudentModal #name').val(res.data.name);
                    $('#showStudentModal #gender').val(res.data.gender);
                    $('#showStudentModal #school_class_id').val(res.data.school_classes.name);
                    $('#showStudentModal #school_major_id').val(res.data.school_majors.name);
                    $('#showStudentModal #email').val(res.data.email);
                    $('#showStudentModal #phone_number').val(res.data.phone_number);
                    $('#showStudentModal #school_year_start').val(res.data.school_year_start);
                    $('#showStudentModal #school_year_end').val(res.data.school_year_end);
                }
            });
        });

        $('#datatable').on('click', '.student-edit', function () {
            loadingAlert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.student.edit', 'id') }}";

            url = url.replace('id', id);

            let formActionURL = "{{ route('students.update', 'id') }}"

            formActionURL = formActionURL.replace('id', id);

            let editStudentModalEveryInput = $('#editStudentModal :input:not(input[name=_token], input[name=_method])');
            editStudentModalEveryInput.prop('disabled', true);
            editStudentModalEveryInput.not('select').val('Sedang mengambil data..');

            let editStudentModalSubmitButton = $('#editStudentModal .modal-footer button[type=submit]');
            editStudentModalSubmitButton.prop('disabled', true);

            $.ajax({
                url: url,
                success: function (res) {
                    loadingAlert.slideUp();

                    editStudentModalEveryInput.prop('disabled', false);
                    editStudentModalSubmitButton.prop('disabled', false)

                    $('#editStudentModal #edit-student-form').attr('action', formActionURL)

                    $('#editStudentModal #student_identification_number').val(res.data.student_identification_number);
                    $('#editStudentModal #name').val(res.data.name);
                    $('#editStudentModal #gender').val(res.data.gender);
                    $('#editStudentModal #school_class_id').val(res.data.school_class_id).select2();
                    $('#editStudentModal #school_major_id').val(res.data.school_major_id).select2();
                    $('#editStudentModal #email').val(res.data.email);
                    $('#editStudentModal #phone_number').val(res.data.phone_number);
                    $('#editStudentModal #school_year_start').val(res.data.school_year_start);
                    $('#editStudentModal #school_year_end').val(res.data.school_year_end);
                }
            });
        });
    });
</script>