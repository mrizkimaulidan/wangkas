<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2021 &copy; Mazer</p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                    href="http://ahmadsaugi.com">A. Saugi</a></p>
        </div>
    </div>
</footer>
</div>
</div>
<script src="{{ asset('vendors/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('vendors/apexcharts/apexcharts.js') }}"></script>

<script src="{{ asset('vendors/toastify/toastify.js') }}"></script>

<script src="{{ asset('vendors/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendors/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('vendors/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('vendors/flatpickr/id.js') }}"></script>


<script src="{{ asset('js/script.js') }}"></script>

@include('utilities.toastify-flash-message')

@stack('modal')
@stack('js')
</body>

</html>