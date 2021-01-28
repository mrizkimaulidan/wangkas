<script>
    $('.school-class-detail').click(function() {
        let id = $(this).data('id');
        let url = "{{ route('api.kelas.show', ':id') }}";
        url = url.replace(':id', id);
        
        $.ajax({
            url: url,
            success: function(data) {
                $('#name_show').val(data.data.name);
            },
            error: function() {
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Terjadi kesalahan, reload halaman ini atau lapor kepada administrator!'
            });
            }
        })
    })
</script>