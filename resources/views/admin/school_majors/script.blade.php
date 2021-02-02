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
</script>