<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>LMS Login</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}"
          rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background-image: url('{{ asset('images/Background.jpg') }}');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-color: #ffffff;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            width: 100%;
            max-width: 480px;
            padding: 20px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 18px;
            overflow: hidden;

            box-shadow:
                0 10px 35px rgba(0,0,0,0.20);
        }

        .login-header {
            background: #205ce8;
            color: white;

            text-align: center;

            padding: 30px 20px 25px;
        }

        .lms-logo {
            width: 75px;
            height: 75px;

            background: white;
            color: #205ce8;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 15px;

            font-size: 38px;
        }

        .login-header h2 {
            margin: 0;
            font-weight: 700;
        }

        .login-header p {
            margin: 6px 0 0;
            font-size: 15px;
        }

        .login-body {
            padding: 30px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
        }

        .form-control,
        .form-select {
            height: 48px;
            border-radius: 8px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #205ce8;

            box-shadow:
                0 0 0 0.15rem
                rgba(32,92,232,0.15);
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper .form-control {
            padding-right: 50px;
        }

        .password-toggle {
            position: absolute;

            right: 12px;
            top: 50%;

            transform: translateY(-50%);

            border: none;
            background: transparent;

            color: #666;

            cursor: pointer;

            font-size: 18px;
        }

        .login-btn {
            width: 100%;
            height: 50px;

            border: none;
            border-radius: 8px;

            background: #205ce8;
            color: white;

            font-size: 17px;
            font-weight: 600;

            transition: 0.2s;
        }

        .login-btn:hover {
            background: #174dcc;
        }

        .forgot-link {
            color: #205ce8;

            text-decoration: none;

            font-weight: 500;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .terms {
            font-size: 14px;
            color: #555;

            line-height: 1.6;

            margin-top: 15px;
        }

        .terms a {
            color: #205ce8;

            text-decoration: none;

            font-weight: 600;
        }

        .create-account {
            text-align: center;

            margin-top: 25px;
            padding-top: 20px;

            border-top: 1px solid #ddd;
        }

        .create-account p {
            margin-bottom: 10px;

            color: #444;
        }

        .create-btn {
            border: 1px solid #205ce8;

            color: #205ce8;

            background: white;

            padding: 8px 18px;

            border-radius: 6px;

            text-decoration: none;

            display: inline-block;
        }

        .create-btn:hover {
            background: #205ce8;
            color: white;

            text-decoration: none;
        }

        @media(max-width:600px) {

            .login-wrapper {
                padding: 15px;
            }

            .login-body {
                padding: 25px 20px;
            }

            .login-header h2 {
                font-size: 25px;
            }

        }

    </style>

</head>

<body>

<div class="login-wrapper">

    <div class="login-card">

        {{-- LMS Header --}}

        <div class="login-header">

            <div class="lms-logo">

                <img src="{{ asset('images/Logo.jpeg') }}" alt="LMS EDU Logo" style="width:100%;height:100%;object-fit:contain;border-radius:50%;">

            </div>

            <h2>LMS</h2>

            <p>Library Management System</p>

        </div>


        <div class="login-body">

            {{-- Login Errors --}}

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- Success Message --}}

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif


            {{-- LOGIN FORM --}}

            <form action="{{ route('login.post') }}"
                  method="POST">

                @csrf


                {{-- Email --}}

                <div class="mb-3">

                    <label class="form-label">

                        Email

                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Enter your email"
                        value="{{ old('email') }}"
                        required>

                </div>


                {{-- Password --}}

                <div class="mb-3">

                    <label class="form-label">

                        Password

                    </label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            placeholder="Enter your password"
                            required>

                        <button
                            type="button"
                            class="password-toggle"
                            onclick="togglePassword()">

                            <i
                                class="fas fa-eye"
                                id="eyeIcon">
                            </i>

                        </button>

                    </div>

                    

                </div>


                {{-- Role --}}

                <div class="mb-3">

                    <label class="form-label">

                        Login As

                    </label>

                    <select
                        name="role"
                        class="form-select"
                        required>

                        <option value="">
                            Select Role
                        </option>

                        <option value="user">
                            Student
                        </option>

                        <option value="admin">
                            Admin
                        </option>

                    </select>

                </div>


                {{-- Terms --}}

                <div class="terms">

                    By logging in, you agree to our

                    <a href="{{ route('terms') }}" target="_blank">
                        Terms
                    </a>

                    and

                    <a href="{{ route('privacy') }}" target="_blank">
                        Privacy Policy
                    </a>.

                </div>


                {{-- Login Button --}}

                <div class="mt-3">

                    <button
                        type="submit"
                        class="login-btn">

                        Login >>

                    </button>

                </div>


                {{-- Forgot Password --}}

                <div class="text-center mt-3">

                    <a href="{{ route('password.request') }}"
       style="font-size: 13px; color: #205ce8;">

                        Forgot Password?

                    </a>

                </div>

            </form>


            {{-- Register Link --}}

            <div class="create-account">

                <p>
                    Don't have an account?
                </p>

                <a
                    href="{{ route('register') }}"
                    class="create-btn">

                    Create an Account

                </a>

            </div>

        </div>

    </div>

</div>


<script>

function togglePassword()
{
    const password =
        document.getElementById('password');

    const icon =
        document.getElementById('eyeIcon');


    if(password.type === 'password')
    {
        password.type = 'text';

        icon.classList.remove('fa-eye');

        icon.classList.add('fa-eye-slash');
    }
    else
    {
        password.type = 'password';

        icon.classList.remove('fa-eye-slash');

        icon.classList.add('fa-eye');
    }
}

</script>

</body>

</html>