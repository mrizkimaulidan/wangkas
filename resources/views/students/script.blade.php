<script>
    $('.student-detail').click(function() {
        let url = "{{ route('api.students.show', ':id') }}";
        let id = $(this).data('id');
        url = url.replace(':id', id);

        $('#showStudentModal input').val("Sedang mengambil data..");

        $.ajax({
            url: url
            , success: function(data) {
                let gender = data.data.gender === 1 ? 'Laki-laki' : 'Perempuan';

                $('#showStudentModal #name').val(data.data.name);

                $('#showStudentModal #gender').val(gender);
                $('#showStudentModal #school_class_id').val(data.data.school_classes.name);
                $('#showStudentModal #school_major_id').val(data.data.school_majors.name);
                $('#showStudentModal #email').val(data.data.email);
                $('#showStudentModal #phone_number').val(data.data.phone_number);

                $('#showStudentModal #school_year_start').val(data.data.school_year_start);
                $('#showStudentModal #school_year_end').val(data.data.school_year_end);
            }
        });
    });

    $('.student-edit').click(function() {
        let id = $(this).data('id');
        let url = "{{ route('api.students.show', ':id') }}";
        url = url.replace(':id', id);

        let form_edit_url = "{{ route('students.update', ':id') }}"
        form_edit_url = form_edit_url.replace(':id', id);

        let edit_student_modal_input = $('#editStudentModal input:not([name=_method], [name=_token])');
        let edit_student_modal_select = $('#editStudentModal select');

        edit_student_modal_select.prop('disabled', true);
        edit_student_modal_input.prop('disabled', true);
        edit_student_modal_input.val('Sedang mengambil data..');
        $('#editStudentModal .modal-footer button[type=submit]').prop('disabled', true);

        $.ajax({
            url: url
            , success: function(data) {
                edit_student_modal_input.prop('disabled', false);
                edit_student_modal_select.prop('disabled', false);
                $('#editStudentModal .modal-footer button[type=submit]').prop('disabled', false);
                $('#editStudentModal #edit-student-form').attr('action', form_edit_url)

                $('#editStudentModal #student_identification_number').val(data.data.student_identification_number);
                $('#editStudentModal #name').val(data.data.name);

                $('#editStudentModal #gender').val(data.data.gender);
                $('#editStudentModal #school_class_id').val(data.data.school_class_id).select2();
                $('#editStudentModal #school_major_id').val(data.data.school_major_id).select2();
                $('#editStudentModal #email').val(data.data.email);
                $('#editStudentModal #phone_number').val(data.data.phone_number);

                $('#editStudentModal #school_year_start').val(data.data.school_year_start);
                $('#editStudentModal #school_year_end').val(data.data.school_year_end);
            }
        });
    });

</script>
