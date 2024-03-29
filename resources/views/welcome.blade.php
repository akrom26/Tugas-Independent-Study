<!DOCTYPE html>
<html lang="en">

<head>
    <title>SIAKAD</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="{{asset('login/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css"')}}>
    <link rel=" stylesheet" type="text/css" href="{{asset('login/assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login/assets/vendor/animate/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login/assets/vendor/css-hamburgers/hamburgers.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login/assets/vendor/animsition/css/animsition.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login/assets/vendor/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login/assets/vendor/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login/assets/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login/assets/css/main.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

<body style="background-color: #00800d;">
    <div class="flash-data" data-flashdata="{{session('flash')}}"></div>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" action="{{Route('loginProcess')}}">
                    @csrf
                    <span class="login100-form-title p-b-43">
                        <b style="color: #00800d;">Silahkan Login 1</b>
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="username">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Username</span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </form>

                <div class="login100-more" style="">
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('login/assets/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('login/assets/vendor/animsition/js/animsition.min.js')}}"></script>
    <script src="{{asset('login/assets/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{asset('login/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('login/assets/vendor/select2/select2.min.js')}}"></script>
    <script src="{{asset('login/assets/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('login/assets/vendor/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('login/assets/vendor/countdowntime/countdowntime.js')}}"></script>
    <script src="{{asset('login/assets/js/main.js')}}"></script>
    <script>
        const flashdata = $('.flash-data').data('flashdata');

        if (flashdata == 'errorLogin') {
            Swal.fire({
                title: 'Gagal',
                text: 'Proses login gagal. Username atau password salah',
                icon: 'error'
            });
        }
    </script>

</body>

</html>