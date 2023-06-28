@extends('Layout.emp_login_template')
@section('emp_login_contents')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="index.html" class="app-brand-link gap-2 h1">
                            {{-- <img src="http://hris.diptodiagnostic.com/dist/img/icon_title3.png" class="rounded-circle" height="40px" width="40px" alt=""> --}}
                            <span class="app-brand-text  fw-bolder ms-2 fs-4">HRMS</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Welcome to HRMS 👋</h4>
                    <p class="mb-4">Please sign-in to your account</p>

                    <form id="formAuthentication" class="needs-validation mb-3" action="/authenticate_emp" method="POST" novalidate>
                     @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email or Username</label>
                            <input type="text" class="form-control" name="emp_username" id="emp_username" required placeholder="Enter Your  Username">
                            <div class="invalid-feedback">
                                Please Provide Username
                            </div>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                                <a href="auth-forgot-password-basic.html">
                                    <small>Forgot Password?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" name="emp_pass" id="emp_pass" required>
                                
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                <div class="invalid-feedback">
                                    Please Provide Password
                                </div>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        {{-- <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" />
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                        </div> --}}
                        <div class="mb-3">
                            <button class="btn btn-primary float-right w-100" type="submit"> <i class="fas fa-sign-in-alt"></i> Login</button>
                        </div>
                    </form>

                    <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="auth-register-basic.html">
                            <span>Create an account</span>
                        </a>
                    </p>
                    <script>
                        // Example starter JavaScript for disabling form submissions if there are invalid fields
                        (function() {
                            'use strict';
                            window.addEventListener('load', function() {
                                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                var forms = document.getElementsByClassName('needs-validation');
                                // Loop over them and prevent submission
                                var validation = Array.prototype.filter.call(forms, function(form) {
                                    form.addEventListener('submit', function(event) {
                                        if (form.checkValidity() === false) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                        }
                                        form.classList.add('was-validated');
                                    }, false);
                                });
                            }, false);
                        })();

                    </script>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>
@endsection
