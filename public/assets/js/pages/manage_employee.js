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
var url_id=$('#url_id').val();
$('#hr_main_title').html('Manage Employees');
$('#hr_hr').addClass('active');
$('#hr_hr').addClass('open');
$('#hr_hr_manage_emp').addClass('active');
fetch_edit_emp_details(url_id);
$("#emp_select").select2();
$("#select_l1").select2();
$("#select_l2").select2();
$("#select_l3").select2();
$("#emp_select").val(url_id).trigger('change');
$("#emp_select").on("change", function(e) {
    fetch_edit_emp_details($("#emp_select").val());
});
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var assign_leaders_form = $('#assign_leaders_form');
        // var edit_forms = $('#edit_designation_form');
        // Loop over them and prevent submission
        var create_forms_validation = Array.prototype.filter.call(assign_leaders_form, function(form) {
            form.addEventListener('submit', function(event) {
                $('#emp_id_leader_hidden').val($("#emp_select").val());
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    toastMixin.fire({
                        icon: 'error',
                        animation: true,
                        title: 'Please resolve all the error..!'
                    });
                } else if ($("#emp_select").val() == "") {
                    event.preventDefault();
                    event.stopPropagation();
                    toastMixin.fire({
                        icon: 'error',
                        animation: true,
                        title: 'Please Select Employee'
                    });
                } else {
                    $('#assign_leader_btn').html('');
                    $('#assign_leader_btn').attr('disabled', true);
                    $('#assign_leader_btn').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Assigning...'
                    );
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

function fetch_edit_emp_details(emp_id) {
    if (emp_id == "") {
        $('#f_name').val('');
        $('#l_name').val('');
        $('#employee_email').val('');
        $('#employee_ph').val('');
        $('#employee_emergency_ph').val('');
        // $('#employee_joining_date').val();
        $('#select_designation').val('');
        $('#select_department').val('');
        $('#login_username').val('');
        $('#login_pass').val('');
        $('#login_cpass').val('');
    } else {
        $.ajax({
            url: "/edit_employee_details",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { employee_id: emp_id },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $.each(data, function(index, val) {
                    $('#f_name').val(val.f_name);
                    $('#l_name').val(val.l_name);
                    $('#employee_email').val(val.email);
                    $('#employee_ph').val(val.phone_number);
                    $('#employee_emergency_ph').val(val.emergency_no);
                    var timestamp = val.joining_date;
                    var date = new Date(timestamp * 1000);
                    $('#employee_joining_date').val(date.toLocaleString('af-ZA').slice(0, 10));
                    $('#select_designation').val(val.designation_id);
                    $('#select_department').val(val.department_id);
                    $('#login_username').val(val.username);
                    // $('#login_pass').val(val.password);
                    // $('#login_cpass').val();
                    $("#select_l1").val(val.emp_l1).trigger('change');
                    $("#select_l2").val(val.emp_l2).trigger('change');
                    $("#select_l3").val(val.emp_l3).trigger('change');
                });

            }
        });
    }
}

// function url_data(name) {
//     var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
//     if (results == null) {
//         return null;
//     } else {
//         return results[1] || 0;
//     }
// }