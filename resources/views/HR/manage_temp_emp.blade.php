@extends('Layout.template')
@section('Page_contents')

<div class="container-xxl flex-grow-1 container-p-y">
    @if(!app('request')->input('id')=="")
    <input type="hidden" id="url_id" value="{{decrypt(app('request')->input('id'))}}" />
    @endif
    <div class="row mb-3 mt-2">
        <div class="col-md-6 col-sm-12  me-auto">
            <h4 class="mb-2 ms-2 fw-bold"><i class="fas fa-address-book"></i> Manage Teporary Employees</h4>
        </div>
        <div class="col-md-4 col-sm-12  ms-auto">
            <select class="form-select" id="temp_emp_select">
                <option value="">Select Temp Employee</option>
                @foreach ($all_temp_employees as $temp_employee)
                <option value="{{ $temp_employee->id }}">{{ $temp_employee->username }}
                </option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-md-12 d-flex flex-column flex-md-row">
            {{-- <div class="p-1">
                <button class="btn  btn-warning fw-bold" data-bs-toggle="collapse" data-bs-target="#add_emp_docs" role="button"><i class="fas fa-folder-plus"></i> Add Document</button>
            </div> --}}
            <div class="p-1">
                <button class="btn  btn-primary rounded-pill fw-bold fst-italic" title="View Document" data-bs-toggle="collapse" data-bs-target="#view_emp_docs" role="button"><i class="fas fa-folder-open"></i> View Document</button>
            </div>
            <div class="p-1">
                {{-- <button class="btn  btn-primary fw-bold" data-bs-toggle="collapse" data-bs-target="#send_letter_collapse" role="button"><i class="fas fa-envelope"></i> Send Letter</button> --}}
                <button class="btn  btn-success rounded-pill fw-bold fst-italic " title="Send Offer Letter" data-bs-toggle="modal" data-bs-target="#send_offer_letter_modal" role="button"><i class="fas fa-envelope-open-text"></i> Offer Letter</button>
            </div>
            <div class="p-1">
                <button class="btn  btn-danger rounded-pill fw-bold fst-italic" title="Reset Employee Password" onclick="reset_password()" id="reset_pass_btn"><i class="fas fa-redo-alt"></i> Reset Password</button>
            </div>
            <div class="p-1">
                <button type="button"  id="covert_to_emp_btn" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Coming Soon" class="btn btn-dark rounded-pill fw-bold fst-italic float-start float-md-end "><i class="fas fa-sync-alt"></i> Covert to Employee </button>
            </div>

        </div>

    </div>
    <div class="collapse" id="add_emp_docs">
        <div class="row mb-2">
            <h3> <i class="fas fa-folder-plus"></i> Add Document</h3>
            <div class="col-md-12">
                <div class="card card-success card-outline card-body bg-light">

                </div>
            </div>
        </div>
    </div>
    <div class="collapse" id="view_emp_docs">
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="card  card-body bg-light">
                    <h4 class="fw-bold"> <i class="fas fa-folder-open"></i> Employee Document</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered border-light text-center">
                            <thead class="table-success text-white">
                                <tr>
                                    <th scope="col" class="fw-bold">Sl No.</th>
                                    <th scope="col" class="fw-bold">Document Name</th>
                                    <th scope="col" class="fw-bold">Action</th>
                                </tr>
                            </thead>
                            <tbody id="temp_emp_docs_view">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="collapse" id="send_letter_collapse">
        <div class="row mb-2">
            <div class="col-md-12 d-flex flex-column flex-md-row">
                <div class="p-1">
                    <h3 class="mt-1"> <i class="fas fa-envelope"></i> Send Letter</h3>
                </div>
                <div class="p-1">
                    <button class="btn  btn-danger fw-bold" data-bs-toggle="modal" data-bs-target="#send_offer_letter_modal" role="button"><i class="fas fa-envelope-open-text"></i> OFFER LETTER</button>
                </div>
                {{-- <div class="p-1">
                    <button class="btn btn-info fw-bold" data-bs-toggle="collapse" data-bs-target="#send_joining_letter_colapse" role="button"><i class="fas fa-mail-bulk"></i> JOINING LETTER</button>
                </div> --}}

            </div>

            {{-- <div class="col-md-12 card">
                <div class="collapse" id="send_offer_letter_colapse">
                    <div class="row">
                        <h3 class="mt-2"> <i class="fas fa-envelope-open-text"></i> OFFER LETTER</h3>
                        <div class=" d-flex  flex-row" id="already_send_offer_letter_placeholder">
                        </div>
                        <form class="row g-3 visually-hidden" id="send_offer_letter" action="/send_offer_letter" method="post" novalidate>
                            @csrf
                            <input type="hidden" name="selected_temp_emp_id" id="selected_temp_emp_id">
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label"><i class="fas fa-id-card-alt"></i> Post Apply For <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="post_apply_for" id="post_apply_for" placeholder="Enter Post Apply For" autocomplete="off" required>
                            </div>
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label"><i class="fas fa-calendar-check"></i> Temp. Date of Joining<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="emp_tdj" id="emp_tdj" placeholder="Enter Post Apply For" autocomplete="off" required>
                            </div>
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label"><i class="fas fa-rupee-sign"></i> Estimated Salary <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="emp_salary" id="emp_salary" placeholder="Enter Post Apply For" autocomplete="off" required>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-danger fw-bold mt-4 float-end" type="submit" id="send_offer_letter_btn"><i class="fas fa-paper-plane"></i> Send Mail</button>
                            </div>
                        </form>
                        <div class=" d-flex  flex-row" id="pending_form_fillup_ping">
                            <div class="">
                                <h3 class="mt-4 ms-2 fw-bold text-wrap text-danger"><span class="text-danger"><i class="fas fa-exclamation-circle"></i> Form Fill Up Pending...!</h3>
                            </div>
                            <div class="">
                                <button class="btn btn-outline-info mt-3 ms-2" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="Coming Soon"><i class="fas fa-bell"></i> Ping Employee</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse" id="send_joining_letter_colapse">
                    <div class="row mb-2">
                        <h3 class="mt-2"> <i class="fas fa-envelope-open-text"></i> JOINING LETTER</h3>
                        <div class=" d-flex  flex-row" id="already_send_joining_letter_placeholder">
                        </div>
                        <form class="row g-3 visually-hidden" id="send_joining_letter" action="/send_joining_letter" method="post" novalidate>
                            @csrf
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label"><i class="fas fa-id-card-alt"></i> Post Apply For <span class="text-danger">*</span></label>
                                <input class="form-control" name="post_apply_for" id="post_apply_for" placeholder="Enter Post Apply For">
                            </div>
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label"><i class="fas fa-calendar-check"></i> Temp. Date of Joining<span class="text-danger">*</span></label>
                                <input class="form-control" name="post_apply_for" id="post_apply_for" placeholder="Enter Post Apply For">
                            </div>
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label"><i class="fas fa-rupee-sign"></i> Estimated Salary <span class="text-danger">*</span></label>
                                <input class="form-control" name="post_apply_for" id="post_apply_for" placeholder="Enter Post Apply For">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-danger fw-bold mt-4 float-end"><i class="fas fa-paper-plane"></i> Send Mail</button>
                            </div>
                        </form>
                        <div class=" d-flex  flex-row" id="pending_form_fillup_ping">
                            <div class="p-2">
                                <h3 class="mt-4 ms-2 fw-bold text-wrap text-danger"><span class="text-info"><i class="fas fa-exclamation-circle"></i> Form Fill Up Pending...!</h3>
                            </div>
                            <div class="p-2">
                                <button class="btn btn-outline-danger mt-3 ms-2" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="Coming Soon"><i class="fas fa-bell"></i> Ping Employee</button>

                            </div>
                        </div>

                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="accordion mt-1 " id="accordionemp_list" tabindex="-1">
        <div class="card accordion-item ">
            <button type="button" class="accordion-button collapsed fs-4 fw-bold" data-bs-toggle="collapse" data-bs-target="#list_of_emp_accordion" aria-expanded="false" aria-controls="list_of_emp_accordion">
                <i class="fas fa-user-tie"></i><span class="ms-2 mt-1">Employee Details</span>
            </button>

            <div id="list_of_emp_accordion" class="accordion-collapse collapse show" data-bs-parent="#accordionemp_list">
                <div class="accordion-body table-responsive">
                    <form class="row g-2 p-2" id="update_temp_emp_basic_info_form" action="/update_temp_emp_basic_info" method="post" novalidate>
                        {{-- <h4 class="fw-bold"> <i class="fas fa-user-tie"></i> Employee Details</h4> --}}
                        @csrf
                        <input type="hidden" id="selected_temp_emp_hidden_value" name="selected_temp_emp" value="" />
                        <div class="col-md-2">
                            <label for="inputEmail4" class="form-label fw-bold"><i class="fas fa-pen-nib"></i> Select Prefix <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" name="e_name_prefix" id="e_name_prefix" required>
                                <option value="" selected>Choose Name Prefix</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Ms.">Ms.</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="f_name" class="form-label fw-bold"><i class="fas fa-user-edit"></i> First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="e_f_name" name="e_f_name" placeholder="First Name" autocomplete="off" required>
                        </div>
                        <div class="col-md-5">
                            <label for="l_name" class="form-label fw-bold"><i class="fas fa-user-edit"></i> Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="e_l_name" name="e_l_name" placeholder="Last Name" autocomplete="off" required>
                        </div>
                        <div class="col-md-3">
                            <label for="selected_gender" class="form-label fw-bold"><i class="fas fa-venus-mars"></i> Select Gender <span class="text-danger">*</span></label>
                            <select class="form-select" aria-label="Default select example" placeholder="Selected_gender" name="e_selected_gender" id="e_selected_gender" required>
                                <option value="" selected>Choose Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="dob" class="form-label fw-bold"><i class="far fa-calendar-alt"></i> Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="e_dob" name="e_dob" autocomplete="off" required>
                        </div>
                        <div class="col-md-3">
                            <label for="phone_no" class="form-label fw-bold"><i class="fas fa-mobile-alt"></i> Phone Number <span class="text-danger">*</span>
                            </label>
                            <input type="tel" class="form-control" id="e_phone_no" name="e_phone_no" placeholder="Enter Phone Number" pattern="[0-9]{10}" autocomplete="off" required>
                        </div>
                        <div class="col-md-3">
                            <label for="emergency_no" class="form-label fw-bold"><i class="fas fa-phone-volume"></i> Emergency Number <span class="text-danger">*</span>
                                <span class="badge bg-label-info rounded-circle" data-bs-toggle="modal" data-bs-target="#emergency_number_help" style="cursor: pointer;"><i class="fas fa-question-circle"></i></span>
                            </label>
                            <input type="tel" class="form-control" id="e_emergency_no" name="e_emergency_no" placeholder="Enter Emergency Number" pattern="[0-9]{10}" autocomplete="off" required>

                        </div>
                        <div class="col-md-6">
                            <label for="father_name" class="form-label fw-bold"><i class="fas fa-pen-alt"></i> Father's Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="e_father_name" name="e_father_name" placeholder="Enter Father's Name" autocomplete="off" required>
                        </div>
                        <div class="col-md-6">
                            <label for="mother_name" class="form-label fw-bold"><i class="fas fa-pen-alt"></i> Mother's Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="e_mother_name" name="e_mother_name" placeholder="Enter Mother's Name" autocomplete="off" required>
                        </div>
                        <div class="col-md-12">
                            <label for="current_address" class="form-label fw-bold"><i class="fas fa-map-marked-alt"></i> Current Address <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control" id="e_current_address" name="e_current_address" placeholder="Enter Current Address" autocomplete="off" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="parmanent_address" class="form-label fw-bold"><i class="fas fa-map-marker-alt"></i> Parmanent Address <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control" id="e_parmanent_address" name="e_parmanent_address" placeholder="Enter Parmanent Address" autocomplete="off" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" id="e_temp_emp_details_btn" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Coming Soon" class="btn btn-primary rounded-pill fw-bold fs-5 float-start float-md-end">Update <i class="far fa-hand-point-up"></i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class=" card ">
        <form class="row g-2 p-3" id="update_temp_emp_basic_info_form" action="/update_temp_emp_basic_info" method="post" novalidate>
            <h4 class="fw-bold"> <i class="fas fa-user-tie"></i> Employee Details</h4>
            @csrf
            <input type="hidden" id="selected_temp_emp_hidden_value" name="selected_temp_emp" value="" />
            <div class="col-md-2">
                <label for="inputEmail4" class="form-label fw-bold"><i class="fas fa-pen-nib"></i> Select Prefix <span class="text-danger">*</span></label>
                <select class="form-select" aria-label="Default select example" name="e_name_prefix" id="e_name_prefix" required>
                    <option value="" selected>Choose Name Prefix</option>
                    <option value="Mr.">Mr.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Ms.">Ms.</option>
                </select>
            </div>
            <div class="col-md-5">
                <label for="f_name" class="form-label fw-bold"><i class="fas fa-user-edit"></i> First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="e_f_name" name="e_f_name" placeholder="First Name" autocomplete="off" required>
            </div>
            <div class="col-md-5">
                <label for="l_name" class="form-label fw-bold"><i class="fas fa-user-edit"></i> Last Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="e_l_name" name="e_l_name" placeholder="Last Name" autocomplete="off" required>
            </div>
            <div class="col-md-3">
                <label for="selected_gender" class="form-label fw-bold"><i class="fas fa-venus-mars"></i> Select Gender <span class="text-danger">*</span></label>
                <select class="form-select" aria-label="Default select example" placeholder="Selected_gender" name="e_selected_gender" id="e_selected_gender" required>
                    <option value="" selected>Choose Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="others">Others</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="dob" class="form-label fw-bold"><i class="far fa-calendar-alt"></i> Date of Birth <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="e_dob" name="e_dob" autocomplete="off" required>
            </div>
            <div class="col-md-3">
                <label for="phone_no" class="form-label fw-bold"><i class="fas fa-mobile-alt"></i> Phone Number <span class="text-danger">*</span>
                </label>
                <input type="tel" class="form-control" id="e_phone_no" name="e_phone_no" placeholder="Enter Phone Number" pattern="[0-9]{10}" autocomplete="off" required>
            </div>
            <div class="col-md-3">
                <label for="emergency_no" class="form-label fw-bold"><i class="fas fa-phone-volume"></i> Emergency Number <span class="text-danger">*</span>
                    <span class="badge bg-label-info rounded-circle" data-bs-toggle="modal" data-bs-target="#emergency_number_help" style="cursor: pointer;"><i class="fas fa-question-circle"></i></span>
                </label>
                <input type="tel" class="form-control" id="e_emergency_no" name="e_emergency_no" placeholder="Enter Emergency Number" pattern="[0-9]{10}" autocomplete="off" required>

            </div>
            <div class="col-md-6">
                <label for="father_name" class="form-label fw-bold"><i class="fas fa-pen-alt"></i> Father's Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="e_father_name" name="e_father_name" placeholder="Enter Father's Name" autocomplete="off" required>
            </div>
            <div class="col-md-6">
                <label for="mother_name" class="form-label fw-bold"><i class="fas fa-pen-alt"></i> Mother's Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="e_mother_name" name="e_mother_name" placeholder="Enter Mother's Name" autocomplete="off" required>
            </div>
            <div class="col-md-12">
                <label for="current_address" class="form-label fw-bold"><i class="fas fa-map-marked-alt"></i> Current Address <span class="text-danger">*</span></label>
                <textarea type="text" class="form-control" id="e_current_address" name="e_current_address" placeholder="Enter Current Address" autocomplete="off" required></textarea>
            </div>
            <div class="col-md-12">
                <label for="parmanent_address" class="form-label fw-bold"><i class="fas fa-map-marker-alt"></i> Parmanent Address <span class="text-danger">*</span></label>
                <textarea type="text" class="form-control" id="e_parmanent_address" name="e_parmanent_address" placeholder="Enter Parmanent Address" autocomplete="off" required></textarea>
            </div>
            <div class="col-md-12">
                <button type="submit" id="e_temp_emp_details_btn" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Coming Soon" class="btn btn-primary fw-bold fs-5 float-start float-md-end">Update <i class="far fa-hand-point-up"></i> </button>
            </div>
        </form>
    </div> --}}
    <!-- Send_letter Modal -->
    <div class="modal fade" id="send_offer_letter_modal" tabindex="-1">
        <div class="modal-lg modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Send Offer Letter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class=" d-flex  flex-column flex-md-row" id="send_offer_letter_placeholder">
                    </div>
                    <form class="row g-3  visually-hidden" id="send_offer_letter" action="/send_offer_letter" method="post" novalidate>
                        @csrf
                        <input type="hidden" name="selected_temp_emp_id" id="selected_temp_emp_id">
                        <input type="hidden" name="selected_temp_emp_name" id="selected_temp_emp_name">
                        <div class="col-md-3">
                            <label for="inputEmail4" class="form-label"><i class="fas fa-id-card-alt"></i> Post Apply For <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="post_apply_for" id="post_apply_for" placeholder="Enter Post Apply For" autocomplete="off" required>
                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail4" class="form-label"><i class="fas fa-calendar-check"></i> Temp. Date of Joining<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="emp_tdj" id="emp_tdj" placeholder="Enter Post Apply For" autocomplete="off" required>
                        </div>
                        <div class="col-md-3">
                            <label for="inputEmail4" class="form-label"><i class="fas fa-rupee-sign"></i> Estimated Salary P/A <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="emp_salary" id="emp_salary" placeholder="Enter Post Apply For" autocomplete="off" required>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-danger fw-bold mt-4 float-end" type="submit" id="send_offer_letter_btn"><i class="fas fa-paper-plane"></i> Send Mail</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--view_doc PDF Modal -->
    <div class="modal fade" id="view_doc_pdf_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Document</h5>
                    <button type="button" class="btn-close" id="view_modal_close_btn_id" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="doc_content_id">

                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('Js_contents')

<script src="{{ asset('assets\js\pages\manage_temp_employee.js') }}"></script>
@endsection
