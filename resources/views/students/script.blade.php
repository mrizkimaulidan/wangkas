<script>
    $(function () {
        let loading_alert = $('.modal-body #loading-alert');

        $('.student-detail').click(function () {
            loading_alert.show();

            let url = "{{ route('api.student.show', ':id') }}";
            let id = $(this).data('id');

            url = url.replace(':id', id);

            $('#showStudentModal .modal-body input').val("Sedang mengambil data..");

            $.ajax({
                url: url,
                success: function (res) {
                    loading_alert.slideUp();

                    let gender = res.data.gender === 1 ? 'Laki-laki' : 'Perempuan';

                    $('#showStudentModal .modal-body #name').val(res.data.name);
                    $('#showStudentModal .modal-body #gender').val(gender);
                    $('#showStudentModal .modal-body #school_class_id').val(res.data.school_classes.name);
                    $('#showStudentModal .modal-body #school_major_id').val(res.data.school_majors.name);
                    $('#showStudentModal .modal-body #email').val(res.data.email);
                    $('#showStudentModal .modal-body #phone_number').val(res.data.phone_number);
                    $('#showStudentModal .modal-body #school_year_start').val(res.data.school_year_start);
                    $('#showStudentModal .modal-body #school_year_end').val(res.data.school_year_end);
                }
            });
        });

        $('.student-edit').click(function () {
            loading_alert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.student.show', ':id') }}";

            url = url.replace(':id', id);

            let form_edit_url = "{{ route('students.update', ':id') }}"

            form_edit_url = form_edit_url.replace(':id', id);

            let edit_student_modal_input = $('#editStudentModal .modal-body #edit-student-form :input');
            let edit_student_modal_submit_button = $('#editStudentModal .modal-footer button[type=submit]');

            edit_student_modal_input.prop('disabled', true);
            edit_student_modal_input.not('select').val('Sedang mengambil data..');

            edit_student_modal_submit_button.prop('disabled', true);

            $.ajax({
                url: url,
                success: function (res) {
                    loading_alert.slideUp();

                    edit_student_modal_input.prop('disabled', false);
                    edit_student_modal_submit_button.prop('disabled', false)

                    $('#editStudentModal .modal-body #edit-student-form').attr('action', form_edit_url)

                    $('#editStudentModal .modal-body #student_identification_number').val(res.data.student_identification_number);
                    $('#editStudentModal .modal-body #name').val(res.data.name);
                    $('#editStudentModal .modal-body #gender').val(res.data.gender);
                    $('#editStudentModal .modal-body #school_class_id').val(res.data.school_class_id).select2();
                    $('#editStudentModal .modal-body #school_major_id').val(res.data.school_major_id).select2();
                    $('#editStudentModal .modal-body #email').val(res.data.email);
                    $('#editStudentModal .modal-body #phone_number').val(res.data.phone_number);
                    $('#editStudentModal .modal-body #school_year_start').val(res.data.school_year_start);
                    $('#editStudentModal .modal-body #school_year_end').val(res.data.school_year_end);
                }
            });
        });
    });
</script>