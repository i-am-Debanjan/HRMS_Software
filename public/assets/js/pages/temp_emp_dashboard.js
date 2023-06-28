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
// const verticalExample = document.getElementById('vertical-example');
// new PerfectScrollbar(verticalExample, {
//     wheelPropagation: false
//   });
// console.log();
uploaded_document_check();
basic_details_check(2);
$('#menu_dashboard').addClass('active');
$('#todo_add_modal').prop('disabled', true);
$('#todo_content_refresh').html('<i class="fas fa-sync"></i>Refreshing List');
Refresing_todo_item();
$('#add_todo_content_btn').click(function () {
    let todo_content = $('#todo_content').val();
    document.getElementById("add_todo_content_close_modal_btn").click();
    // $('#todo_add_modal').prop('disabled', true);
    // $('#todo_add_modal').html('<i class="fas fa-sign-in-alt"></i> Adding ');
    // $('#todo_add_modal').html('<i class="fas fa-plus"></i> Add');
    $.ajax({
        url: "/add_todo_item",
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { todo_content: todo_content },
        // contentType: false,
        // processData: false,
        dataType: 'json',
        success: function (data) {
            // console.log(data);
            if (data['status'] == 1) {
                Swal.fire({
                    icon: 'success',
                    position: 'top-end',
                    title: data['message'],
                    showConfirmButton: false,
                    timer: 1500
                });
                Refresing_todo_item();
            } else {
                // $('#todo_add_modal').prop('disabled', false);
                // $('#todo_add_modal').html('<i class="fas fa-plus"></i> Add');
            }
        }
    });
});
function Refresing_todo_item() {
    let html_main = '<li class="list-group-item text-white bg-warning">';
    html_main += 'Your To do list';
    html_main += '<span class="float-end"> <button class="btn btn-info  btn-sm" id="todo_add_btn"';
    html_main += 'data-bs-toggle="modal" data-bs-target="#todo_add_modal"> <i class="fas fa-plus"></i> Add';
    html_main += '</button></span>';
    html_main += '</li>';
    let html_change = '<li class="list-group-item text-center">No Item to show</li>';
    $.ajax({
        url: "/fetch_todo_item",
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function (data) {
            // console.log(data['data']);
            if (data['status'] == 1) {
                $.each(data['data'], function (index, value) {
                    html_change='';
                    html_change += '<li class="list-group-item">';
                    if(value.status==1){
                        html_change += '<input class="form-check-input me-1 " type="checkbox" id="item'+value.id+'" value="" onchange="todo_item_checked('+value.id+')" checked>';
                        html_change += '<span id="item_content'+value.id+'" class="text-decoration-line-through">'+value.todo_details+'</span>';
                    }else{
                        html_change += '<input class="form-check-input me-1" type="checkbox" id="item'+value.id+'" value="" onchange="todo_item_checked('+value.id+')">';
                        html_change += '<span id="item_content'+value.id+'" class="">'+value.todo_details+'</span>';
                    }
                    html_change += '<span class="badge float-end btn btn-danger btn-sm me-1 ms-1" onclick="todo_item_delete('+value.id+')"><i class="fas fa-trash"></i> </span>';
                    // html_change += '<span class="badge float-end btn btn-info  btn-sm"><i class="fas fa-pen"></i> </span>';
                    html_change += '</li>';
                });
                $('#to_do_item').html(html_change);
                $('#todo_add_modal').attr('disabled', false);
            } else {
                $('#todo_add_modal').prop('disabled', false);
                $('#todo_add_modal').html('<i class="fas fa-plus"></i> Add');
            }
        }
    });
}
function todo_item_checked(id){
    // console.log(id);
    var check_value='';
    if($('#item'+id).is(':checked')){
       check_value=1;
       $('#item_content'+id).addClass('text-decoration-line-through');
    }else{
        check_value=0;
        $('#item_content'+id).removeClass('text-decoration-line-through');
    }
    $.ajax({
        url: "/todo_item_checked",
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{check_value:check_value,id:id},
        dataType: 'json',
        success: function (data) {
            // console.log(data['data']);
            // if (data['status'] == 1) {
                
            // } else {
            //     // $('#item'+id).prop('checked', false);
            // }
        }
    });
}
function todo_item_delete(id){
    Swal.fire({
        title: 'Are you sure?',
        text: "Once's Deleted won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/todo_item_delete",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{id:id},
                dataType: 'json',
                success: function (data) {
        
                    Refresing_todo_item();
        
                }
            });
        }
      })
}
function uploaded_document_check(){
    $.ajax({
        url: "/uploaded_document_check",
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function (data) {
            // console.log(data);
            $.each(data, function (index, value) {
                if(value.status==1){
                    $('#doc_category_item'+value.doc_name_id).removeClass('bg-label-warning');
                    $('#doc_category_item'+value.doc_name_id).addClass('bg-label-success');
                    $('#doc_category_item'+value.doc_name_id).html('<i class="fas fa-check-circle"></i> Approved');
                    $('#doc_category_checkbox'+value.doc_name_id).attr('checked',true);
                }else{
                $('#doc_category_item'+value.doc_name_id).removeClass('bg-label-warning');
                $('#doc_category_item'+value.doc_name_id).addClass('bg-label-success');
                $('#doc_category_item'+value.doc_name_id).html('Completed');
                $('#doc_category_checkbox'+value.doc_name_id).attr('checked',true);
                }
            });
        }
    });
}
