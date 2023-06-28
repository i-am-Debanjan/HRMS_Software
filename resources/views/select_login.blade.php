<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Select who you are</title>

    <link rel="stylesheet" href="../assets/css/select_login.css">

    <!-- Font Awesome -->

    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('pwa.pwa_hr_view')

</head>

<body>

    <div class="container">

        {{-- <div class="row text-center mb-100 ">

            <h1>Select Who You Are?</h1>

        </div> --}}

        <div class="row">

            <div class="col-md-12 d-flex justify-content-center">

                <h1 class=" mt-100">Select Who You Are?</h1>

            </div>

            <div class="col-md-12 d-flex justify-content-center ">

                <div class="p-2">

                    <a href="/hr_login" class="round_btn mt_center" id="install">

                        {{-- <i class="fas fa-home"></i> --}}

                        <span class="fas">HR</span>

                    </a>

                </div>

                <div class="p-2">

                    <a href="/emp_login" class="round_btn mt_center">

                        <span class="fas">Employee</span>

                    </a>

                </div>
                <div id="content"> </div>

                {{-- <div class="p-2">

                    <a href="#" class="round_btn mt_center">

                        <i class="fas fa-home"></i>

                    </a>

                </div> --}}

            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    @include('pwa.pwa_install_app_modal')
    <script>
    if (!window.matchMedia('(display-mode: standalone)').matches) {  
    // do things here  
    // set a variable to be used when calling something  
    // e.g. call Google Analytics to track standalone use   

    }
    </script>
</body>

</html>
