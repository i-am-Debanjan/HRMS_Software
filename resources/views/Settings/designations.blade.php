@extends('Layout.template')

@section('Page_contents')

<!-- Content Wrapper. Contains page content -->

{{-- <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <div class="content-header">

            <div class="container-fluid">

                <div class="row mb-2">

                    <div class="col-6">

                        <h1 class="m-0"><i class="fas fa-chalkboard-teacher"></i> Designation</h1>

                    </div>

                    <!-- /.col -->

                    <div class="col-6">

                        <ol class="breadcrumb float-sm-right">

                            <li class="breadcrumb-item"><button class="btn btn-info" data-toggle="collapse"

                                    href="#create_designation_collapse" role="button"> <i class="fas fa-plus "></i> Add

                                    Designation </button></li>

                        </ol>

                    </div>

                    <!-- /.col -->

                </div>

                <!-- /.row -->

            </div>

            <!-- /.container-fluid -->

        </div>

        <!-- /.content-header --> --}}



<!-- Main content -->

<div class="content">

    <div class="container-fluid">

        <div class="row mb-3 mt-2">

            <div class="col-md-6 col-sm-12  me-auto">

                <h4 class="mb-2 mt-2 ms-2 fw-bold"><i class="fas fa-chalkboard"></i> Manage Designation</h4>

            </div>

            <div class="col-md-3 col-sm-12  ms-auto">

                <button class="btn btn-info fw-bold float-end" data-bs-toggle="collapse" data-bs-target="#create_designation_collapse" role="button"> <i class="fas fa-plus-circle "></i> Add

                    Designation </button>

            </div>

        </div>

        <div class="collapse" id="create_designation_collapse">

            <div class="row mt-2 mb-2">

                {{-- <div class="card-header bg-transparent border-0"> --}}

                {{-- </div> --}}

                <div class="col-md-12">

                    <div class="card card-body bg-light">

                        <h4 class="fw-bold"> <i class="fas fa-plus-circle"></i> Create Designation</h4>
                        <form class="" id="create_designation_form" action="/create_designation" method="POST" novalidate>

                            @csrf

                            <div class="row mt-2 mb-2">

                                <div class="form-group col-md-12">

                                    <label for="inputEmail4"> <i class="fas fa-pencil-alt"></i> Designation

                                        Name</label>

                                    <input type="text" class="form-control" name="designation_name" autocomplete="off" required>

                                    <div class="valid-feedback">

                                        Looks good!

                                    </div>

                                    <div class="invalid-feedback">

                                        Please Provide a Designation Name

                                    </div>

                                </div>

                            </div>



                            <button type="submit" class="btn btn-primary float-right" id="create_designation_btn"><i class="fas fa-plus-circle"></i>

                                Create</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        <!-- /.row1 -->

        <div class="collapse" id="edit_designation_collapse">

            <div class="row mt-2 mb-2">

                {{-- <div class="card-header bg-transparent border-0"> --}}

                <h3> <i class="fas fa-edit"></i> Edit Department</h3>

                {{-- </div> --}}

                <div class="col-md-12">

                    <div class="card card-primary card-outline card-body bg-light">

                        <form class="" id="edit_designation_form" action="/update_designation" method="get" novalidate>

                            @csrf

                            <div class="row mt-2 mb-2">

                                <div class="form-group col-md-12">

                                    <label for="inputEmail4"> <i class="fas fa-pencil-alt"></i> Designation

                                        Name</label>

                                    <input type="text" class="form-control" name="e_designation_name" autocomplete="off" required id="e_designation_name">

                                    <input type="hidden" class="form-control" name="e_designation_id" autocomplete="off" required id="e_designation_id">

                                    <div class="valid-feedback">

                                        Looks good!

                                    </div>

                                    <div class="invalid-feedback">

                                        Please Provide a Designation Name

                                    </div>

                                </div>

                            </div>



                            <button type="submit" class="btn btn-primary float-right" id="edit_designation_btn"><i class="fas fa-file-upload"></i>

                                Update</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        <!-- /.row2 -->

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-body table-responsive">

                        <table id="example2" class="table table-bordered table-hover">

                            <thead>

                                <tr class="table-primary">

                                    <th>ID</th>

                                    <th>Name</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($designation_details as $designation)

                                <tr>

                                    <td>{{ $designation->id }}</td>

                                    <td>{{ $designation->name }}</td>

                                    <td>

                                        <button class="btn btn-info btn-sm fas fa-edit rounded-circle" data-bs-toggle="collapse" data-bs-target="#edit_designation_collapse" role="button" onclick="edit_designation({{$designation->id}},'{{$designation->name}}')"></button>

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

        <!-- /.row4 -->

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

            var create_forms = $('#create_designation_form');

            var edit_forms = $('#edit_designation_form');

            // Loop over them and prevent submission

            var create_forms_validation = Array.prototype.filter.call(create_forms, function(form) {

                form.addEventListener('submit', function(event) {

                    if (form.checkValidity() === false) {

                        event.preventDefault();

                        event.stopPropagation();

                    } else {

                        $('#create_designation_btn').html('');

                        $('#create_designation_btn').attr('disabled', true);

                        $('#create_designation_btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating...');

                    }

                    form.classList.add('was-validated');

                }, false);

            });

            var edit_forms_validation = Array.prototype.filter.call(edit_forms, function(form) {

                form.addEventListener('submit', function(event) {

                    if (form.checkValidity() === false) {

                        event.preventDefault();

                        event.stopPropagation();

                    } else {

                        $('#edit_designation_btn').html('');

                        $('#edit_designation_btn').attr('disabled', true);

                        $('#edit_designation_btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...');

                    }

                    form.classList.add('was-validated');

                }, false);

            });

        }, false);

    })();



    function edit_designation(id, name) {

        $('#e_designation_id').val(id);

        $('#e_designation_name').val(name);

    }

    // $('#create_designation_btn').click(function(){

    //     console.log('deb');

    // });

    $('#hr_settings').addClass('active');

    $('#hr_settings').addClass('open');

    $('#hr_settings_designations').addClass('active');

</script>

@endsection
