<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CarProject Admin - Registration</title>

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
background: #182539;
background: -webkit-linear-gradient(to right, #182539, #182539); 
  background: linear-gradient(to right, #182539, #182539);
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
                                    <h1 class="h4 text-gray-900 mb-4">Car Project Registration</h1>
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
                                <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
    <x-input id="name" class="form-control form-control-user" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter Your Name..." />
</div>

<div class="form-group">
    <x-input id="email" class="form-control form-control-user" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter Email Address..." />
</div>

<div class="form-group input-group">
    <x-input id="password" class="form-control form-control-user" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
    <div class="input-group-append">
        <span class="input-group-text" onclick="togglePassword('password', 'togglePasswordIcon1')">
            <i class="fas fa-eye" id="togglePasswordIcon1"></i>
        </span>
    </div>
</div>

<div class="form-group input-group">
    <x-input id="password_confirmation" class="form-control form-control-user" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Password Confirmation" />
    <div class="input-group-append">
        <span class="input-group-text" onclick="togglePassword('password_confirmation', 'togglePasswordIcon2')">
            <i class="fas fa-eye" id="togglePasswordIcon2"></i>
        </span>
    </div>
</div>


<div class="form-group">
    <div class="custom-control custom-checkbox small">
        <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
        <label class="custom-control-label" for="customCheck">Remember Me</label>
    </div>
</div>

<input type="submit" value="Register" class="btn btn-user btn-block" style="background: #182539; background: -webkit-linear-gradient(to right, #182539, #182539); background: linear-gradient(to right, #182539, #182539);">
                                  
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
    function togglePassword(fieldId, iconId) {
        var passwordField = document.getElementById(fieldId);
        var toggleIcon = document.getElementById(iconId);
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
