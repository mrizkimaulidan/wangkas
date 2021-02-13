<script>
    $('.school-major-detail').click(function() {
        let id = $(this).data('id');
        let url = "{{ route('api.jurusan.show', ':id') }}";
        url = url.replace(':id', id);

        $('#showSchoolMajorModal input').val('Sedang mengambil data..');

        $.ajax({
            url: url,
            success: function(data) {
                $('#showSchoolMajorModal #name').val(data.data.name);
                $('#showSchoolMajorModal #abbreviated_word').val(data.data.abbreviated_word);
            }
        })
    });

    $('.school-major-edit').click(function() {
        let id = $(this).data('id');
        let url = "{{ route('api.jurusan.show', ':id') }}";
        url = url.replace(':id', id);

        let form_input_url = "{{ route('jurusan.update', ':id') }}";
        form_input_url = form_input_url.replace(':id', id);

        let edit_school_major_input = $('#editSchoolMajorModal input:not([name=_method], [name=_token])');
        edit_school_major_input.val('Sedang mengambil data..');
        edit_school_major_input.prop('disabled', true);

        $.ajax({
            url: url,
            success: function(data) {
                $('#school-major-edit-form').attr('action', form_input_url);
                $('#editSchoolMajorModal input').prop('disabled', false);

                $('#editSchoolMajorModal #name').val(data.data.name);
                $('#editSchoolMajorModal #abbreviated_word').val(data.data.abbreviated_word);
            }
        })
    });
</script>