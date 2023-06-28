@extends('Layout.template')

@section('Page_contents')

<?php date_default_timezone_set("Asia/Calcutta");?>

<!-- Main content -->

<div class="content">

    <div class="container-fluid">

        <div class="row mt-2 mb-2">

            <div class="col-md-12 d-flex flex-md-row flex-column flex-wrap">
                <div class="p-1">

                    <button class="btn btn-primary fw-bold p-2 rounded-pill" role="button"> <i class="fas fa-users"></i> Total Employee : <span id="count_all_emp" class="visually-hidden">{{count($all_employees)}}</span><span id="count_all_emp_p">0</span>

                    </button>

                </div>
                <div class="p-1">

                    <button class="btn btn-warning fw-bold p-2 ms-0 ms-md-2 rounded-pill" role="button"> <i class="fas fa-users"></i> Total Temporary Employee : <span id="count_all_temp_emp" class="visually-hidden">{{count($temp_employees)}}</span><span id="count_all_temp_emp_p">0</span>

                    </button>

                </div>

                <div class="p-1 ms-auto">

                    <button class="btn btn-success fw-bold p-2 rounded-pill" data-bs-toggle="collapse" data-bs-target="#add_temp_employee_collapse" role="button"> <i class="fas fa-user-plus"></i> Add Temporary Employee

                    </button>

                </div>
            </div>

        </div>

        <div class="collapse" id="add_temp_employee_collapse">

            <div class="row mt-2 mb-2">

                {{-- <div class="card-header bg-transparent border-0"> --}}

                {{-- </div> --}}

                <div class="col-md-12">

                    <div class="card  card-body">

                        <h5 class=" fw-bold"> <i class="fas fa-plus-circle"></i> Create Temporary Employee</h5>

                        <form class="" id="create_temp_employee_form" action="/create_temp_employee" method="POST" novalidate>

                            @csrf

                            <div class="row">

                                <div class="col-md-6 p-2">

                                    <label for="employee_email" class="fw-bold"><i class="fas fa-at"></i> Email<span class="text-danger">*</span></label>

                                    <input type="email" class="form-control" name="temp_employee_email" placeholder="Enter Employee Email" autocomplete="off" required>

                                    <div class="valid-feedback">

                                        Looks good!

                                    </div>

                                    <div class="invalid-feedback">

                                        Please Provide Employee Email

                                    </div>

                                </div>

                                <div class="col-md-6 p-2">

                                    <label for="login_username" class="fw-bold" id="username_span"><i class="fas fa-user-edit"></i>

                                        Full Name<span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" id="temp_login_username" name="temp_login_username" autocomplete="off" placeholder="Enter Full name" required>

                                    <div class="valid-feedback">

                                        Looks good!

                                    </div>

                                    <div class="invalid-feedback">

                                        Please Provide Employee Name

                                    </div>

                                </div>

                                <div class="col-md-6 p-2">

                                    <label for="mobile_no" class="fw-bold" id="username_span"><i class="fas fa-mobile"></i>

                                        Mobile No<span class="text-danger">*</span></label>

                                    <input type="tel" class="form-control" pattern="[0-9]{10}" id="mobile_no" name="mobile_no" placeholder="Enter Mobile Number" autocomplete="off" required>

                                    <div class="valid-feedback">

                                        Looks good!

                                    </div>

                                    <div class="invalid-feedback">

                                        Please Provide Mobile No

                                    </div>

                                </div>

                                <div class="col-md-6 p-2">

                                    <label for="gender" class="fw-bold" id="username_span"><i class="fas fa-venus-mars"></i>

                                        Select Gender<span class="text-danger">*</span></label>

                                    <select class="form-select" id="gender" name="gender" autocomplete="off" required>

                                        <option value="">Select Gender</option>

                                        <option value="male">Male</option>

                                        <option value="female">Female</option>

                                        <option value="others">Others</option>

                                    </select>

                                    <div class="valid-feedback">

                                        Looks good!

                                    </div>

                                    <div class="invalid-feedback">

                                        Please Provide Gender

                                    </div>

                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary float-end float-md-start" id="create_temp_employee_btn"><i class="fas fa-plus-circle"></i>

                                Create</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        <!-- /.row1 -->
        <div class="accordion mt-1 " id="accordionemp_list" tabindex="-1">
            <div class="card accordion-item ">
                <button type="button" class="accordion-button collapsed fs-4 fw-bold text-white bg-primary" data-bs-toggle="collapse" data-bs-target="#list_of_emp_accordion" aria-expanded="false" aria-controls="list_of_emp_accordion">
                    <i class="fas fa-user-tie"></i><span class="ms-2 mt-1">List of Employees</span>
                </button>

                <div id="list_of_emp_accordion" class="accordion-collapse collapse" data-bs-parent="#accordionemp_list">
                    <div class="accordion-body table-responsive">
                        <table id="employee_list_table" class=" table  table-hover text-center table-sm">

                            <thead class="thead-light">

                                <tr>

                                    <th class="fw-bold">ID</th>

                                    <th class="fw-bold">Name</th>

                                    <th class="fw-bold">Department</th>

                                    <th class="fw-bold">Email</th>

                                    <th class="fw-bold">Mobile / Emergency</th>

                                    <th class="fw-bold">Status</th>

                                    <th class="fw-bold">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($all_employees as $employee)

                                <tr>

                                    <td>{{ $employee->employee_id }}</td>

                                    <td>{{ $employee->f_name }} {{ $employee->l_name }}</td>

                                    <td>{{ $employee->department_name }}</td>

                                    <td>{{ $employee->email }}</td>

                                    <td>{{ $employee->phone_number }} / <span class="text-danger">{{ $employee->emergency_number }}</span></td>

                                    <td>

                                        @if ($employee->status == '1')

                                        <span class="btn btn-sm btn-info font-weight-bold">Probation</span>

                                        @elseif($employee->status == '2')

                                        <span class="btn btn-sm btn-success font-weight-bold">Confirmed</span>

                                        @elseif($employee->status == '3')

                                        <span class="btn btn-sm btn-success font-weight-bold">Confirmed</span>

                                        @endif

                                    </td>

                                    <td>

                                        <a href="/manage_emp?id={{ Crypt::encrypt($employee->employee_id )}}"><button class="btn btn-info btn-sm fas fa-edit rounded-circle mt-1 mb-1"></button></a>

                                    </td>

                                </tr>

                                @endforeach

                        </table>
                    </div>
                </div>
            </div>
            <div class="card accordion-item">
                <button type="button" class="accordion-button collapsed fs-4 fw-bold text-white bg-warning" data-bs-toggle="collapse" data-bs-target="#temp_emp_list_accordion" aria-expanded="false" aria-controls="temp_emp_list_accordion">
                    <i class="fas fa-user-tie"></i><span class="ms-2 mt-1">List of Temp. Employees</span>
                </button>

                <div id="temp_emp_list_accordion" class="accordion-collapse collapse" data-bs-parent="#accordionemp_list" style="">
                    <div class="accordion-body table-responsive">
                        <table id="temp_employee_list_table" class="table table-light text-center table-sm">

                            <thead class="thead-dark">

                                <tr>

                                    <th class="fw-bold">ID</th>

                                    <th class="fw-bold">Email</th>

                                    <th class="fw-bold">Name</th>

                                    <th class="fw-bold">Valid Till</th>

                                    <th class="fw-bold">Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($temp_employees as $temp_employee)

                                @if(time()>=$temp_employee->valid_till)

                                <tr>

                                    <td class="bg-danger text-white fw-bold">{{ $temp_employee->id }}</td>

                                    <td class="bg-danger text-white fw-bold">{{ $temp_employee->email }}</td>

                                    <td class="bg-danger text-white fw-bold">{{ $temp_employee->username }}</td>

                                    <td class="bg-danger text-white fw-bold">{{ date('d/m/Y H:i A',$temp_employee->valid_till) }}</td>

                                    <td class="bg-danger text-white fw-bold">

                                        <a href="/manage_temp_emp?id={{ Crypt::encrypt($temp_employee->id) }}" class="btn  rounded-pill btn-icon btn-sm btn-info text-white mt-1 mb-1" title="Edit Employee"> <i class="fas fa-edit"></i></a>

                                        {{-- <button class="btn btn-success btn-sm  rounded-circle mt-1 mb-1"></button> --}}
                                        <button type="button" class="btn rounded-pill btn-icon btn-sm btn-warning text-white" title="Extend Time" data-bs-toggle="modal" data-bs-target="#extend_time_modal" onclick="open_extend_time_modal({{$temp_employee->id}})">
                                            <span class="fas fa-hourglass-half"></span>
                                        </button>
                                        {{-- <button class="btn btn-outline-danger btn-sm  rounded-circle mt-1 mb-1" title="Send Mail"><i class="fas fa-paper-plane"></i></button> --}}
                                    </td>

                                </tr>

                                @else

                                <tr>

                                    <td>{{ $temp_employee->id }}</td>

                                    <td>{{ $temp_employee->email }}</td>

                                    <td>{{ $temp_employee->username }}</td>

                                    <td>{{ date('d/m/Y H:i A',$temp_employee->valid_till) }}</td>

                                    <td>

                                        <a href="/manage_temp_emp?id={{ Crypt::encrypt($temp_employee->id) }}" class="btn  rounded-pill btn-icon btn-sm btn-outline-info mt-1 mb-1" title="Edit Employee"> <i class="fas fa-edit"></i></a>

                                        {{-- <button class="btn btn-success btn-sm  rounded-circle mt-1 mb-1"></button> --}}
                                        <button type="button" class="btn rounded-pill btn-icon btn-sm btn-outline-warning" title="Extend Time" data-bs-toggle="modal" data-bs-target="#extend_time_modal" onclick="open_extend_time_modal({{$temp_employee->id}})">
                                            <span class="fas fa-hourglass-half"></span>
                                        </button>
                                        {{-- <button class="btn btn-outline-danger btn-sm  rounded-circle mt-1 mb-1" title="Send Mail"><i class="fas fa-at"></i></button> --}}

                                    </td>

                                </tr>

                                @endif

                                @endforeach

                        </table>
                    </div>
                </div>
            </div>

        </div>


        <div class="modal fade" id="extend_time_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title" id="exampleModalLabel">Extend Time</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <div class="modal-body">

                        <form class="row" action="/extend_temp_emp_time" method="post">

                            @csrf

                            <div id="extend_time_modal_placeholder"></div>

                        </form>

                    </div>

                    {{-- <div class="modal-footer">

                        <button type="button" class="btn btn-danger fw-bold" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Close</button>

                        <button type="button" class="btn btn-success fw-bold"><i class="fas fa-check-circle"></i> Confirm</button>

                    </div> --}}

                </div>

            </div>

        </div>

        <!--Notification Modal -->

        <div class="modal fade" id="notification_details_modal" tabindex="-1" aria-labelledby="notification_details_modal" aria-hidden="true">

            <div class="modal-dialog">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title" id="exampleModalLabel">Extend Time</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <div class="modal-body" id="notification_details_placeholder">



                    </div>

                    {{-- <div class="modal-footer">

                        <button type="button" class="btn btn-danger fw-bold" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Close</button>

                        <button type="button" class="btn btn-success fw-bold"><i class="fas fa-check-circle"></i> Confirm</button>

                    </div> --}}

                </div>

            </div>

        </div>

    </div>

    <!-- /.container-fluid -->



</div>

@endsection

@section('Js_contents')

<script src="{{ asset('assets\js\pages\employee.js') }}"></script>

@endsection
