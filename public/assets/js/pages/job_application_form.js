var toastMixin = Swal.mixin({
    toast: true,
    icon: 'success',
    title: 'General Title',
    animation: true,
    position: 'top-right',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: false,
    // didOpen: (toast) => {
    //     toast.addEventListener('mouseenter', Swal.stopTimer)
    //     toast.addEventListener('mouseleave', Swal.resumeTimer)
    // }
});
basic_details_check(1);
$('#submit_job_application_btn').removeClass('disabled');
$('#menu_job_application').addClass('active');
function gender_choose() {
    let name_prefix = $("#name_prefix").val();
    if (name_prefix == "Mr.") {
        $("#selected_gender").val("male").trigger('change');
    } else if (name_prefix == "Mrs.") {
        $("#selected_gender").val("female").trigger('change');
    } else if (name_prefix == "Ms.") {
        $("#selected_gender").val("female").trigger('change');
    } else {
        $("#selected_gender").val("").trigger('change');
    }
}
function confirm_and_submit_form() {
    Swal.fire({
        title: 'Are you sure?',
        text: "Once Submit You cannot change it",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#confirm_form_id').val(1);
            $('#job_application_form').submit();
        }
    });
    $(".swal2-container").css("z-index", "10000");
}
(function () {
    'use strict';
    window.addEventListener('load', function () {
        var create_forms = $('#job_application_form');
        // Loop over them and prevent submission
        var create_forms_validation = Array.prototype.filter.call(create_forms, function (form) {
            form.addEventListener('submit', function (event) {
                var phone_no = $('#phone_no').val();
                var emergency_no = $('#emergency_no').val();
                var confirm_form_id = $('#confirm_form_id').val();
                //==================================================
                let name_prefix = $('#name_prefix').val();
                let f_name = $('#f_name').val();
                let l_name = $('#l_name').val();
                let selected_gender = $('#selected_gender').val();
                let dob = $('#dob').val();
                let father_name = $('#father_name').val();
                let mother_name = $('#mother_name').val();
                let current_address = $('#current_address').val();
                let parmanent_address = $('#parmanent_address').val();

                //==================================================
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    toastMixin.fire({
                        icon: 'error',
                        title: 'Please resolve all the error..!'
                    });
                } else if (phone_no == emergency_no) {
                    console.log(phone_no);
                    console.log(emergency_no);
                    event.preventDefault();
                    event.stopPropagation();
                    toastMixin.fire({
                        icon: 'error',
                        title: 'Phone number & Emergency Number Cannot be Same'
                    });
                } else if (confirm_form_id == 0) {
                    event.preventDefault();
                    event.stopPropagation();
                    $('#name_prefix_preview').html(name_prefix);
                    $('#f_name_preview').html(f_name);
                    $('#l_name_preview').html(l_name);
                    $('#selected_gender_preview').html(selected_gender);
                    $('#dob_preview').html(dob);
                    $('#phone_no_preview').html(phone_no);
                    $('#emergency_no_preview').html(emergency_no);
                    $('#father_name_preview').html(father_name);
                    $('#mother_name_preview').html(mother_name);
                    $('#current_address_preview').html(current_address);
                    $('#parmanent_address_preview').html(parmanent_address);
                    $('#Preview_form_modal').modal('show');
                    // Swal.fire({
                    //     title: 'Are you sure?',
                    //     text: "You won't be able to revert this!",
                    //     icon: 'warning',
                    //     showCancelButton: true,
                    //     confirmButtonColor: '#3085d6',
                    //     cancelButtonColor: '#d33',
                    //     confirmButtonText: 'Yes, delete it!'
                    // }).then((result) => {
                    //     if (result.isConfirmed) {
                    //         $('#confirm_form_id').val(1);
                    //         $('#job_application_form').submit();
                    //     }
                    // });


                    // $('#submit_job_application_btn').html('');
                    // $('#submit_job_application_btn').attr('disabled', true);
                    // $('#submit_job_application_btn').html(
                    //     '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...'
                    // );
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();