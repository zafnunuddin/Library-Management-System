<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Forgot Password - Library LMS</title>

    <!-- Font Awesome -->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}"
          rel="stylesheet">

    <!-- SB Admin 2 -->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}"
          rel="stylesheet">

    <style>

        body {
    min-height: 100vh;

    background-image: url('{{ asset('images/Background.jpg') }}');
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 20px;
}
        .forgot-card {
            width: 100%;
            max-width: 450px;

            background: #ffffff;

            border-radius: 15px;

            padding: 35px;

            box-shadow:
                0 15px 40px rgba(0,0,0,0.25);
        }

        .forgot-icon {
            width: 75px;
            height: 75px;

            margin: 0 auto 20px;

            border-radius: 50%;

            background: #205ce8;

            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 30px;
        }

        .forgot-title {
            text-align: center;

            font-weight: 700;

            color: #04102a;

            margin-bottom: 8px;
        }

        .forgot-text {
            text-align: center;

            color: #6c757d;

            font-size: 14px;

            margin-bottom: 25px;
        }

        .form-control {
            height: 48px;

            border-radius: 8px;
        }

        .btn-reset {
            height: 48px;

            border-radius: 8px;

            background: #205ce8;

            border: none;

            color: white;

            font-weight: 600;
        }

        .btn-reset:hover {
            background: #1749bd;

            color: white;
        }

        .back-login {
            text-align: center;

            margin-top: 20px;
        }

        .back-login a {
            color: #205ce8;

            font-weight: 600;

            text-decoration: none;
        }

        .back-login a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {

            .forgot-card {
                padding: 25px 20px;
            }

            .forgot-icon {
                width: 65px;
                height: 65px;

                font-size: 25px;
            }

        }

    </style>

</head>

<body>

    <div class="forgot-card">

        <!-- Icon -->
        <div class="forgot-icon">

            <i class="fas fa-lock"></i>

        </div>


        <!-- Title -->
        <h3 class="forgot-title">

            Forgot Password?

        </h3>


        <p class="forgot-text">

            Enter your registered email address and
            we will send you a password reset link.

        </p>


        <!-- Success Message -->

        @if(session('success'))

            <div class="alert alert-success">

                <i class="fas fa-check-circle mr-1"></i>

                {{ session('success') }}

            </div>

        @endif


        <!-- Error Message -->

        @if($errors->any())

            <div class="alert alert-danger">

                @foreach($errors->all() as $error)

                    <div>

                        <i class="fas fa-exclamation-circle mr-1"></i>

                        {{ $error }}

                    </div>

                @endforeach

            </div>

        @endif


        <!-- Form -->

        <form method="POST"
              action="{{ route('password.email') }}">

            @csrf


            <div class="form-group">

                <label class="font-weight-bold">

                    Email Address

                </label>

                <div class="input-group">

                    <div class="input-group-prepend">

                        <span class="input-group-text">

                            <i class="fas fa-envelope"></i>

                        </span>

                    </div>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Enter your email"
                        value="{{ old('email') }}"
                        required
                        autofocus>

                </div>

            </div>


            <button
                type="submit"
                class="btn btn-reset btn-block">

                <i class="fas fa-paper-plane mr-2"></i>

                Send Reset Link

            </button>

        </form>


        <!-- Back to Login -->

        <div class="back-login">

            <a href="{{ route('login') }}">

                <i class="fas fa-arrow-left mr-1"></i>

                Back to Login

            </a>

        </div>

    </div>


    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>