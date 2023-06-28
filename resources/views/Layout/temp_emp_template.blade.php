<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title id="obp_main_title">HRMS OBP</title>
    
    <meta content="Design & Develope By Debanjan Baidya" name="description">

    <meta content="Design & Develope By Debanjan Baidya" name="keywords">



    <!-- Favicon -->

    <link rel="icon" type="image/x-icon" href="../img/icon_title3.png" />







    <!-- Icons. Uncomment required icon fonts -->

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />



    <!-- Core CSS -->

    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />

    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />

    <link rel="stylesheet" href="../assets/css/demo.css" />



    <!-- Vendors CSS -->

    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->



    <!-- Page CSS -->

    <!-- Font Awesome -->

    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <!-- Select2 -->

    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- DataTables -->

    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

    <!-- SweetAlert2 -->

    <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- Toastr -->

    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />



    <!-- Helpers -->

    <script src="../assets/vendor/js/helpers.js"></script>



    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="../assets/js/config.js"></script>
    @include('pwa.pwa_obp_view')

</head>



<body>

    @include('sweetalert::alert')

    <input type="hidden" id="temp_emp_account_validity" value="{{Session::get('temp_employee')->valid_till}}">

    <!-- Layout wrapper -->

    <div class="layout-wrapper layout-content-navbar">

        <div class="layout-container">

            <!-- Menu -->



            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

                <div class="app-brand demo">

                    <a href="index.html" class="app-brand-link">

                        {{-- <img src="../img/logo_dipto_r3_final.png" height="55px" width="130px" alt=""> --}}

                        <span class="app-brand-text  fw-bolder ms-2 fs-3 mt-1 text-success">HRMS</span>

                    </a>



                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">

                        <i class="bx bx-chevron-left bx-sm align-middle"></i>

                    </a>

                </div>



                <div class="menu-inner-shadow"></div>



                <ul class="menu-inner py-1">

                    <!-- Dashboard -->

                    <li class="menu-item" id="menu_dashboard">

                        <a href="/temp_emp_dashboard" class="menu-link ">

                            <i class="menu-icon fas fa-home"></i>

                            <div  class="fw-bold">Dashboard</div>

                        </a>

                    </li>

                    <li class="menu-item" id="menu_job_application">

                        <a href="/basic_information_form" class="menu-link ">

                            <i class="menu-icon fas fa-file-signature"></i>

                            <div class="fw-bold">Basic Information form</div>

                        </a>

                    </li>

                    <li class="menu-item visually-hidden" id="menu_doc_upload">

                        <a href="/document_upload" class="menu-link ">

                            <i class="menu-icon fas fa-paperclip"></i>

                            <div class="fw-bold">Upload Document</div>

                        </a>

                    </li>



                    {{-- <!-- Layouts -->

            <li class="menu-item active">

              <a href="javascript:void(0);" class="menu-link menu-toggle">

                <i class="menu-icon tf-icons bx bx-layout"></i>

                <div data-i18n="Layouts">HR</div>

              </a>



              <ul class="menu-sub">

                <li class="menu-item">

                  <a href="/employees" class="menu-link">

                    <div data-i18n="Without menu">Employees</div>

                  </a>

                </li>

                <li class="menu-item">

                  <a href="/manage_emp" class="menu-link">

                    <div data-i18n="Without menu">Manage Employees</div>

                  </a>

                </li>

              </ul>

            </li> --}}

                </ul>

            </aside>

            <!-- / Menu -->



            <!-- Layout container -->

            <div class="layout-page">

                <!-- Navbar -->



                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">

                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">

                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">

                            <i class="bx bx-menu bx-sm"></i>

                        </a>

                    </div>



                    <div class="navbar-nav-right d-flex align-items-center " id="navbar-collapse">

                        <!-- Search -->

                        <div class="navbar-nav align-items-center">

                            <div class="nav-item d-flex align-items-center">

                                {{-- <i class="fas fa-address-book fa-2x"></i> --}}

                                <input type="hidden" id="temp_emp_id" value={{ Session::get('temp_employee')->id}}>

                                <h4 class="mt-2 mb-2 d-none d-md-block"><span id="greetings"></span> <b>{{Session::get('temp_employee')->username}}</b></h4>

                            </div>

                        </div>

                        <!-- /Search -->



                        <ul class="navbar-nav flex-row align-items-center ms-auto">

                            <li class="nav-item navbar-dropdown dropdown-user dropdown me-3 me-md-2">

                                <a class="nav-link dropdown-toggle hide-arrow position-relative" data-bs-toggle="dropdown">

                                    <i class="fas fa-bell fa-2x mt-1 text-success"></i>

                                    <span class="position-absolute top-2 start-100  translate-middle badge rounded-pill bg-danger" id="notification_count">

                                        0

                                        {{-- <span class="visually-hidden">unread messages</span> --}}

                                    </span>

                                </a>

                                <ul class="dropdown-menu dropdown-menu-end p-2">

                                    <ul class="list-group list-group-flush" id="notification_placeholder" style="height:170px;overflow:auto;">



                                    </ul>

                                    <li class="list-group-item border-0 text-center bg-transparent" aria-current="true" style="margin: -14px;"><a href="/all_temp_emp_notification">View all</a></li>

                                </ul>

                            </li>

                            <!-- User -->

                            <li class="nav-item navbar-dropdown dropdown-user dropdown">

                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">

                                    <div class="avatar avatar-online">

                                        @if(Session::get('temp_employee')->gender == 'male')

                                        <img src="../img/male_avtar.png" alt class="bg-light w-px-40 h-auto rounded-circle" />

                                        @else

                                        <img src="../img/female_avtar.png" alt class="bg-light w-px-40 h-auto rounded-circle" />

                                        @endif

                                    </div>

                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">

                                    <li>

                                        <a class="dropdown-item" href="#">

                                            <div class="d-flex">

                                                <div class="flex-shrink-0 me-3">

                                                    <div class="avatar avatar-online">

                                                        @if(Session::get('temp_employee')->gender == 'male')

                                                        <img src="../img/male_avtar.png" alt class="bg-light w-px-40 h-auto rounded-circle" />

                                                        @else

                                                        <img src="../img/female_avtar.png" alt class="bg-light w-px-40 h-auto rounded-circle" />

                                                        @endif

                                                    </div>

                                                </div>

                                                <div class="flex-grow-1">

                                                    <span class="fw-bold d-block mt-2">{{Session::get('temp_employee')->username}}</span>

                                                    {{-- <small class="text-muted">Admin</small> --}}

                                                </div>

                                            </div>

                                        </a>

                                    </li>

                                    {{-- <li>

                                        <div class="dropdown-divider"></div>

                                    </li> --}}

                                    {{-- <li>

                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#temp_emp_profile">

                                            <i class="bx bx-user me-2"></i>

                                            <span class="align-middle">My Profile</span>

                                        </a>

                                    </li> --}}

                                    <li>

                                        <div class="dropdown-divider"></div>

                                    </li>

                                    <li>

                                        <a class="dropdown-item" href="/temp_emp_logout">

                                            <i class="fas fa-power-off me-2 align-middle"></i>

                                            <span class="fw-bold">Log Out</span>

                                        </a>

                                    </li>

                                </ul>

                            </li>

                            <!--/ User -->

                        </ul>

                    </div>

                </nav>



                <!-- / Navbar -->



                <!-- Content wrapper -->

                <div class="content-wrapper">

                    <!-- Content -->

                    @yield('Page_contents')



                    {{-- <!-- Footer -->

                    <footer class="content-footer footer bg-footer-theme">

                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">

                            <div class="mb-2 mb-md-0">

                                ©

                                <script>

                                    document.write(new Date().getFullYear());



                                </script>

                                , made with ❤️ by

                                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">HR</a>

                            </div>

                        </div>

                    </footer>

                    <!-- / Footer --> --}}



                    <div class="content-backdrop fade"></div>

                </div>

                <!-- Content wrapper -->

            </div>

            <!-- / Layout page -->

        </div>



        <!-- Overlay -->

        <div class="layout-overlay layout-menu-toggle"></div>

    </div>

    <!-- / Layout wrapper -->





    <!-- build:js assets/vendor/js/core.js -->

    <script src="../assets/vendor/libs/jquery/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- <script src="../assets/vendor/libs/popper/popper.js"></script>

    <script src="../assets/vendor/js/bootstrap.js"></script> --}}

    <script src="../assets/vendor/js/bootstrap.budle.js"></script>

    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <!-- Select2 -->

    <script src="../plugins/select2/js/select2.full.min.js"></script>

    <!-- SweetAlert2 -->

    <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>

    <!-- Toastr -->

    <script src="../plugins/toastr/toastr.min.js"></script>

    <!-- DataTables  & Plugins -->

    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>

    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>



    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->



    <!-- Vendors JS -->



    <!-- Main JS -->

    <script src="../assets/js/main.js"></script>



    <!-- Page JS -->



    <!-- Place this tag in your head or just before your close body tag. -->

    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- Core JS -->

    <script src="..\assets\js\pages\temp_emp_template.js"></script>

    <script>

    </script>

    @yield('Js_contents')

</body>

</html>

