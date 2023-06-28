@extends('Layout.template')

@section('Page_contents')

<!-- Main content -->

<div class="content">

    <div class="container-fluid">

        <div class="row mb-3 mt-2">

            <div class="col-md-6 col-sm-12  me-auto">

                <h5 class="m-0 mt-2 ms-2 fw-bold"><i class="fas fa-chalkboard"></i> Manage Document Categories</h5>

            </div>

            <div class="col-md-3 col-sm-12  ms-auto">

                <button class="btn btn-info btn-sm float-end mt-2 fw-bold" data-bs-toggle="collapse" data-bs-target="#create_doc_category_collapse" role="button"> <i class="fas fa-plus-circle "></i> Add

                    Document Category </button>

            </div>

        </div>

        <div class="collapse" id="create_doc_category_collapse">

            <div class="row mt-2 mb-2">

                {{-- <div class="card-header bg-transparent border-0"> --}}


                {{-- </div> --}}

                <div class="col-md-12">

                    <div class="card card-primary card-outline card-body bg-light">
                        <h5 class="fw-bold"> <i class="fas fa-plus-circle"></i> Create Document Category</h5>
                        <form class="" id="create_doc_category_form" action="/create_emp_doc_category" method="POST" novalidate>

                            @csrf

                            <div class="row mb-2">

                                <div class=" col-md-12 p-2">

                                    <label for="inputEmail4" class="fw-bold"> <i class="fas fa-pencil-alt"></i> Category Name

                                    </label>

                                    <input type="text" class="form-control" name="doc_category_name" autocomplete="off" required>

                                    <div class="valid-feedback">

                                        Looks good!

                                    </div>

                                    <div class="invalid-feedback">

                                        Please Provide a Category Name

                                    </div>

                                </div>

                                <div class=" col-md-12 p-2">

                                    <label for="inputEmail4" class="fw-bold"> <i class="fas fa-file-contract"></i> Category Content

                                    </label>

                                    <input type="text" class="form-control" name="doc_category_details" autocomplete="off">

                                    <div class="valid-feedback">

                                        Looks good!

                                    </div>

                                    <div class="invalid-feedback">

                                        Please Provide a Category Name

                                    </div>

                                </div>

                            </div>



                            <button type="submit" class="btn btn-primary float-right" id="create_doc_category_btn"><i class="fas fa-plus-circle"></i>

                                Create</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        <!-- /.row1 -->

        <div class="collapse mb-2" id="edit_doc_category_collapse">

            <div class="row">

                <div class="col-md-12">

                    <div class="card card-body bg-light">

                        <h5 class="fw-bold"> <i class="fas fa-edit"></i> Edit Category Name</h5>
                        <form class="row g-2" id="edit_doc_category_form" action="/update_doc_category" method="post" novalidate>

                            @csrf

                            <div class=" col-md-12">

                                <label for="inputEmail4" class="fw-bold"> <i class="fas fa-pencil-alt"></i> Category

                                    Name</label>

                                <input type="text" class="form-control" name="e_doc_category_name" autocomplete="off" required id="e_doc_category_name">

                                <input type="hidden" class="form-control" name="e_designation_id" autocomplete="off" required id="e_doc_category_id">

                                <div class="valid-feedback">

                                    Looks good!

                                </div>

                                <div class="invalid-feedback">

                                    Please Provide a Designation Name

                                </div>



                            </div>

                            <div class=" col-md-12">

                                <button type="submit" class="btn btn-primary float-right" id="edit_doc_category_btn"><i class="fas fa-file-upload"></i>

                                    Update</button>

                            </div>



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

                        <table id="example2" class="table table-bordered table-hover text-center">

                            <thead>

                                <tr class="table-primary">

                                    <th>ID</th>

                                    <th>Name</th>

                                    <th>Content</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($doc_categories_details as $doc_category)

                                <tr>

                                    <td>{{ $doc_category->id }}</td>

                                    <td>{{ $doc_category->doc_category_name}}</td>

                                    <td>{{ $doc_category->doc_category_details }}</td>

                                    <td>

                                        <button class="btn btn-info btn-sm fas fa-edit rounded-circle" data-bs-toggle="collapse" data-bs-target="#edit_doc_category_collapse" role="button" onclick="edit_doc_category({{$doc_category->id}},'{{$doc_category->doc_category_name}}')"></button>

                                        {{-- <button class="btn btn-danger btn-sm fas fa-trash-alt rounded-circle"></button> --}}

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

            var create_forms = $('#create_doc_category_form');

            var edit_forms = $('#edit_doc_category_form');

            // Loop over them and prevent submission

            var create_forms_validation = Array.prototype.filter.call(create_forms, function(form) {

                form.addEventListener('submit', function(event) {

                    if (form.checkValidity() === false) {

                        event.preventDefault();

                        event.stopPropagation();

                    } else {

                        $('#create_doc_category_btn').html('');

                        $('#create_doc_category_btn').attr('disabled', true);

                        $('#create_doc_category_btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating...');

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

                        $('#edit_doc_category_btn').html('');

                        $('#edit_doc_category_btn').attr('disabled', true);

                        $('#edit_doc_category_btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...');

                    }

                    form.classList.add('was-validated');

                }, false);

            });

        }, false);

    })();



    function edit_doc_category(id, name) {

        $('#e_doc_category_id').val(id);

        $('#e_doc_category_name').val(name);

    }

    // $('#create_designation_btn').click(function(){

    //     console.log('deb');

    // });

    $('#hr_settings').addClass('active');

    $('#hr_settings').addClass('open');

    $('#hr_settings_doc_categories').addClass('active');

</script>

@endsection
