<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Reset Password - Library LMS</title>

    <!-- Font Awesome -->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}"
          rel="stylesheet">

    <!-- SB Admin 2 -->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}"
          rel="stylesheet">


    <style>

        body {
            min-height: 100vh;

            background: linear-gradient(
                135deg,
                #04102a,
                #205ce8
            );

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 20px;
        }


        .reset-card {
            width: 100%;

            max-width: 450px;

            background: #ffffff;

            border-radius: 15px;

            padding: 35px;

            box-shadow:
                0 15px 40px rgba(0,0,0,0.25);
        }


        .reset-icon {
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


        .reset-title {
            text-align: center;

            font-weight: 700;

            color: #04102a;

            margin-bottom: 8px;
        }


        .reset-text {
            text-align: center;

            color: #6c757d;

            font-size: 14px;

            margin-bottom: 25px;
        }


        .form-control {
            height: 48px;

            border-radius: 8px;
        }


        .input-group .form-control {
            border-top-left-radius: 0;

            border-bottom-left-radius: 0;
        }


        .input-group-text {
            height: 48px;

            background: #f8f9fc;

            border-radius: 8px 0 0 8px;
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


        .password-help {
            font-size: 12px;

            color: #6c757d;

            margin-top: 5px;
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

            .reset-card {
                padding: 25px 20px;
            }

            .reset-icon {
                width: 65px;

                height: 65px;

                font-size: 25px;
            }

        }

    </style>

</head>


<body>


    <div class="reset-card">


        <!-- Icon -->

        <div class="reset-icon">

            <i class="fas fa-key"></i>

        </div>


        <!-- Title -->

        <h3 class="reset-title">

            Reset Password

        </h3>


        <p class="reset-text">

            Create a new secure password for your
            Library Management System account.

        </p>


        <!-- Errors -->

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


        <!-- Reset Form -->

        <form method="POST"
              action="{{ route('password.update') }}">

            @csrf


            <!-- Token -->

            <input
                type="hidden"
                name="token"
                value="{{ $token }}">


            <!-- Email -->

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
                        value="{{ old('email', $email) }}"
                        placeholder="Enter your email"
                        required
                        autofocus>

                </div>

            </div>


            <!-- New Password -->

            <div class="form-group">

                <label class="font-weight-bold">

                    New Password

                </label>

                <div class="input-group">

                    <div class="input-group-prepend">

                        <span class="input-group-text">

                            <i class="fas fa-lock"></i>

                        </span>

                    </div>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter new password"
                        required>

                </div>

                <div class="password-help">

                    Password must contain at least 8 characters.

                </div>

            </div>


            <!-- Confirm Password -->

            <div class="form-group">

                <label class="font-weight-bold">

                    Confirm New Password

                </label>

                <div class="input-group">

                    <div class="input-group-prepend">

                        <span class="input-group-text">

                            <i class="fas fa-lock"></i>

                        </span>

                    </div>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Confirm new password"
                        required>

                </div>

            </div>


            <!-- Submit -->

            <button
                type="submit"
                class="btn btn-reset btn-block">

                <i class="fas fa-check mr-2"></i>

                Reset Password

            </button>

        </form>


        <!-- Back Login -->

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