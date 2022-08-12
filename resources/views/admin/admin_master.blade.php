<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8" />
    <title>MDD Vendorlist dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="MDD Vendorlist dashboard" name="description" />
    <meta content="Abdulrahman Yamout" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <!-- jquery.vectormap css -->
    <link href="{{ asset('backend/') }}/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/') }}/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/') }}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/') }}/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="{{ asset('backend/') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">
    <!-- Lightbox css -->
    <link href="{{ asset('backend/') }}/assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('backend/') }}/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/') }}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend/') }}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<style>

    .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
        background-color: #102647 !important;
        border-color: #102647 !important;
    }

</style>
</head>

<body data-topbar="dark">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">


    @include('admin.body.header')

    <!-- ========== Left Sidebar Start ========== -->
{{--    @include('admin.body.sidebar')--}}
    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->

        @yield('admin')

        <!-- End Page-content -->

        @include('admin.body.footer')



    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->

<!-- /Right-bar -->

<!-- Right bar overlay-->


<!-- JAVASCRIPT -->
<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>


<!-- apexcharts -->
<script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- jquery.vectormap map -->
<script src="{{ asset('backend/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}"></script>

<!-- Required datatable js -->
<script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<!-- Responsive examples -->
<script src="{{ asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<script src="{{ asset('backend/assets/js/pages/dashboard.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('backend/assets/js/app.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif
</script>

<script src="{{ asset('backend/') }}/assets/libs/jquery/jquery.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/node-waves/waves.min.js"></script>




<script src="{{ asset('backend/') }}/assets/libs/select2/js/select2.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

<script src="{{ asset('backend/') }}/assets/js/pages/form-advanced.init.js"></script>


<!-- Required datatable js -->
<script src="{{ asset('backend/') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="{{ asset('backend/') }}/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/jszip/jszip.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<script src="{{ asset('backend/') }}/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>

<!-- Responsive examples -->
<script src="{{ asset('backend/') }}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend/') }}/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>


<!-- Magnific Popup-->
<script src="{{ asset('backend/') }}/assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- lightbox init js-->
<script src="{{ asset('backend/') }}/assets/js/pages/lightbox.init.js"></script>

<!-- Datatable init js -->
<script src="{{ asset('backend/') }}/assets/js/pages/datatables.init.js"></script>

<script src="{{ asset('backend/') }}/assets/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@yield('scripts')

</body>
<script>

    $(document).ready(function() {
        $('table.display').DataTable( {
            "order": [[ 0, "asc" ]],
            "searching": true,
            "paging": false,
            "info": true,
            "lengthChange":true

        } );

    } );

    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict';

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach((form) => {
            form.addEventListener('submit', (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>



</html>
