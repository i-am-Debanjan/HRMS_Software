@extends('Layout.template')

@section('Page_contents')

<!-- Main content -->

<div class="content">

    <div class="container-fluid">

        <div class="row mb-3 mt-2">

            <div class="col-md-6 col-sm-12  me-auto">

                <h4 class="mb-2 mt-2 ms-2 fw-bold"><i class="fas fa-chalkboard"></i> Manage Departments</h4>

            </div>

            <div class="col-md-3 col-sm-12  ms-auto">

                <button class="btn btn-info mt-2 fw-bold  float-end" data-bs-toggle="collapse" data-bs-target="#create_department_collapse" role="button">
                    <i class="fas fa-plus-circle "></i> Add Department
                </button>

            </div>

        </div>

        <div class="collapse" id="create_department_collapse">

            <div class="row mt-2 mb-2">

                {{-- <div class="card-header bg-transparent border-0"> --}}



                {{-- </div> --}}

                <div class="col-md-12">

                    <div class="card card-body bg-light">
                        <h4 class="fw-bold"> <i class="fas fa-plus-circle"></i> Create Department</h4>

                        <form class="" id="create_department_form" action="/create_department" method="POST" novalidate>

                            @csrf

                            <div class="row mt-2 mb-2">

                                <div class="form-group col-md-6">

                                    <label for="inputEmail4" class="fw-bold"> <i class="fas fa-pencil-alt"></i> Department

                                        Name</label>

                                    <input type="text" class="form-control" id="inputEmail4" name="department_name" autocomplete="off" required>

                                    <div class="valid-feedback">

                                        Looks good!

                                    </div>

                                    <div class="invalid-feedback">

                                        Please Provide a Department Name

                                    </div>

                                </div>

                                <div class="form-group col-md-6">

                                    <label for="inputPassword4" class="fw-bold"> <i class="fas fa-user-graduate"></i> Head of

                                        Department</label>



                                    <select class="form-select" id="inputGroupSelect01">

                                        <option selected>Choose...</option>



                                        {{-- @foreach ($all_department as $department)

                                                    <option value="{{ $department->id }}">{{ $department->name }}

                                        </option>

                                        @endforeach --}}

                                    </select>

                                </div>

                            </div>



                            <button type="submit" class="btn btn-primary float-right" id="create_department_btn"><i class="fas fa-plus-circle"></i>

                                Create</button>

                        </form>

                    </div>

                </div>

            </div>

            <!-- /.row1 -->

        </div>

        <div class="collapse" id="edit_department">

            <div class="row mt-2 mb-2">

                {{-- <div class="card-header bg-transparent border-0"> --}}


                {{-- </div> --}}

                <div class="col-md-12">

                    <div class="card card-primary card-outline card-body bg-light">

                        <h4 class="fst-italic fw-bold"> <i class="fas fa-edit"></i> Edit Department</h4>
                        <form class="" id="edit_department_form" action="/update_department" method="POST" novalidate>

                            @csrf

                            <div class="row mt-2 mb-2">

                                <input type="hidden" id="e_department_id" name="e_department_id">

                                <div class="form-group col-md-6">

                                    <label for="inputEmail4"> <i class="fas fa-pencil-alt"></i> Department

                                        Name</label>

                                    <input type="text" class="form-control" id="e_department_name" name="e_department_name" autocomplete="off" required>

                                    <div class="valid-feedback">

                                        Looks good!

                                    </div>

                                    <div class="invalid-feedback">

                                        Please Provide a Department Name

                                    </div>

                                </div>

                                <div class="form-group col-md-6">

                                    <label for="inputPassword4"> <i class="fas fa-user-graduate"></i> Head of

                                        Department</label>



                                    <select class="form-select" id="inputGroupSelect01">

                                        <option selected>Choose...</option>



                                        {{-- @foreach ($all_department as $department)

                                                    <option value="{{ $department->id }}">{{ $department->name }}

                                        </option>

                                        @endforeach --}}

                                    </select>

                                </div>

                            </div>



                            <button type="submit" class="btn btn-primary float-right" id="edit_department_btn"><i class="fas fa-file-upload"></i>

                                Update</button>

                        </form>

                    </div>

                </div>

            </div>

            <!-- /.row1 -->

        </div>

        <div class="row">

            <div class="col-12">

                <div class="card card-body">

                    <div class=" table-responsive">

                        <table id="example2" class="table table-bordered table-hover text-center">

                            <thead>

                                <tr class="table-primary">

                                    <th>ID</th>

                                    <th>Name</th>

                                    <th>Head of Department</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($department_details as $department)

                                <tr>

                                    <td>{{ $department->id }}</td>

                                    <td>{{ $department->name }}</td>

                                    <td>

                                        @if ($department->hod_id == '')

                                        <span class="text-danger font-weight-bold"> Not Assigned </span>

                                        @else

                                        {{ $department->hod_id }}

                                        @endif

                                    </td>

                                    <td>

                                        <button class="btn btn-info btn-sm fas fa-edit rounded-circle" data-bs-toggle="collapse" data-bs-target="#edit_department" role="button" onclick="edit_department({{$department->id}},'{{$department->name}}')"></button>

                                        <button class="btn btn-danger btn-sm fas fa-trash-alt rounded-circle"></button>

                                    </td>

                                </tr>

                                @endforeach

                        </table>

                    </div>

                    <!-- /.card-body -->

                </div>

                <!-- /.card -->

            </div>

            <!-- /.col -->

        </div>

        <!-- /.row2 -->

    </div>

    <!-- /.container-fluid -->

</div>

<!-- /.content -->

@endsection

@section('Js_contents')

<script>
    (function() {

        'use strict';

        window.addEventListener('load', function() {

            var create_department_form = $('#create_department_form');

            var edit_department_form = $('#edit_department_form');

            // Loop over them and prevent submission

            var create_department_validation = Array.prototype.filter.call(create_department_form, function(

                form) {

                form.addEventListener('submit', function(event) {



                    if (form.checkValidity() === false) {

                        event.preventDefault();

                        event.stopPropagation();

                    } else {

                        $('#create_department_btn').html('');

                        $('#create_department_btn').attr('disabled', true);

                        $('#create_department_btn').html(

                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating...'

                        );

                    }

                    form.classList.add('was-validated');

                }, false);

            });

            var edit_department_validation = Array.prototype.filter.call(edit_department_form, function(

                form) {

                form.addEventListener('submit', function(event) {



                    if (form.checkValidity() === false) {

                        event.preventDefault();

                        event.stopPropagation();

                    } else {

                        $('#edit_department_btn').html('');

                        $('#edit_department_btn').attr('disabled', true);

                        $('#edit_department_btn').html(

                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...'

                        );

                    }

                    form.classList.add('was-validated');

                }, false);

            });

        }, false);

    })();



    function edit_department(id, name) {

        $('#e_department_id').val(id);

        $('#e_department_name').val(name);

    }

    $('#hr_settings').addClass('active');

    $('#hr_settings').addClass('open');

    $('#hr_settings_departments').addClass('active');

</script>

@endsection
