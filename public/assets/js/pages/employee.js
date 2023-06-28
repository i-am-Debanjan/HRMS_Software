var toastMixin = Swal.mixin({
    toast: true,
    icon: 'success',
    title: 'General Title',
    animation: false,
    position: 'top-right',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
$('#count_all_emp').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
            $('#count_all_emp_p').text(Math.ceil(now));
        }
    });
});
$('#count_all_temp_emp').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
            $('#count_all_temp_emp_p').text(Math.ceil(now));
        }
    });
});
$('#hr_main_title').html('Employees');
$('#hr_hr').addClass('active');
$('#hr_hr').addClass('open');
$('#hr_hr_emp').addClass('active');
$('#login_cpass').keyup(function () {
    let pass = $('#login_pass').val();
    let c_pass = $(this).val();
    if (c_pass != pass) {
        $(this).removeClass("is-valid");
        $(this).addClass("is-invalid");
    } else {
        $(this).removeClass("is-invalid");
        $(this).addClass("is-valid");
    }
});

// $("#login_username").keyup(function() {
//     let data = $(this).val();
//     if (data.length >= 6) {
//         checking_username(data);
//     }
// });
// $("#temp_login_username").keyup(function() {
//     let data = $(this).val();
//     if (data.length > 3) {
//         checking_username(data);
//     }
// });

// function checking_username(username) {
//     $('#username_span').html('<i class="fas fa-user-cog"></i> Login Username  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Loading...</span> Checking...')
//     $.ajax({
//         url: "/checking_username",
//         method: 'POST',
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         data: {
//             username: username,
//         },
//         dataType: 'json',
//         success: function(data) {
//             if (data['status'] == 1) {
//                 $('#username_span').html('<i class="fas fa-user-cog"></i> Login Username <span class="text-success ml-3"><i class="fas fa-check"></i> Available</span>');
//             } else {
//                 $('#username_span').html('<i class="fas fa-user-cog"></i> Login Username <span class="text-danger ml-3"><i class="fas fa-times"></i> Already taken</span>');
//             }
//         }
//     });
// }
(function () {
    'use strict';
    window.addEventListener('load', function () {
        var create_forms = $('#create_employee_form');
        var create_temp_forms = $('#create_temp_employee_form');
        // Loop over them and prevent submission
        var create_forms_validation = Array.prototype.filter.call(create_forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    toastMixin.fire({
                        icon: 'error',
                        animation: true,
                        title: 'Please resolve all the error..!'
                    });
                } else if (document.getElementById("login_pass").value != document.getElementById("login_cpass").value) {
                    event.preventDefault()
                    toastMixin.fire({
                        icon: 'error',
                        animation: true,
                        title: 'Confirm Password Should be same as Password'
                    });
                } else {
                    $('#create_temp_employee_btn').html('');
                    $('#create_temp_employee_btn').attr('disabled', true);
                    $('#create_temp_employee_btn').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating...'
                    );
                }
                form.classList.add('was-validated');
            }, false);
        });
        var create_temp_forms_validation = Array.prototype.filter.call(create_temp_forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    toastMixin.fire({
                        icon: 'error',
                        animation: true,
                        title: 'Please resolve all the error..!'
                    });
                } else {
                    $('#create_employee_btn').html('');
                    $('#create_employee_btn').attr('disabled', true);
                    $('#create_employee_btn').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating...'
                    );
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

function open_extend_time_modal(temp_emp_id) {
    $('#extend_time_modal_placeholder').empty();
    $.ajax({
        url: "/fetch_temp_emp_details",
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { temp_emp_id: temp_emp_id },
        dataType: 'json',
        success: function (data) {
            var ext_time_modal = '';
            $.each(data, function (index, val) {
                let unixTime = val.valid_till;
                let date = new Date(unixTime * 1000);
                ext_time_modal += '<div class="col-md-12 mb-2">';
                ext_time_modal += '<label for="valid_till_id" class="form-label">Valid till</label>';
                ext_time_modal += '<input type="hidden" value="' + val.email + '" name="temp_emp_email">';
                ext_time_modal += '<input type="hidden" value="' + val.username + '" name="temp_emp_username">';
                ext_time_modal += '<input type="hidden" value="' + val.id + '" name="temp_emp_id">';
                ext_time_modal += '<input type="datetime-local" class="form-control" id="valid_till_id" name="extended_time" min="' + getDateFormat(date) + '" value="' + getDateFormat(date) + '">';
                ext_time_modal += '</div>';
                ext_time_modal += '<div class="col-md-12">';
                ext_time_modal += '<label for="change_message" class="form-label">Message</label>';
                ext_time_modal += '<input type="text" class="form-control" id="change_message" name="change_message" placeholder="Enter Message" autocomplete="off">';
                ext_time_modal += '</div>';
                ext_time_modal += '<div class="col-md-12 mt-2">';
                ext_time_modal += '<button type="submit" class="ms-2 float-end btn btn-success fw-bold"><i class="fas fa-check-circle"></i> Confirm</button>';
                ext_time_modal += '<button type="button" class="btn float-end btn-danger fw-bold" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Close</button>';
                ext_time_modal += '</div>';
            });
            $('#extend_time_modal_placeholder').html(ext_time_modal);
        }
    });
}
function getDateFormat(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    hours = d.getHours();
    minutes = d.getMinutes();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;
    if (minutes.length < 2)
    minutes = '0' + minutes;
    if (minutes<10)
    minutes = '0' + minutes;
    var date = new Date();
    date.toLocaleDateString();
    full_date = [year, month, day].join('-');
    full_time = [hours, minutes].join(':');
    final_datetime = full_date + ' ' + full_time;
    return final_datetime;
}
$(document).ready(function () {
    $('#employee_list_table').DataTable({
        dom: 'frtp'
    });
    $('#temp_employee_list_table').DataTable({
        dom: 'frtp'
    });

});