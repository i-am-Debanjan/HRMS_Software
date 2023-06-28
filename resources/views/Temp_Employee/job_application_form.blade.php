@extends('Layout.temp_emp_template')
@section('Page_contents')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row   card">
        <div class="col-lg-12">
            <form class="row g-3 p-3" id="job_application_form" action="/basic_info_form_submit" method="post" novalidate>
                @csrf
                <input type="hidden" value="0" id="confirm_form_id">
                <div class="col-md-2">
                    <label for="inputEmail4" class="form-label"><i class="fas fa-pen-nib"></i> Select Prefix <span class="text-danger">*</span></label>
                    <select class="form-select" aria-label="Default select example" name="name_prefix" id="name_prefix" onchange="gender_choose()" required>
                        <option value="" selected>Choose Name Prefix</option>
                        <option value="Mr.">Mr.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Ms.">Ms.</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="f_name" class="form-label"><i class="fas fa-user-edit"></i> First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="f_name" name="f_name" placeholder="First Name" autocomplete="off" required>
                </div>
                <div class="col-md-5">
                    <label for="l_name" class="form-label"><i class="fas fa-user-edit"></i> Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Last Name" autocomplete="off" required>
                </div>
                <div class="col-md-3">
                    <label for="selected_gender" class="form-label"><i class="fas fa-venus-mars"></i> Select Gender <span class="text-danger">*</span></label>
                    <select class="form-select" aria-label="Default select example" placeholder="Selected_gender" name="selected_gender" id="selected_gender" required>
                        <option value="" selected>Choose Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="dob" class="form-label"><i class="far fa-calendar-alt"></i> Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="dob" name="dob" autocomplete="off" required>
                </div>
                <div class="col-md-3">
                    <label for="phone_no" class="form-label"><i class="fas fa-mobile-alt"></i> Phone Number <span class="text-danger">*</span>
                    </label>
                    <input type="tel" class="form-control" id="phone_no" name="phone_no" placeholder="Enter Phone Number" pattern="[0-9]{10}" autocomplete="off" required>
                </div>
                <div class="col-md-3">
                    <label for="emergency_no" class="form-label"><i class="fas fa-phone-volume"></i> Emergency Number <span class="text-danger">*</span>
                        <span class="badge bg-label-info rounded-circle" data-bs-toggle="modal" data-bs-target="#emergency_number_help" style="cursor: pointer;"><i class="fas fa-question-circle"></i></span>
                    </label>
                    <input type="tel" class="form-control" id="emergency_no" name="emergency_no" placeholder="Enter Emergency Number" pattern="[0-9]{10}" autocomplete="off" required>

                </div>
                <div class="col-md-6">
                    <label for="father_name" class="form-label"><i class="fas fa-pen-alt"></i> Father's Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="father_name" name="father_name" placeholder="Enter Father's Name" autocomplete="off" required>
                </div>
                <div class="col-md-6">
                    <label for="mother_name" class="form-label"><i class="fas fa-pen-alt"></i> Mother's Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="mother_name" name="mother_name" placeholder="Enter Mother's Name" autocomplete="off" required>
                </div>
                <div class="col-12">
                    <label for="current_address" class="form-label"><i class="fas fa-map-marked-alt"></i> Current Address <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control" id="current_address" name="current_address" placeholder="Enter Current Address" autocomplete="off" required></textarea>
                </div>
                <div class="col-12">
                    <label for="parmanent_address" class="form-label"><i class="fas fa-map-marker-alt"></i> Parmanent Address <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control" id="parmanent_address" name="parmanent_address" placeholder="Enter Parmanent Address" autocomplete="off" required></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" id="submit_job_application_btn" class="btn btn-info fw-bold fs-5 disabled">Preview & Submit <i class="far fa-hand-point-up"></i> </button>
                </div>
            </form>

            @foreach($basic_details as $info)

            <form class="row g-3 p-3 visually-hidden" id="new_job_application_form" action="/basic_info_form_submit" method="post" novalidate>
                @csrf
                <div class="col-md-2">
                    <label for="inputEmail4" class="form-label"><i class="fas fa-pen-nib"></i> Name Prefix <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="e_name_prefix" name="e_name_prefix" placeholder="Name Prefix" value="{{$info->name_prefix}}" autocomplete="off" disabled>
                </div>
                <div class="col-md-5">
                    <label for="f_name" class="form-label"><i class="fas fa-user-edit"></i> First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="e_f_name" name="e_f_name" placeholder="First Name" value="{{$info->f_name}}" autocomplete="off" disabled>
                </div>
                <div class="col-md-5">
                    <label for="l_name" class="form-label"><i class="fas fa-user-edit"></i> Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="e_l_name" name="e_l_name" placeholder="Last Name" value="{{$info->l_name}}" autocomplete="off" disabled>
                </div>
                <div class="col-md-3">
                    <label for="selected_gender" class="form-label"><i class="fas fa-venus-mars"></i> Select Gender <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="e_gender" name="e_gender" value="{{$info->gender}}" autocomplete="off" disabled>
                </div>
                <div class="col-md-3">
                    <label for="dob" class="form-label"><i class="far fa-calendar-alt"></i> Date of Birth <span class="text-danger">*</span></label>
                    <?php date_default_timezone_set("Asia/Calcutta");?>
                    <input type="text" class="form-control" id="e_dob" name="e_dob" value="{{ date('d/m/Y', $info->dob) }}" autocomplete="off" disabled>
                </div>
                <div class="col-md-3">
                    <label for="phone_no" class="form-label"><i class="fas fa-mobile-alt"></i> Phone Number <span class="text-danger">*</span>
                    </label>
                    <input type="tel" class="form-control" id="e_phone_no" name="e_phone_no" placeholder="Enter Phone Number" pattern="[0-9]{10}" value="{{$info->phone_number}}" autocomplete="off" disabled>
                </div>
                <div class="col-md-3">
                    <label for="emergency_no" class="form-label"><i class="fas fa-phone-volume"></i> Emergency Number <span class="text-danger">*</span>
                        <span class="badge bg-label-info rounded-circle" data-bs-toggle="modal" data-bs-target="#emergency_number_help" style="cursor: pointer;"><i class="fas fa-question-circle"></i></span>
                    </label>
                    <input type="tel" class="form-control" id="e_emergency_no" name="e_emergency_no" placeholder="Enter Emergency Number" pattern="[0-9]{10}" value="{{$info->emergency_number}}" autocomplete="off" disabled>

                </div>
                <div class="col-md-6">
                    <label for="father_name" class="form-label"><i class="fas fa-pen-alt"></i> Father's Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="e_father_name" name="e_father_name" placeholder="Enter Father's Name" value="{{$info->father_name}}" autocomplete="off" disabled>
                </div>
                <div class="col-md-6">
                    <label for="mother_name" class="form-label"><i class="fas fa-pen-alt"></i> Mother's Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="e_mother_name" name="e_mother_name" placeholder="Enter Mother's Name" value="{{$info->mother_name}}" autocomplete="off" disabled>
                </div>
                <div class="col-12">
                    <label for="current_address" class="form-label"><i class="fas fa-map-marked-alt"></i> Current Address <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control" id="e_current_address" name="e_current_address" placeholder="Enter Current Address" value="" autocomplete="off" disabled>{{$info->current_address}}</textarea>
                </div>
                <div class="col-12">
                    <label for="parmanent_address" class="form-label"><i class="fas fa-map-marker-alt"></i> Parmanent Address <span class="text-danger">*</span></label>
                    <textarea type="text" class="form-control" id="e_parmanent_address" name="e_parmanent_address" placeholder="Enter Parmanent Address" value="" autocomplete="off" disabled>{{$info->parmanent_address}}</textarea>
                </div>
            </form>


            @endforeach

        </div>
    </div>

</div>
<!-- / Content -->
<!-- Modal -->
<div class="modal fade" id="emergency_number_help" tabindex="-1" aria-labelledby="Content_help" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Emergency Number Help</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-danger fs-6">
                    Note: Emergency number cannot be same as phone number Family member's mobile number peferable
                </p>
            </div>
        </div>
    </div>
</div>
<!-- Preview Modal -->
<div class="modal fade" id="Preview_form_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Preview_form_modal_lebel">Preview Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    {{-- <thead>
                        <tr>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead> --}}
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td  id="name_prefix_preview"></td>
                        </tr>
                        <tr>
                            <td>First Name</td>
                            <td>:</td>
                            <td id="f_name_preview"></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td>:</td>
                            <td id="l_name_preview"></td>
                        </tr>
                         <tr>
                            <td>Gender</td>
                            <td>:</td>
                            <td id="selected_gender_preview"></td>
                        </tr>
                         <tr>
                            <td>D.O.B</td>
                            <td>:</td>
                            <td id="dob_preview"></td>
                        </tr>
                        <tr>
                            <td>Phone No.</td>
                            <td>:</td>
                            <td id="phone_no_preview"></td>
                        </tr>
                        <tr>
                            <td>Emergency No.</td>
                            <td>:</td>
                            <td id="emergency_no_preview"></td>
                        </tr>
                        <tr>
                            <td>Father Name</td>
                            <td>:</td>
                            <td id="father_name_preview"></td>
                        </tr>
                        <tr>
                            <td>Mother Name</td>
                            <td>:</td>
                            <td id="mother_name_preview"></td>
                        </tr>
                        <tr>
                            <td>Current Address</td>
                            <td>:</td>
                            <td id="current_address_preview"></td>
                        </tr>
                        <tr>
                            <td>Parmanent Address</td>
                            <td>:</td>
                            <td id="parmanent_address_preview"></td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Cancel</button>
                <button type="button" class="btn btn-success" onclick="confirm_and_submit_form()"><i class="fas fa-check-circle"></i> Confirm & Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('Js_contents')
<script src="..\assets\js\pages\job_application_form.js"></script>
@endsection
