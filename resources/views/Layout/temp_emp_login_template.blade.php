<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HRMS OBP</title>
    
    <meta content="Design & Develope By Debanjan Baidya" name="description">

    <meta content="Design & Develope By Debanjan Baidya" name="keywords">

    <meta name="csrf-token" content="{{ csrf_token() }}">



    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet"

        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->

    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="../assets/vendor/css/bootstrap.min.css">

    {{-- <!-- Theme style -->

    <link rel="stylesheet" href="../dist/css/diptohr.min.css"> --}}

    <!-- Font Awesome -->

    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

<!-- Icons. Uncomment required icon fonts -->

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />



    <!-- Core CSS -->

    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />

    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />

    <link rel="stylesheet" href="../assets/css/demo.css" />



    <!-- Vendors CSS -->

    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />



    <!-- Page CSS -->

    <!-- Page -->

    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->

    <script src="../assets/vendor/js/helpers.js"></script>



    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    
    <script src="../assets/js/config.js"></script>
    @include('pwa.pwa_obp_view')

</head>



<body class="hold-transition login-page">

    @yield('emp_login_contents')

    @include('sweetalert::alert')



    <!-- jQuery -->

    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap 4 -->

        {{-- <script src="../assets/vendor/libs/popper/popper.js"></script> --}}

    <script src="../assets/vendor/js/bootstrap.budle.js"></script>

        <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>



    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->



    <!-- Vendors JS -->



    <!-- Main JS -->

    <script src="../assets/js/main.js"></script>



    <!-- Page JS -->



    <!-- Place this tag in your head or just before your close body tag. -->

    <script async defer src="https://buttons.github.io/buttons.js"></script>
@include('pwa.pwa_obp_install_app_modal')
</body>



</html>

