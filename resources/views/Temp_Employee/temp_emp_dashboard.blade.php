@extends('Layout.temp_emp_template')

@section('Page_contents')

<!-- Content -->



<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">

        <div class="col-lg-12 mb-4 order-0">

            <div class="card">

                <div class="d-flex align-items-end row">

                    <div class="col-md-8">

                        <div class="card-body">

                            <h5 class="card-title text-primary"><i class="fas fa-door-open"></i> Welcome To HRMS Onboarding Portal

                                {{Session::get('temp_employee')->username}} <span class="fs-3">🎉</span></h5>

                            <p class="mb-2 fs-5">

                                Please complete all the requirement as requested<br>

                                <span class="fw-bold">Account will be Locked in : </span><br>

                                <span id="countDown" class="fs-md-2 fw-bold text-danger">

                                </span>

                            </p>



                            {{-- <p class="mb-4 fs-5">

                                <span class="badge bg-label-warning"><i class="fas fa-clock"></i> Waiting For Approval.......!</span>

                            </p> --}}

                        </div>

                    </div>

                    <div class="col-md-4 text-center text-sm-left">

                        <div class="card-body pb-0 px-0 px-md-4">

                            <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-6 mb-4">

            <div class="card">

                <ul class="list-group">

                    <li class="list-group-item active" style="z-index: 0;">

                        <span class="fs-5"><i class="fas fa-paperclip"></i> Document To Be Uploaded</span>

                        <a class="float-end visually-hidden" id="dash_click_to_upload_btn" href="/document_upload">

                            <button class="btn btn-danger  btn-sm fs-6"> <i class="fas fa-paperclip"></i> Click To Upload </button>

                        </a>

                    </li>

                    <li class="list-group-item">

                        <input class="form-check-input me-1" type="checkbox" id="job_application_form_checkbox" value="" disabled>

                        <span class="fw-bold">Basic Information Form</span>

                        <a href="/basic_information_form" class="badge bg-label-info" id="job_application_form_fill_now"><i class="fas fa-hand-point-up"></i> Click to fill</a>

                        <span class="badge bg-label-warning me-1 float-end mt-1" id="job_application_form_badge">Pending</span>

                    </li>

                    @foreach($doc_category_list as $category)

                    <li class="list-group-item">

                        <input class="form-check-input me-1" type="checkbox" id="doc_category_checkbox{{$category->id}}" value="" disabled>

                        <span class="fw-bold">{{$category->doc_category_name}}</span>

                        <?php 

                        $myString = $category->doc_category_details;

                        $myArray = explode(',', $myString);

                        ?>

                        <!-- Modal -->

                        <div class="modal fade" id="content_help{{$category->id}}" tabindex="-1" aria-labelledby="Content_help" aria-hidden="true">

                            <div class="modal-dialog">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="exampleModalLabel">{{$category->doc_category_name}}</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                    </div>

                                    <div class="modal-body">

                                        <p><span class='fs-5'>Any one form Below..</span>

                                            <ol class="list-group list-group-numbered list-group-flush">

                                                @foreach($myArray as $item)

                                                <li class="list-group-item fw-bold">{{$item}}</li>

                                                @endforeach



                                            </ol>

                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                        @if(!$category->doc_category_details==null)

                        <span class="badge bg-label-info rounded-circle" data-bs-toggle="modal" data-bs-target="#content_help{{$category->id}}" style="cursor: pointer;" title="Click For Help"><i class="fas fa-question-circle"></i></span>

                        @endif

                        <span class="badge  bg-label-warning me-1 float-end" id="doc_category_item{{$category->id}}">Pending</span>

                    </li>

                    @endforeach

                </ul>

            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <div class="card">

                <ul class="list-group">

                    <li class="list-group-item text-white bg-success fs-5">

                        <i class="fas fa-cloud-upload-alt"></i> Document Uploaded

                    </li>

                    @if(sizeof($emp_doc_list)<=0) <li class="list-group-item fw-bold text-danger">

                        No document uploaded till now..!

                        </li>

                        @endif

                        @foreach($emp_doc_list as $document)

                        <li class="list-group-item">

                            <span class="fw-bold">{{$document->doc_category_name}}</span>

                            <a href="{{$document->doc_url}}" target="_blank"><span class="badge  float-end btn btn-primary rounded-pill"><i class="fas fa-eye"></i> View</span></a>

                        </li>

                        @endforeach

                </ul>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-12 mb-4 order-0">

            <div class="card">

                <ul class="list-group">

                    <li class="list-group-item text-white bg-warning">

                        <span class="fs-5"><i class="fas fa-file-signature"></i> Your To do list</span>

                        <span class="float-end"> <button class="btn btn-danger  btn-sm  fs-6" id="todo_add_btn" data-bs-toggle="modal" data-bs-target="#todo_add_modal"> <i class="fas fa-plus"></i> Add

                            </button></span>

                    </li>

                    <span id="to_do_item">

                        <li class="list-group-item" id="todo_content_refresh">

                            <i class="fas fa-sync"></i>Refreshing List

                        </li>

                    </span>

                </ul>

            </div>

        </div>

    </div>



</div>

</div>

<!-- Modal -->

<div class="modal fade" id="todo_add_modal">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Add To Do Item</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col">

                        <input type="text" class="form-control" id="todo_content" placeholder="Write Content" aria-label="Write Content">

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-danger" id="add_todo_content_close_modal_btn" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Close</button>

                <button type="submit" class="btn btn-success" id="add_todo_content_btn"><i class="fas fa-check-circle"></i> Add Item</button>

            </div>

        </div>

    </div>

</div>

<!-- / Content -->

@endsection

@section('Js_contents')

<script src="..\assets\js\pages\temp_emp_dashboard.js"></script>

@endsection

