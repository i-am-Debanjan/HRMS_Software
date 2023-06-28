var toastMixin = Swal.mixin({
    toast: true,
    icon: 'success',
    title: 'Title',
    animation: false,
    position: 'top-right',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
function reset_password() {
    let temp_emp_id = $("#temp_emp_select").val();
    let temp_emp_name = $("#temp_emp_select option:selected").html();
    console.log(temp_emp_name);
    if (temp_emp_id == "") {
        toastMixin.fire({
            icon: 'error',
            animation: true,
            title: 'Please Select Temporary Employee'
        });
    } else {
        Swal.fire({
            title: 'Are you sure?',
            position: 'center',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#009541',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reset it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#reset_pass_btn').html('');
                $('#reset_pass_btn').attr('disabled', true);
                $('#reset_pass_btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Reseting Password...');
                $.ajax({
                    url: "/reset_temp_emp_password",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { temp_employee_id: temp_emp_id },
                    dataType: 'json',
                    success: function (data) {
                        Swal.fire({
                            // position: 'top-end',
                            icon: 'success',
                            text: 'Employee ' + temp_emp_name + ' Password reset successfully',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        $('#reset_pass_btn').attr('disabled', false);
                        $('#reset_pass_btn').html('<i class="fas fa-sync-alt"></i> Reset Password');

                    }
                });
            }
        });
    }
}
// Swal.fire({
//     position: 'top-end',
//     icon: 'success',
//     title: 'Your work has been saved',
//     showConfirmButton: false,
//     timer: 1500
//   })
var url_id = $('#url_id').val();
$('#hr_main_title').html('Manage Temp. Employees');
$('#hr_hr').addClass('active');
$('#hr_hr').addClass('open');
$('#hr_hr_manage_temp_emp').addClass('active');
$("#temp_emp_select").val(url_id).trigger('change');
$('#selected_temp_emp_id').val($("#temp_emp_select").val());
$('#selected_temp_emp_name').val($("#temp_emp_select option:selected").html());
$("#temp_emp_select").select2();
$("#temp_emp_select").on("change", function (e) {
    fetch_edit_temp_emp_details($("#temp_emp_select").val());
    $('#selected_temp_emp_id').val($("#temp_emp_select").val());
    $('#selected_temp_emp_name').val($("#temp_emp_select option:selected").html());

});
fetch_edit_temp_emp_details(url_id);
function check_temp_emp_letters(temp_emp_id) {
    $.ajax({
        url: "/check_temp_emp_letters",
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { temp_employee_id: temp_emp_id },
        dataType: 'json',
        success: function (data) {
            if (!data['data'].length < 1) {
                $('#already_send_offer_letter_placeholder').empty();
                let send_again_html = '';
                $.each(data['data'], function (index, val) {
                    if (val.letter_name == "Offer Letter") {
                        $('#send_offer_letter').addClass('visually-hidden');
                        send_again_html += '<div class=" d-flex  flex-column flex-md-row">';
                        send_again_html += '<div class="p-2">';
                        send_again_html += '<h5 class="mt-2 ms-2 fw-bold text-wrap text-danger"><span class="text-danger"><i class="fas fa-exclamation-circle"></i> Already Send...!</h5>';
                        send_again_html += '</div>';
                        send_again_html += '<div class="p-2">';
                        send_again_html += '<a href="' + val.letter_url + '" target="_blank"><button class="btn btn-success btn-sm mt-1 ms-2"><i class="fas fa-eye"></i> View Offer letter</button></a>';
                        send_again_html += '</div>';
                        // send_again_html += '<div class="p-2">';
                        // send_again_html += '<button class="btn btn-warning btn-sm mt-1 ms-2"><i class="far fa-paper-plane"></i> Send Again </button>';
                        // send_again_html += '</div>';
                        send_again_html += '</div>';
                        $('#send_offer_letter_placeholder').html(send_again_html);
                    } else if (val.letter_name == "Joining Letter") {
                        $('#send_joining_letter').addClass('visually-hidden');
                    } else {
                        console.log('fsd');
                        $('#send_offer_letter').removeClass('visually-hidden');

                    }
                });
            }
        }
    });
}
function fetch_edit_temp_emp_details(temp_emp_id) {
    var pinding_form = '';
    pinding_form += '<div class=""><h5 class="mt-2 fw-bold text-wrap text-danger"><span class="text-danger"><i class="fas fa-exclamation-circle"></i> Form Fill Up Pending...!</h5></div>';
    pinding_form += '<div class=""><button class="btn btn-outline-info btn-sm mt-1 ms-2" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-content="Coming Soon"><i class="fas fa-bell"></i> Ping Employee</button></div>';
    var select_emp = '';
    select_emp += '<div class=""><h5 class="mt-2 fw-bold text-wrap text-danger"><span class="text-danger"><i class="fas fa-exclamation-circle"></i> Please Select Employee...!</h5></div>';
    if (temp_emp_id == "") {
        $("#e_name_prefix").val('');
        $('#e_f_name').val('');
        $('#e_l_name').val('');
        $('#e_selected_gender').val('');
        $('#e_dob').val('');
        $('#e_father_name').val('');
        $('#e_mother_name').val('');
        $('#e_current_address').val('');
        $('#e_parmanent_address').val('');
        $('#e_phone_no').val('');
        $('#e_emergency_no').val('');
        // $('#pending_form_fillup_ping').removeClass('visually-hidden');
        $('#send_offer_letter').addClass('visually-hidden');
        // $('#send_joining_letter').addClass('visually-hidden');
        $('#temp_emp_docs_view').empty();
        $('#send_offer_letter_placeholder').empty();
        $('#send_offer_letter_placeholder').html(select_emp);
    } else {
        $.ajax({
            url: "/edit_temp_employee_details",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { temp_employee_id: temp_emp_id },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                $('#temp_emp_docs_view').empty();
                var temp_emp_details = '';
                if (data != "") {
                    $.each(data, function (index, val) {
                        $("#e_name_prefix").val(val.name_prefix).trigger('change');
                        $('#e_f_name').val(val.f_name);
                        $('#e_l_name').val(val.l_name);
                        $('#e_selected_gender').val(val.gender).trigger('change');
                        var timestamp = val.dob;
                        var date = new Date(timestamp * 1000);
                        $('#e_dob').val(date.toLocaleString('af-ZA').slice(0, 10));
                        $('#e_father_name').val(val.father_name);
                        $('#e_mother_name').val(val.mother_name);
                        $('#e_current_address').val(val.current_address);
                        $('#e_parmanent_address').val(val.parmanent_address);
                        $('#e_phone_no').val(val.phone_number);
                        $('#e_emergency_no').val(val.emergency_number);
                        $.each(val.employee_docs, function (index, val) {
                            temp_emp_details += '<tr>';
                            temp_emp_details += '<th scope="row">' + val.emp_doc_id + '</th>';
                            temp_emp_details += '<td>' + val.doc_category_name + '</td>';
                            temp_emp_details += '<td>';
                            if (val.temp_emp_doc_is_active == 0) {
                                temp_emp_details += '<button class="btn btn-link text-danger  btn-sm" title="Rejected"><i class="fas fa-ban fa-2x"></i></button>';
                                temp_emp_details += '<button class="btn btn-link text-info btn-sm  d-none d-md-inline" onclick="open_pdf_modal(\'' + val.doc_url + '\',' + val.emp_doc_id + ',' + val.employee_id + ',' + val.emp_doc_status + ',' + val.temp_emp_doc_is_active + ',\'' + val.doc_category_name + '\')"  data-bs-toggle="modal" data-bs-target="#view_doc_pdf_modal" title="View Document"><i class="fas fa-file-pdf fa-2x"></i></button>';
                                temp_emp_details += '<a href="' + val.doc_url + '" target="_blank" class="d-inline d-md-none" title="View Document"><button class="btn btn-link btn-sm"><i class="fas fa-file-pdf fa-2x"></i></button></a>';
                            } else if (val.emp_doc_status == 0) {
                                temp_emp_details += '<button class="btn btn-link text-success  btn-sm" onclick="approved_doc(' + val.emp_doc_id + ',' + val.employee_id + ',\'' + val.doc_category_name + '\')" title="Click To Approve"><i class="fas fa-check-circle  fa-2x"></i></button>';
                                temp_emp_details += '<button class="btn btn-link text-danger  btn-sm" onclick="reject_doc(' + val.emp_doc_id + ',' + val.employee_id + ',\'' + val.doc_category_name + '\')" title="Click To Reject"><i class="fas fa-times-circle  fa-2x"></i></button>';
                                temp_emp_details += '<button class="btn btn-link text-info btn-sm  d-none d-md-inline" onclick="open_pdf_modal(\'' + val.doc_url + '\',' + val.emp_doc_id + ',' + val.employee_id + ',' + val.emp_doc_status + ',' + val.temp_emp_doc_is_active + ',\'' + val.doc_category_name + '\')"  data-bs-toggle="modal" data-bs-target="#view_doc_pdf_modal" title="View Document"><i class="fas fa-file-pdf fa-2x"></i></button>';
                                temp_emp_details += '<a href="' + val.doc_url + '" target="_blank" class="d-inline d-md-none" title="View Document"><button class="btn btn-link btn-sm"><i class="fas fa-file-pdf fa-2x"></i></button></a>';

                            } else if (val.emp_doc_status == 1) {
                                temp_emp_details += '<button class="btn btn-link text-success  btn-sm" title="Approved"><i class="fas fa-check-circle fa-2x"></i></button>';
                                temp_emp_details += '<button class="btn btn-link text-info btn-sm  d-none d-md-inline" onclick="open_pdf_modal(\'' + val.doc_url + '\',' + val.emp_doc_id + ',' + val.employee_id + ',' + val.emp_doc_status + ',' + val.temp_emp_doc_is_active + ',\'' + val.doc_category_name + '\')"  data-bs-toggle="modal" data-bs-target="#view_doc_pdf_modal" title="View Document"><i class="fas fa-file-pdf fa-2x"></i></button>';
                                temp_emp_details += '<a href="' + val.doc_url + '" target="_blank" class="d-inline d-md-none" title="View Document"><button class="btn btn-link btn-sm"><i class="fas fa-file-pdf fa-2x"></i></button></a>';
                            }
                            temp_emp_details += '</td>';
                            temp_emp_details += '</tr>';
                        });
                        $('#temp_emp_docs_view').html(temp_emp_details);
                    });
                    $('#send_offer_letter_placeholder').empty();
                    $('#send_offer_letter').removeClass('visually-hidden');
                    check_temp_emp_letters(temp_emp_id);
                } else {
                    $("#e_name_prefix").val('');
                    $('#e_f_name').val('');
                    $('#e_l_name').val('');
                    $('#e_selected_gender').val('');
                    $('#e_dob').val('');
                    $('#e_father_name').val('');
                    $('#e_mother_name').val('');
                    $('#e_current_address').val('');
                    $('#e_parmanent_address').val('');
                    $('#e_phone_no').val('');
                    $('#e_emergency_no').val('');
                    // $('#pending_form_fillup_ping').removeClass('visually-hidden');
                    $('#temp_emp_docs_view').html(temp_emp_details);
                    $('#send_offer_letter').addClass('visually-hidden');
                    $('#send_offer_letter_placeholder').empty();
                    $('#send_offer_letter_placeholder').html(pinding_form);
                    // $('#send_joining_letter').addClass('visually-hidden');
                    $('#temp_emp_docs_view').empty();
                    // $('#already_send_offer_letter_placeholder').empty();
                }
            }
        });
    }
}
function open_pdf_modal(url, doc_id, temp_emp_id, status, is_active, doc_name) {
    $('#doc_content_id').empty();
    let doc_content = '';
    doc_content += '<embed src="' + url + '" width="100%" height="400px">';
    doc_content += '<a href="' + url + '" target="_blank"><button type="button" class="btn btn-link ms-2"><i class="fas fa-download"></i> Download Now</button></a>';
    if (is_active == 0) {
        doc_content += '<button class="btn btn btn-danger float-end ms-2" title="Rejected"><i class="fas fa-ban"></i> Rejected</button>';
    } else if (status == '1') {
        doc_content += '<button type="button" class="btn btn-success  float-end" title="Approved"><i class="fas fa-check-circle"></i> Approved</button>';
    } else if (status == '0') {
        doc_content += '<button class="btn btn btn-danger float-end ms-2" onclick="reject_doc(' + doc_id + ',' + temp_emp_id + ',\'' + doc_name + '\')" title="Click To Reject"><i class="fas fa-ban"></i> Reject</button>';
        doc_content += '<button type="button" class="btn btn-success  float-end" onclick="approved_doc(' + doc_id + ',' + temp_emp_id + ',\'' + doc_name + '\')" title="Click To Approve"><i class="fas fa-check-circle"></i> Approve</button>';
    }
    $('#doc_content_id').html(doc_content);

}
function approved_doc(id, temp_emp_id, doc_name) {
    Swal.fire({
        title: 'Are you sure?',
        position: 'center',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#009541',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#view_modal_close_btn_id').click();
            $('#temp_emp_docs_view').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...');
            $.ajax({
                url: "/approved_emp_doc",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { id: id, temp_employee_id: temp_emp_id, doc_name: doc_name },
                dataType: 'json',
                success: function (data) {
                    fetch_edit_temp_emp_details(temp_emp_id)
                }
            });
        }
    });
    $(".swal2-container").css("z-index", "10000");
}
function reject_doc(id, temp_emp_id, doc_name) {
    Swal.fire({
        title: 'Are you sure?',
        position: 'center',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#009541',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes! Reject it'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#temp_emp_docs_view').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...');
            $('#view_modal_close_btn_id').click();
            Swal.fire({
                // title: "An input!",
                text: "Write Message",
                input: 'text',
                showCancelButton: false,
                allowOutsideClick: false
            }).then((result) => {
                $.ajax({
                    url: "/reject_emp_doc",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { id: id, temp_employee_id: temp_emp_id, message: result.value, doc_name: doc_name },
                    dataType: 'json',
                    success: function (data) {
                        fetch_edit_temp_emp_details(temp_emp_id)
                    }
                });
            });
            $(".swal2-container").css("z-index", "1000");

        }
    });
    $(".swal2-container").css("z-index", "10000");
}

(function () {
    'use strict';
    window.addEventListener('load', function () {
        var send_offer_letter = $('#send_offer_letter');
        var edit_basic_info_forms = $('#update_temp_emp_basic_info_form');
        // Loop over them and prevent submission
        var create_forms_validation = Array.prototype.filter.call(send_offer_letter, function (form) {
            form.addEventListener('submit', function (event) {
                $('#emp_id_leader_hidden').val($("#emp_select").val());
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    toastMixin.fire({
                        icon: 'error',
                        animation: true,
                        title: 'Please resolve all the error..!'
                    });
                } else if ($("#temp_emp_select").val() == "") {
                    event.preventDefault();
                    event.stopPropagation();
                    toastMixin.fire({
                        icon: 'error',
                        animation: true,
                        title: 'Please Select Temporary Employee'
                    });
                } else {
                    $('#send_offer_letter_btn').html('');
                    $('#send_offer_letter_btn').attr('disabled', true);
                    $('#send_offer_letter_btn').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...'
                    );
                }
                form.classList.add('was-validated');
            }, false);
        });
        var edit_forms_validation = Array.prototype.filter.call(edit_basic_info_forms, function (form) {
            form.addEventListener('submit', function (event) {
                $('#selected_temp_emp_hidden_value').val($("#temp_emp_select").val());
                let ph_no = $('#e_phone_no').val();
                let emergency_ph_no = $('#e_emergency_no').val();
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    toastMixin.fire({
                        icon: 'error',
                        animation: true,
                        title:'Error',
                        text: 'Please resolve all the error..!'
                    });
                } else if ($("#temp_emp_select").val() == "") {
                    event.preventDefault();
                    event.stopPropagation();
                    toastMixin.fire({
                        icon: 'error',
                        animation: true,
                        title:'Error',
                        text: 'Please Select Temporary Employee'
                    });
                } else if (ph_no==emergency_ph_no) {
                    event.preventDefault();
                    event.stopPropagation();
                    toastMixin.fire({
                        icon: 'error',
                        animation: true,
                        title:'Error',
                        text: 'Phone Number & Emergency Number cannot be same'
                    });
                } else {
                    $('#e_temp_emp_details_btn').html('');
                    $('#e_temp_emp_details_btn').attr('disabled', true);
                    $('#e_temp_emp_details_btn').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating...'
                    );
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
// function url_data(name) {
//     var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
//     if (results == null) {
//         return null;
//     } else {
//         return results[1] || 0;
//     }
// }