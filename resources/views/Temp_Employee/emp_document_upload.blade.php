@extends('Layout.temp_emp_template')

@section('Page_contents')

<!-- Content -->



<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">

        <div class="row">

            <div class="d-flex  col-md-12 flex-column flex-md-row bd-highlight">

                <div class="p-2 flex-fill  bd-highlight">

                    {{-- <label for="selected_doc_type" class="form-label">Select Document Type</label> --}}

                    <select class="form-select" aria-label="Select Document Type" id="selected_doc_type" onchange="document_upload_check()">

                        <option value="" selected>Select Document Type</option>

                        @foreach($emp_doc_category as $category)

                        <option value="{{$category->id}}">{{$category->doc_category_name}}</option>

                        @endforeach

                    </select>

                </div>

            </div>

        </div>

        <div class="row">

               <form class="col-md-12"  id="upload_temp_emp_doc_form" action="/upload_temp_emp_doc" method="POST" novalidate enctype="multipart/form-data">

               @csrf

               <div class="row" id="upload_temp_emp_doc">

               </div>

               </form>

               <div class="col-md-12"  id="upload_section">

               </div>

        </div>
        <div class="row ">
            <p class="ms-2 fw-bold fst-italic text-danger">Note: All documents must be submitted in PDF format. <br></p>
        </div>

        

    </div>

    <!-- / Content -->

    @endsection

    @section('Js_contents')

    <script src="..\assets\js\pages\temp_emp_document_upload.js"></script>

    @endsection

