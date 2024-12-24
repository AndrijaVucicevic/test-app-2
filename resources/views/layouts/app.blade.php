<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test App </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/skin-blue.min.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css') }}">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- HEADER -->
        @include('partials.header') <!-- Zaglavlje iz posebnog fajla -->

        <!-- SIDEBAR -->
        <aside class="main-sidebar">
            @include('partials.sidebar') <!-- Bočna traka iz posebnog fajla -->
        </aside>

        <!-- SADRŽAJ STRANICE -->
        <div class="content-wrapper">
            <section class="content">
                @yield('content') <!-- Dinamički sadržaj -->
            </section>
        </div>

        <!-- FOOTER -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">Version 1.0</div>
            <strong>Copyright &copy; 2024 <a href="#">Your Company</a>.</strong> All rights reserved.
        </footer>
    </div>

    @include('layouts.base.translations')
    <!-- SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    <script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    
    <script src="/js/app.js"></script>
    @include('components.modal.modal-delete') 

    @include('layouts.base.page-scripts')

</body>

</html>