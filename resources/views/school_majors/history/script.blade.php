<script>
    $(function () {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('school-majors.index.history') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'abbreviated_word', name: 'abbreviated_word' },
                { data: 'action', name: 'action' },
            ]
        });
    });
</script>