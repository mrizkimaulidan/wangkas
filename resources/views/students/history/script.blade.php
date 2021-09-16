<script>
    $(function () {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('students.index.history') }}",
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
    });
</script>