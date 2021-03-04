$(function () {
    $("#datatable").DataTable({
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.22/i18n/id.json",
        },
        lengthMenu: [
            [5, 10, 15, 20, 25, 50, 75, 100, -1],
            [5, 10, 15, 20, 25, 50, 75, 100, "All"],
        ],
    });

    $(".clear-input").on("click", function () {
        $("input:not([name=_method], [name=_token])").val("");
        $("select").prop("selectedIndex", 0).change();
    });

    $(".delete-notification").click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Hapus?",
            text: "Data tidak akan bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya!",
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).parent().submit();
            }
        });
    });

    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    $(".select2").select2();
    $("input[type=date]").flatpickr();
});
