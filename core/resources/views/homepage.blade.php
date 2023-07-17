<!DOCTYPE html>
<html lang="en">

<head>
    <title>AppliUK</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="assets/images/logoIcon/favicon.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="frontend/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="frontend/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="frontend/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="frontend/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="frontend/css/util.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="assets/images/logoIcon/logo.png" alt="IMG">
                </div>

                <div class="login100-form validate-form">
                    <span class="login100-form-title">
                        Wellcome to AppliUK
                    </span>
                    <div class="container-login100-form-btn">
                        <button onclick="window.location.href='{{ route('agent.login') }}';" class="login100-form-btn">
                            Agent Login
                        </button>
                    </div>
                    <div class="container-login100-form-btn">
                        <button onclick="window.location.href='{{ route('student.login') }}';"
                            class="login100-form-btn">
                            Student Login
                        </button>
                    </div>
                    <div class="text-center p-t-136">
                        <a class="txt2" href="{{ route('apply.donor') }}">
                            Student Registration
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                        <hr>
                        <a class="txt2" href="{{ route('apply.agent') }}">
                            Agent Registration
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--===============================================================================================-->
    <script src="frontend/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="frontend/vendor/bootstrap/js/popper.js"></script>
    <script src="frontend/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="frontend/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="frontend/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>

</html>
