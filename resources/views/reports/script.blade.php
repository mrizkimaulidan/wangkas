<script>
    $(function() {
        let current_url = new URLSearchParams(window.location.search);

        let url = "{{ route('laporan.export', [`param1`, ':end_date']) }}";
        console.log(url['start_date']);
        let param1 = current_url.get('start_date');
        let param2 = current_url.get('end_date');
        console.log(url.replace([0][':start_date'], 'asdasd'));
        url.replace(':start_date', param1);
        url.replace(':end_date', param2);
    });
</script>