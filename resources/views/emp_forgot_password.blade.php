@extends('Layout.account_locked_template')
@section('locked_contents')
<!-- Error -->
<div class="container-xxl container-p-y">
    <center>
        <div class="misc-wrapper">
            <h1 class="mb-2 mt-5 text-danger fw-bold">Forgot your password?</h1>
            <p class="mb-1  fw-bold">Not to worry, Please contact HR to get you a new password.<br>
            <a href="mailto:hr@diptodiagnostic.com?subject=Forgot Login Password&body=I forgot my login password please give me a new password" class="btn btn-success mt-2 fw-bold"><i class="fas fa-envelope"></i> Mail HR</a></p>
            <div class="">
                <img src="{{asset('img/forget_password_png.jpg')}}"  width="500" class="img-fluid"/>
            </div>
            <a href="/temp_emp_login" class="btn btn-danger mt-2 me-1"><i class="fas fa-reply"></i> Back to Login</a>
        </div>
    </center>
</div>
@endsection
