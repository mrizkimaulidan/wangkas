<script>
    $('.student-detail').click(function() {
        let url = "{{ route('api.siswa.show', ':id') }}";
        let id = $(this).data('id');
        url = url.replace(':id', id);

        $.ajax({
            url: url,
            success: function(data) {
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
</script>