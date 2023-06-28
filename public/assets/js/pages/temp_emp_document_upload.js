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
$('#menu_doc_upload').addClass('active');
document_upload_check();
function document_upload_check() {
    var selected_type = $('#selected_doc_type').val();
    var selected_type_name = $('#selected_doc_type option:selected').html();
    if (selected_type == "") {
        $('#upload_temp_emp_doc').empty();
        $('#upload_section').empty();
    } else {
        var html2 = '';
        $.ajax({
            url: "/temp_emp_doc_check",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { selected_type: selected_type, selected_type_name: selected_type_name },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data['data'] == "") {
                    $('#upload_temp_emp_doc').empty();
                    $('#upload_section').empty();
                    let html = '';
                    html += '<form class="" id="upload_temp_emp_doc" action="/upload_temp_emp_doc" method="POST" novalidate>'
                    html += '<div class="d-flex  col-md-12 flex-column flex-md-row bd-highlight">';
                    html += '<div class="p-2 flex-fill bd-highlight">';
                    html += '<input class="form-control" type="file" id="upload_docfile" name="emp_doc_file" accept=".pdf" required >';
                    html += '<input class="form-control" type="hidden" id="selected_type_name" name="selected_type_name"  required >';
                    html += '<input class="form-control" type="hidden" id="selected_type_id" name="selected_type_id"  required >';
                    html += '<div class="invalid-feedback">';
                    html += 'Please choose a pdf File.';
                    html += '</div>';

                    html += '</div>';
                    html += '<div class="p-2  flex-shrink-1 bd-highlight">';
                    html += '<button class="btn btn-success float-end" id="upload_btn"><i class="fas fa-cloud-upload-alt"></i> Upload</button>';
                    html += '</div>';
                    html += '</div>';
                    html += '</form>';
                    $('#upload_temp_emp_doc').html(html);
                    $('#selected_type_id').val(selected_type);
                    $('#selected_type_name').val(selected_type_name);
                } else {
                    $('#upload_temp_emp_doc').empty();
                    $('#upload_section').empty();
                    $.each(data['data'], function (index, val) {
                        html2 += '<div class="d-flex  col-md-12 flex-column flex-md-row bd-highlight">';
                        html2 += '<div class="flex-fill bd-highlight">';
                        if (val.status == 0) {
                            html2 += '<h4 class="ms-4 mt-2">Already Uploaded <span class="text-warning" title="Pending For Approval"><i class="fas fa-clock"></i> Pending</span></h4>';
                        } else if (val.status == 1) {
                            html2 += '<h4 class="ms-4 mt-2">Already Uploaded <span class="text-success" title="Approved"><i class="fas fa-check-circle"></i> Approved</span></h4>';
                        }
                        html2 += '</div>';
                        html2 += '<div class="p-2 flex-fill  bd-highlight">';
                        html2 += '<a href="' + val.doc_url + '" target="_blank"><button class="btn btn-success float-end me-lg-4" id="hlw"><i class="fas fa-eye"></i> View</button>';
                        html2 += '</div>';
                        html2 += '</div>';
                        $('#upload_section').html(html2);
                        // return false;
                    });
                }


            }
        });
    }
}
(function () {
    'use strict';
    window.addEventListener('load', function () {
        var upload_form = $('#upload_temp_emp_doc_form');
        // Loop over them and prevent submission
        var create_forms_validation = Array.prototype.filter.call(upload_form, function (form) {
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
                    $('#upload_btn').html('');
                    $('#upload_btn').attr('disabled', true);
                    $('#upload_btn').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Uploading...'
                    );
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();