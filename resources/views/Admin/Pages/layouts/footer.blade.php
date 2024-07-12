<!-- Footer-->
<footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span
            class="float-md-left d-block d-md-inline-block">Copyright © {{ date('Y') }} <a
                class="text-bold-800 grey darken-2" href="{{ route('home') }}" target="_blank">Paramount</a></p>
</footer>

<!--  Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>


<!-- Theme JS-->
<script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ asset('app-assets/js/core/app.js') }}"></script>

<!-- Page Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/extensions/jquery.steps.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

<!-- yajra -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<!-- Page Vendor JS-->
<script src="{{ asset('app-assets/vendors/js/ui/headroom.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/editors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/editors/editor-tinymce.js') }}"></script>

<!-- select2 -->
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/forms/select/form-select2.js') }}"></script>

<!-- Sweet alert2 -->
<script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/extensions/ex-component-sweet-alerts.js') }}"></script>

<!-- Datatable-->
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>

<!-- Page JS-->
<script src="{{ asset('app-assets/js/scripts/tables/datatables/datatable-basic.js') }}"></script>

<!-- fancybox js-->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js"></script>

<!-- Custom js-->
<script src="{{ asset('app-assets/js/app.js?v=' . date('Y-m-d H:i:s') . '') }}"></script>
