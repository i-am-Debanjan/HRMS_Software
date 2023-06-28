const valid_date = new Date($('#temp_emp_account_validity').val() * 1000);
countDownTimer(valid_date);

temp_emp_greet();
temp_emp_notification();

basic_details_check(0);
// select_emp_avtar();

function countDownTimer(date) {
    var elem = $('#countDown');
    var futureTime = new Date(date).getTime();

    setInterval(function () {
        var timeLeft = Math.floor((futureTime - new Date().getTime()) / 1000);
        if (timeLeft == 0) {
            window.location.href = "http://localhost:8000/user_account_locked";
        }
        var days = Math.floor(timeLeft / 86400);
        timeLeft -= days * 86400;
        var hours = Math.floor(timeLeft / 3600) % 24;
        timeLeft -= hours * 3600;
        var min = Math.floor(timeLeft / 60) % 60;
        timeLeft -= min * 60;
        var sec = timeLeft % 60;
        var timeString = "<span class='days'>" + days + " Days " + "</span>" +
            "<span class='hours'>" + hours + " Hours " + "</span>" +
            "<span class='minutes'>" + min + " Min. " + "</span>" +
            "<span class='seconds'>" + sec + " Sec. " + "</span>";

        elem.html(timeString);

    }, 1000);
}

function temp_emp_greet() {
    var myDate = new Date();
    var hrs = myDate.getHours();
    var greet;

    if (hrs < 12)
        greet = '<i class="fas fa-coffee"></i> Good Morning';
    else if (hrs >= 12 && hrs < 17)
        greet = '<i class="fas fa-sun"></i> Good Afternoon';
    else if (hrs >= 17 && hrs <= 24)
        greet = '<i class="fas fa-moon"></i> Good Evening';

    document.getElementById('greetings').innerHTML = '<b>' + greet + '</b>';
}

// function select_emp_avtar(){

// }

function temp_emp_notification() {
    $.ajax({
        url: "/fetch_temp_emp_notification",
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function (data) {
            // console.log(data['data']);
            if (data['status'] == 1) {
                let notification = '';
                let notifictaion_count=data['data'].length;
                if (notifictaion_count == 0) {
                    notification += '<li class="list-group-item">No Notification Available</li>';
                } else {
                    $.each(data['data'], function (index, val) {
                        notification += '<li class="list-group-item fw-bold text-dark"><span class="h6">' + val.notification_title + '</span><a class="ms-2 float-end" data-bs-toggle="collapse" href="#notification_details_collapse'+val.id+'" role="button" data-bs-auto-close="false" onclick="event.stopPropagation();">Details</a><span class=" float-end" id="check_notification"></span>';
                        notification += '<div class="collapse" id="notification_details_collapse'+val.id+'">';
                        notification += '<div class="card bg-transparent " style="box-shadow: none;">';
                        if( val.notification_content==null)
                        {
                            val.notification_content="No Details Available";
                        }
                        notification += val.notification_content;
                        notification += '</div>';
                        notification += '</div></li>';
                    });
                }
                $('#notification_placeholder').html(notification);
                $('#notification_count').html(notifictaion_count);
            }
        }
    });
}

function basic_details_check(value) {
    $.ajax({
        url: "/application_submission_check",
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function (data) {
            if (data['status'] == 1) {
                if (value == 0) {
                    $('#menu_doc_upload').removeClass('visually-hidden');
                } else if (value == 1) {
                    $('#menu_doc_upload').removeClass('visually-hidden');
                    $('#job_application_form').addClass('visually-hidden');
                    $('#new_job_application_form').removeClass('visually-hidden');
                } else if (value == 2) {
                    $('#job_application_form_badge').removeClass('bg-label-warning');
                    $('#job_application_form_badge').addClass('bg-label-success');
                    $('#job_application_form_badge').html('Completed');
                    $('#job_application_form_checkbox').attr('checked', true);
                    $('#job_application_form_fill_now').addClass('visually-hidden');
                    $('#dash_click_to_upload_btn').removeClass('visually-hidden');
                }
            } else {
                $('#menu_doc_upload').addClass('visually-hidden');
                $('#job_application_form_badge').addClass('bg-label-warning');
                $('#job_application_form_badge').removeClass('bg-label-success');
                $('#job_application_form_badge').html('Pending');
                $('#job_application_form_checkbox').attr('checked', false);
                $('#job_application_form_fill_now').removeClass('visually-hidden');
            }
        }
    });
}