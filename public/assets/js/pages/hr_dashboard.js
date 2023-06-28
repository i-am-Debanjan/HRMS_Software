$('#hr_dashboard').addClass('active');
$('#count_all_dash_emp').each(function () {


    $(this).prop('Counter',0).animate({

        Counter: $(this).text()

    }, {

        duration: 5000,

        easing: 'swing',

        step: function (now) {

            $('#count_dash_emp').text(Math.ceil(now));

        }

    });

});

$('#count_all_dash_temp_emp').each(function () {

    $(this).prop('Counter',0).animate({

        Counter: $(this).text()

    }, {

        duration: 5000,

        easing: 'swing',

        step: function (now) {

            $('#count_dash_temp_emp').text(Math.ceil(now));

        }

    });

});
