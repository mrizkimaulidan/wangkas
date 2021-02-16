$(function () {
    function slideToggle(t, e, o) {
        0 === t.clientHeight ? j(t, e, o, !0) : j(t, e, o);
    }
    function slideUp(t, e, o) {
        j(t, e, o);
    }
    function slideDown(t, e, o) {
        j(t, e, o, !0);
    }
    function j(t, e, o, i) {
        void 0 === e && (e = 400),
            void 0 === i && (i = !1),
            (t.style.overflow = "hidden"),
            i && (t.style.display = "block");
        var p,
            l = window.getComputedStyle(t),
            n = parseFloat(l.getPropertyValue("height")),
            a = parseFloat(l.getPropertyValue("padding-top")),
            s = parseFloat(l.getPropertyValue("padding-bottom")),
            r = parseFloat(l.getPropertyValue("margin-top")),
            d = parseFloat(l.getPropertyValue("margin-bottom")),
            g = n / e,
            y = a / e,
            m = s / e,
            u = r / e,
            h = d / e;
        window.requestAnimationFrame(function l(x) {
            void 0 === p && (p = x);
            var f = x - p;
            i
                ? ((t.style.height = g * f + "px"),
                  (t.style.paddingTop = y * f + "px"),
                  (t.style.paddingBottom = m * f + "px"),
                  (t.style.marginTop = u * f + "px"),
                  (t.style.marginBottom = h * f + "px"))
                : ((t.style.height = n - g * f + "px"),
                  (t.style.paddingTop = a - y * f + "px"),
                  (t.style.paddingBottom = s - m * f + "px"),
                  (t.style.marginTop = r - u * f + "px"),
                  (t.style.marginBottom = d - h * f + "px")),
                f >= e
                    ? ((t.style.height = ""),
                      (t.style.paddingTop = ""),
                      (t.style.paddingBottom = ""),
                      (t.style.marginTop = ""),
                      (t.style.marginBottom = ""),
                      (t.style.overflow = ""),
                      i || (t.style.display = "none"),
                      "function" == typeof o && o())
                    : window.requestAnimationFrame(l);
        });
    }

    let sidebarItems = document.querySelectorAll(".sidebar-item.has-sub");
    for (var i = 0; i < sidebarItems.length; i++) {
        let sidebarItem = sidebarItems[i];
        sidebarItems[i]
            .querySelector(".sidebar-link")
            .addEventListener("click", function (e) {
                e.preventDefault();

                let submenu = sidebarItem.querySelector(".submenu");
                if (submenu.style.display == "none")
                    submenu.classList.add("active");
                else submenu.classList.remove("active");
                slideToggle(submenu, 300);
            });
    }

    window.addEventListener("DOMContentLoaded", (event) => {
        var w = window.innerWidth;
        if (w < 1200) {
            document.getElementById("sidebar").classList.remove("active");
        }
    });
    window.addEventListener("resize", (event) => {
        var w = window.innerWidth;
        if (w < 1200) {
            document.getElementById("sidebar").classList.remove("active");
        } else {
            document.getElementById("sidebar").classList.add("active");
        }
    });

    document.querySelector(".burger-btn").addEventListener("click", () => {
        document.getElementById("sidebar").classList.toggle("active");
    });
    document.querySelector(".sidebar-hide").addEventListener("click", () => {
        document.getElementById("sidebar").classList.toggle("active");
    });

    // Perfect Scrollbar Init
    if (typeof PerfectScrollbar == "function") {
        const container = document.querySelector(".sidebar-wrapper");
        const ps = new PerfectScrollbar(container, {
            wheelPropagation: false,
        });
    }

    // Scroll into active sidebar
    document.querySelector(".sidebar-item.active").scrollIntoView(false);

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
});
