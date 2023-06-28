@extends('Layout.template')

@section('Page_contents')
<style>
    .test_btn {

        display: block;
        height: 300px;
        width: 300px;
        border-radius: 50%;

    }

</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row mb-5 mt-2">
        <div class="col-md-6  mb-3">
            <div class="card p-4">
                <center>
            <span class="h4 fw-bold">Total Employees</span>
            <button type="button" class="btn btn-success btn-xl test_btn  mt-2 mt-md-3 fs-1 fw-bold">
                <span class="fas fa-users"></span> <span id="count_all_dash_emp" class="visually-hidden">100</span><span id="count_dash_emp">0</span>
            </button>
            </center>
            </div>
        </div>
        <div class="col-md-6  mb-3">
            <div class="card  p-4">
                <center>
            <span class="h4 fw-bold">Total Temporary Employees</span>
            <button type="button" class="btn btn-danger btn-xl test_btn  mt-2 mt-md-3 fs-1 fw-bold">
                <span class="fas fa-users"></span> <span id="count_all_dash_temp_emp" class="visually-hidden">100</span><span id="count_dash_temp_emp">0</span>
            </button>
            </center>
            </div>
        </div>
    </div>

</div>

@endsection

@section('Js_contents')

<script src="{{ asset('assets\js\pages\hr_dashboard.js') }}"></script>

@endsection
