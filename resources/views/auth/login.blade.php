<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CarProject Admin - Login</title>

    <!-- Custom fonts for this template-->
    @include('admin.body.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 2rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #4e73df;
        }

        .btn-login {
            background-color: #4e73df;
            border: none;
            color: white;
        }

        .btn-login:hover {
            background-color: #2e59d9;
        }

        .input-group {
            position: relative;
        }

        .input-group-text {
            cursor: pointer;
        }

        .input-group-text i {
            pointer-events: none;
        }

    </style>
</head>

<body class="" style="
  background: #ff6600; /* Fallback color (Orange) */
  background: -webkit-linear-gradient(to right, #ff6600, #ff6600); /* Safari 5.1 to 6.0 */
  background: linear-gradient(to right, #ff6600, #ff6600); /* Standard syntax */
">




    <div class="container login-container">
        <div class="col-xl-5 col-lg-6 col-md-8">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <center>
                                        <img src="{{asset('sitelogo/logo.jpg')}}" style="width: 150px;height:110px;" alt="">
                                    </center>
                                    <h6 style="font-size: 20px;" class="h4 text-gray-900 mb-4">{{ __('login.car_project_login') }}</h6>
                                    @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="{{ __('login.enter_email_address') }}">
                                    </div>
                                    <div class="form-group input-group">
                                        <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="{{ __('login.password') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="togglePassword()">
                                                <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">{{ __('login.remember_me') }}</label>
                                        </div>
                                    </div>


                                    <input type="submit" value="{{ __('login.login') }}" style="
background: #182539;
background: -webkit-linear-gradient(to right, #182539, #182539); 
  background: linear-gradient(to right, #182539, #182539);
" class="btn  btn-user btn-block btn-login">
                                  
                                </form>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    @include('admin.body.js')

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("exampleInputPassword");
            var toggleIcon = document.getElementById("togglePasswordIcon");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>
