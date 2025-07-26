<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Aplikasi Pelanggaran' }}</title>

    <link rel="icon" href="{{ asset('templates/dist/img/remove.png') }}" type="image/x-icon">

    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('templates') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('templates') }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('templates') }}/dist/css/adminlte.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('templates') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/toastr/toastr.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('templates') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <script src="{{ asset('templates') }}/plugins/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-secondary navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars text-white"></i></a>
                </li>
                <li class="nav-item mt-2">
                    <a href="" class="text-white">Website Manajemen Pelanggaran Siswa</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt text-white"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.navbar')

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>SMPN 1 KREJENGAN: </strong>Kecamatan Krejengan - Kabupaten Probolinggo - Jawa Timur - 67284
            <div class="float-right d-none d-sm-inline-block">
                <b>Tahun</b> {{ $kasus->tahun_ajaran ?? ($tahun_ajaran ?? '') }}
            </div>
            
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <!-- <script src="{{ asset('templates') }}/plugins/jquery/jquery.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('templates') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('templates') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('templates') }}/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <!-- <script src="{{ asset('templates') }}/plugins/sparklines/sparkline.js"></script> -->
    <!-- JQVMap -->
    <script src="{{ asset('templates') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ asset('templates') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('templates') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('templates') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ asset('templates') }}/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('templates') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="{{ asset('templates') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('templates') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('templates') }}/dist/js/adminlte.js"></script>


    <!-- <script src="{{ asset('templates') }}/dist/js/pages/dashboard.js"></script> -->

    <script src="{{ asset('templates') }}/plugins/flot/jquery.flot.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('templates') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="{{ asset('templates') }}/plugins/flot/plugins/jquery.flot.resize.js"></script>
    <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
    <script src="{{ asset('templates') }}/plugins/flot/plugins/jquery.flot.pie.js"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('templates') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('templates') }}/plugins/toastr/toastr.min.js"></script>
    <!-- Toastr -->
    <script src="{{ asset('templates') }}/plugins/select2/js/select2.full.min.js"></script>


    <!-- DataTables  & Plugins -->
    <script src="{{ asset('templates') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('templates') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('templates') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('templates') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('templates') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('templates') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('templates') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('templates') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('templates') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('templates') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('templates') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('templates') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>



    <script>
        $(function() {

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $("#example1")
                .DataTable({
                    responsive: true,
                    searching: false,
                    lengthChange: true,
                    ordering: false,
                    autoWidth: false,
                    buttons: ["copy", "excel", "pdf", "print", "colvis"],
                })
                .buttons()
                .container()
                .appendTo("#example1_wrapper .col-md-6:eq(0)");

            $("#example2")
                .DataTable({
                    responsive: true,
                    searching: true,
                    lengthChange: true,
                    ordering: false,
                    autoWidth: true,
                    buttons: ["copy", "excel", "pdf", "print", "colvis"],
                })
                .buttons()
                .container()
                .appendTo("#example2_wrapper .col-md-6:eq(0)");
        });
    </script>


</body>

</html>
