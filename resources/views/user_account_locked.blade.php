@extends('Layout.account_locked_template')
@section('locked_contents')
<!-- Error -->
<div class="container-xxl container-p-y">
    <center>
        <div class="misc-wrapper">
            <h1 class="mb-2 mt-5 text-danger fw-bold">Your Account Locked</h1>
            <p class="mb-4  fw-bold">Please Contact HR</p>
            <div class="mt-3">
                <img src="../img/Account_locked.png" alt="page-misc-error-light" width="500" class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.png" data-app-light-img="illustrations/page-misc-error-light.png" />
            </div>
            <a href="/temp_emp_login" class="btn btn-danger mt-2"><i class="fas fa-reply"></i> Back to Login</a>
        </div>
    </center>
</div>
@endsection
