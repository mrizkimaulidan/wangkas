<script>
    $(function () {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('school-classes.index.history') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'action', name: 'action' },
            ]
        });
    });
</script>