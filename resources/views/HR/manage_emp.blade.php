@extends('Layout.template')
@section('Page_contents')
<?php use Illuminate\Support\Facades\Hash; ?>
<!-- Content Wrapper. Contains page content -->


<!-- Main content -->
<div class="content">
@if(!app('request')->input('id')=="")
<input type="hidden" id="url_id" value="{{decrypt(app('request')->input('id'))}}"/>

@endif
    <div class="container-fluid">
        <div class="row mb-3 mt-2">
            <div class="col-md-6 col-sm-12  me-auto">
                <h3 class="m-0 mt-2 ms-2"><i class="fas fa-address-book"></i>Manage Employees</h3>
            </div>
            <div class="col-md-4 col-sm-12  ms-auto">
                <select class="form-select" id="emp_select">
                    <option value="">Select Employee</option>
                    @foreach ($all_employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->f_name }} {{ $employee->l_name }}
                    </option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="row mb-2">
            {{-- <div class="col-md-2 p-2 mt-2">
                        <select class="form-select" id="emp_select">
                            <option value="">Select Employee</option>
                            @foreach ($all_employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->f_name }} {{ $employee->l_name }}
            </option>
            @endforeach

            </select>
        </div> --}}
        <div class="col-md-12 d-flex flex-md-row flex-column flex-wrap">
            {{-- <div class="p-2">
                            <select class="form-select" id="emp_select">
                                <option value="">Select Employee</option>
                                @foreach ($all_employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->f_name }} {{ $employee->l_name }}
            </option>
            @endforeach

            </select>
        </div> --}}
        <div class="p-1">
            <button class="btn  btn-warning fw-bold" data-bs-toggle="collapse" data-bs-target="#assign_leader" role="button"><i class="fas fa-user-plus"></i> Assign Leader</button>
        </div>
        <div class="p-1">
            <button class="btn  btn-success fw-bold" data-bs-toggle="collapse" data-bs-target="#add_emp_docs" role="button"><i class="fas fa-folder-plus"></i> Add Document</button>
        </div>
        <div class="p-1">
            <button class="btn  btn-success fw-bold" data-bs-toggle="collapse" data-bs-target="#view_emp_docs" role="button"><i class="fas fa-folder-open"></i> View Document</button>
        </div>
        {{-- <div class="p-1">
            <button class="btn  btn-primary" data-bs-toggle="collapse" data-bs-target="#assign_emp_leave" role="button"><i class="fas fa-user-cog"></i> Assign Leave</button>
        </div> --}}
        <div class="p-1">
            <button class="btn  btn-info fw-bold"><i class="fas fa-envelope"></i> Send Letter</button>
        </div>
        {{-- <div class="p-1">
            <button class="btn  btn-dark"><i class="fas fa-eye"></i> View Attandence</button>
        </div>
        <div class="p-1">
            <button class="btn  btn-secondary"><i class="fas fa-file-invoice"></i> Pay Slip</button>
        </div> --}}
        <div class="p-1">
            <button class="btn  btn-danger fw-bold"><i class="fas fa-sync-alt"></i> Reset Password</button>
        </div>

    </div>
</div>
{{-- Assign Leader --}}
<div class="collapse" id="assign_leader">
    <div class="row mb-2">
        <div class="col-md-12">
            {{-- <div class="card-header bg-transparent border-0"> --}}
            <h3> <i class="fas fa-user-plus"></i> Assign Leader</h3>
            {{-- </div> --}}
            <div class="card card-warning card-outline card-body bg-light">
                <form class="" id="assign_leaders_form" action="/assign_leaders" method="POST" novalidate>
                    @csrf
                    <input type="hidden" name="emp_id" id="emp_id_leader_hidden">
                    <div class="row">
                        <div class="col-md-4 p-2">
                            <label for="select_l1"> <i class="fas fa-user-tag"></i> Select L1</label>
                            <select class="form-select" id="select_l1" name="selected_l1">
                                <option value="">Select L1</option>
                                @foreach ($all_employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->f_name }}
                                    {{ $employee->l_name }}
                                </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-4 p-2">
                            <label for="select_l2"> <i class="fas fa-user-tag"></i> Select L2</label>
                            <select class="form-select" id="select_l2" name="selected_l2">
                                <option value="">Select L2</option>
                                @foreach ($all_employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->f_name }}
                                    {{ $employee->l_name }}
                                </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-md-4 p-2">
                            <label for="select_l3"> <i class="fas fa-user-tag"></i> Select L3</label>
                            <select class="form-select" id="select_l3" name="selected_l3">
                                <option value="">Select L3</option>
                                @foreach ($all_employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->f_name }}
                                    {{ $employee->l_name }}
                                </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info float-right fw-bold" id="assign_leader_btn">
                        <i class="fas fa-user-plus"></i>
                        Assign</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- /Assign Leader --}}
{{-- Add_docs --}}
<div class="collapse" id="add_emp_docs">
    <div class="row mb-2">
        {{-- <div class="card-header bg-transparent border-0"> --}}
        <h3> <i class="fas fa-folder-plus"></i> Add Document</h3>
        {{-- </div> --}}
        <div class="col-md-12">
            <div class="card card-success card-outline card-body bg-light">

            </div>
        </div>
    </div>
</div>
{{-- /Add_view_docs --}}
{{-- View_docs --}}
<div class="collapse" id="view_emp_docs">
    <div class="row  mb-2">
        {{-- <div class="card-header bg-transparent border-0"> --}}
        <h3> <i class="fas fa-folder-open"></i> View Document</h3>
        {{-- </div> --}}
        <div class="col-md-12">
            <div class="card card-success card-outline card-body bg-light">

            </div>
        </div>
    </div>
</div>
{{-- /View_docs --}}
{{-- Assign_emp_Leave --}}
<div class="collapse " id="assign_emp_leave">
    <div class="row mb-2">
        {{-- <div class="card-header bg-transparent border-0"> --}}
        <h3> <i class="fas fa-folder-open"></i> Asign Employee Leave</h3>
        {{-- </div> --}}
        <div class="col-md-12">
            <div class="card card-primary card-outline card-body bg-light">

            </div>
        </div>
    </div>
</div>
{{-- /Assign_emp_Leave --}}
<div class="row">
    <div class="col-md-12">

        <div class="card card-primary card-outline card-body bg-light">
            <form class="" id="create_employee_form" action="/create_employee" method="POST" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-3 p-2">
                        <label for="f_name"> <i class="fas fa-user-edit"></i> First Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="f_name" id="f_name" autocomplete="off" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please Provide Employee First Name
                        </div>
                    </div>
                    <div class="col-md-3 p-2">
                        <label for="l_name"> <i class="fas fa-user-edit"></i> Last Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="l_name" id="l_name" autocomplete="off" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please Provide Employee Last Name
                        </div>
                    </div>
                    <div class="col-md-3 p-2">
                        <label for="employee_email"><i class="fas fa-at"></i> Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="employee_email" id="employee_email" autocomplete="off" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Please Provide Employee Email
                        </div>
                    </div>
                    <div class="col-md-3 p-2">
                        <label for="login_username" id="username_span"><i class="fas fa-user-cog"></i> Login
                            Username<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="login_username" name="login_username" autocomplete="off" required onkeyup="checking_username()">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 p-2">
                        <label for="employee_ph"><i class="fas fa-mobile-alt"></i> Phone Number<span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" name="employee_ph" id="employee_ph" autocomplete="off" pattern="[0-9]{10}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Example:1234567890
                        </div>
                    </div>
                    <div class="col-md-2 p-2">
                        <label for="employee_emergency_ph"><i class="fas fa-phone-volume"></i> Emergency
                            Number<span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" name="employee_emergency_ph" id="employee_emergency_ph" autocomplete="off" pattern="[0-9]{10}" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Example:1234567890
                        </div>
                    </div>
                    <div class="col-md-4 p-2">
                        <label for="f_name"><i class="fas fa-address-card"></i> Select
                            Designation</label>
                        <select class="form-select" id="select_designation" name="selected_designation">
                            <option selected>Select Designation</option>

                            @foreach ($all_designation as $designation)
                            <option value="{{ $designation->id }}">{{ $designation->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 p-2">
                        <label for="l_name"><i class="fas fa-chalkboard-teacher"></i> Select
                            Department</label>
                        <select class="form-select" id="select_department" name="selected_department">
                            <option selected>Select Department</option>

                            @foreach ($all_department as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div class="row">
                                   
                                </div> --}}
                <div class="row">
                    <div class="col-md-2 p-2">
                        <label for="f_name"><i class="fas fa-calendar-check"></i> Joining Date<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="employee_joining_date" id="employee_joining_date" autocomplete="off" required>

                    </div>
                    <div class="col-md-2 p-2">
                        <label for="f_name"><i class="fas fa-calendar-check"></i> Confirm Date<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="employee_joining_date" id="employee_joining_date" autocomplete="off" required>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right fw-bold" id="update_employee_btn">
                    <i class="fas fa-file-upload"></i>
                    Update</button>
            </form>
        </div>
    </div>
</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('Js_contents')
<script src="{{ asset('assets\js\pages\manage_employee.js') }}"></script>
@endsection
