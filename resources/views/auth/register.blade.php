<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LMS - Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}"
          rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

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
            color: #222;
        }

        .register-wrapper {
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 15px;
        }

        .register-container {
            width: 100%;
            max-width: 760px;
        }

        .register-header {
            background: #205ce8;
            color: #fff;
            text-align: center;
            padding: 35px 20px 30px;
            border-radius: 20px 20px 0 0;
        }

        .lms-logo {
            width: 78px;
            height: 78px;
            background: #fff;
            color: #205ce8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 40px;
        }

        .register-header h2 {
            margin: 0;
            font-size: 34px;
            font-weight: 700;
            color: #fff;
        }

        .register-header p {
            margin: 7px 0 0;
            font-size: 16px;
            color: #fff;
        }

        .register-card {
            background: #fff;
            border-radius: 0 0 20px 20px;
            padding: 40px 55px;
            box-shadow: 0 10px 35px rgba(0,0,0,.15);
            position: relative;
        }

        .top-arrow {
            position: absolute;
            top: -29px;
            left: 50%;
            transform: translateX(-50%);
            width: 58px;
            height: 58px;
            background: #205ce8;
            color: #fff;
            border: 5px solid #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            z-index: 5;
        }

        .register-heading {
            text-align: center;
            font-size: 30px;
            font-weight: 700;
            color: #222;
            margin: 10px 0 30px;
        }

        .form-label {
            color: #222;
            font-size: 17px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .required { color: #e3342f; }

        .form-control {
            width: 100%;
            height: 50px;
            border: 1px solid #d5d9e2;
            border-radius: 8px !important;
            font-size: 16px;
            padding: 10px 14px;
            color: #444;
            background: #fff;
        }

        .form-control:focus {
            border-color: #205ce8;
            box-shadow: 0 0 0 .15rem rgba(32,92,232,.15);
            outline: none;
        }

        .form-control::placeholder { color: #8a8f9c; }

        textarea.form-control {
            height: auto !important;
            min-height: 100px;
            resize: vertical;
        }

        .password-wrapper { position: relative; }

        .password-wrapper .form-control { padding-right: 55px; }

        .eye-btn {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #687386;
            font-size: 21px;
            cursor: pointer;
            padding: 4px;
        }

        .terms {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 15px 0 25px;
            color: #555;
            font-size: 14px;
            line-height: 1.6;
        }

        .terms input {
            width: 19px;
            height: 19px;
            margin-top: 3px;
            flex-shrink: 0;
        }

        .terms a {
            color: #205ce8;
            font-weight: 600;
            text-decoration: none;
        }

        .terms a:hover { text-decoration: underline; }

        .register-btn {
            width: 100%;
            height: 52px;
            border: 0;
            border-radius: 8px;
            background: #205ce8;
            color: #fff;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
        }

        .register-btn:hover { background: #174dcc; }

        .login-section {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #444;
            font-size: 15px;
        }

        .login-section a {
            color: #205ce8;
            font-weight: 600;
            text-decoration: none;
        }

        .login-section a:hover { text-decoration: underline; }

        .alert {
            font-size: 14px;
            border-radius: 8px;
        }

        @media (max-width: 600px) {
            .register-wrapper {
                padding: 20px 12px;
                align-items: flex-start;
            }

            .register-container { margin-top: 20px; }

            .register-header {
                padding: 28px 15px 24px;
                border-radius: 15px 15px 0 0;
            }

            .lms-logo {
                width: 70px;
                height: 70px;
                font-size: 35px;
            }

            .register-header h2 { font-size: 28px; }
            .register-header p { font-size: 14px; }

            .register-card {
                padding: 35px 20px 25px;
                border-radius: 0 0 15px 15px;
            }

            .register-heading { font-size: 24px; }
            .form-label { font-size: 16px; }

            .form-control {
                height: 48px;
                font-size: 15px;
            }

            .register-btn {
                height: 50px;
                font-size: 17px;
            }
        }
    </style>

</head>


<body>


<div class="register-wrapper">

    <div class="register-container">


        <!-- =========================
             LMS HEADER
        ========================== -->

<div class="register-header">

    <div class="lms-logo">
        <img src="{{ asset('images/Logo.jpeg') }}" alt="LMS EDU Logo" style="width:100%;height:100%;object-fit:contain;border-radius:50%;">
    </div>

    <h2>LMS</h2>

    <p>Library Management System</p>

</div>


        <!-- =========================
             REGISTRATION CARD
        ========================== -->

        <div class="register-card">


            <!-- Top Arrow -->

            <div class="top-arrow">

                <i class="bi bi-chevron-down"></i>

            </div>


            <h2 class="register-heading">
                Create Your Account
            </h2>


            <!-- Errors -->

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


            <!-- Registration Form -->

            <form
                action="{{ route('register.store') }}"
                method="POST">

                @csrf


                <!-- Full Name -->

                <div class="mb-3">

                    <label class="form-label">

                        Full Name
                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        placeholder="Enter Full Name"
                        required>

                </div>


                <!-- Student ID -->

                <div class="mb-3">

                    <label class="form-label">

                        Student ID
                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        name="student_id"
                        class="form-control"
                        value="{{ old('student_id') }}"
                        placeholder="Enter 3 digit Student ID"
                        maxlength="3"
                        pattern="[0-9]{3}"
                        inputmode="numeric"
                        required>

                </div>


                <!-- Email -->

                <div class="mb-3">

                    <label class="form-label">

                        Email
                        <span class="required">*</span>

                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required>

                </div>

                {{-- Department --}}
<div class="mb-3">
    <label class="form-label">
        Department
        <span class="text-danger">*</span>
    </label>

    <select
    name="department"
    class="form-control"
    required>

    <option value="">Select Department</option>

    <option value="Computer Science & Engineering"
        {{ old('department') == 'Computer Science & Engineering' ? 'selected' : '' }}>
        Computer Science & Engineering (CSE)
    </option>

    <option value="Electrical & Electronic Engineering"
        {{ old('department') == 'Electrical & Electronic Engineering' ? 'selected' : '' }}>
        Electrical & Electronic Engineering (EEE)
    </option>

    <option value="Business Administration"
        {{ old('department') == 'Business Administration' ? 'selected' : '' }}>
        Business Administration (BBA)
    </option>

    <option value="English"
        {{ old('department') == 'English' ? 'selected' : '' }}>
        English
    </option>

    <option value="Law"
        {{ old('department') == 'Law' ? 'selected' : '' }}>
        Law
    </option>

    <option value="Civil Engineering"
        {{ old('department') == 'Civil Engineering' ? 'selected' : '' }}>
        Civil Engineering (CE)
    </option>

    <option value="Architecture"
        {{ old('department') == 'Architecture' ? 'selected' : '' }}>
        Architecture
    </option>

    <option value="Pharmacy"
        {{ old('department') == 'Pharmacy' ? 'selected' : '' }}>
        Pharmacy
    </option>

</select>
</div>

{{-- Program --}}
<div class="mb-3">
    <label class="form-label">
        Program
        <span class="required">*</span>
    </label>

    <select name="program" class="form-control" required>
        <option value="">Select Program</option>

        <option value="BSc "
            {{ old('program') == 'BSc ' ? 'selected' : '' }}>
            BSc 
        </option>

        

        <option value="BBA"
            {{ old('program') == 'BBA' ? 'selected' : '' }}>
            BBA
        </option>

        <option value="MBA"
            {{ old('program') == 'MBA' ? 'selected' : '' }}>
            MBA
        </option>


        <option value="MBA"
            {{ old('program') == 'MBA' ? 'selected' : '' }}>
            MSc
        </option>

        <option value="BA in English"
            {{ old('program') == 'BA in English' ? 'selected' : '' }}>
            BA in English
        </option>

        <option value="LLB"
            {{ old('program') == 'LLB' ? 'selected' : '' }}>
            LLB
        </option>

        <option value="LLM"
            {{ old('program') == 'LLM' ? 'selected' : '' }}>
            LLM
        </option>

        <option value="Bachelor of Architecture"
            {{ old('program') == 'Bachelor of Architecture' ? 'selected' : '' }}>
            Bachelor of Architecture
        </option>

        <option value="Master of Architecture"
            {{ old('program') == 'Master of Architecture' ? 'selected' : '' }}>
            Master of Architecture
        </option>
    </select>
</div>


    {{-- Semester --}}
<div class="mb-3">
    <label class="form-label">
        Semester
        <span class="required">*</span>
    </label>

    <select name="semester" class="form-control" required>
        <option value="">Select Semester</option>

        <option value="1st Semester" {{ old('semester') == '1st Semester' ? 'selected' : '' }}>
            1st Semester
        </option>

        <option value="2nd Semester" {{ old('semester') == '2nd Semester' ? 'selected' : '' }}>
            2nd Semester
        </option>

        <option value="3rd Semester" {{ old('semester') == '3rd Semester' ? 'selected' : '' }}>
            3rd Semester
        </option>

        <option value="4th Semester" {{ old('semester') == '4th Semester' ? 'selected' : '' }}>
            4th Semester
        </option>

        <option value="5th Semester" {{ old('semester') == '5th Semester' ? 'selected' : '' }}>
            5th Semester
        </option>

        <option value="6th Semester" {{ old('semester') == '6th Semester' ? 'selected' : '' }}>
            6th Semester
        </option>

        <option value="7th Semester" {{ old('semester') == '7th Semester' ? 'selected' : '' }}>
            7th Semester
        </option>

        <option value="8th Semester" {{ old('semester') == '8th Semester' ? 'selected' : '' }}>
            8th Semester
        </option>

        <option value="9th Semester" {{ old('semester') == '9th Semester' ? 'selected' : '' }}>
            9th Semester
        </option>

        <option value="10th Semester" {{ old('semester') == '10th Semester' ? 'selected' : '' }}>
            10th Semester
        </option>

        <option value="11th Semester" {{ old('semester') == '11th Semester' ? 'selected' : '' }}>
            11th Semester
        </option>

        <option value="12th Semester" {{ old('semester') == '12th Semester' ? 'selected' : '' }}>
            12th Semester
        </option>

       
        </option>
    </select>
</div>



                <!-- Password -->

                <div class="mb-3">

                    <label class="form-label">

                        Password
                        <span class="required">*</span>

                    </label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Enter your password"
                            required>

                        <button
                            type="button"
                            class="eye-btn"
                            onclick="togglePassword('password', 'eye1')">

                            <i
                                id="eye1"
                                class="bi bi-eye">
                            </i>

                        </button>

                    </div>

                </div>


                <!-- Confirm Password -->

                <div class="mb-3">

                    <label class="form-label">

                        Confirm Password
                        <span class="required">*</span>

                    </label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Confirm your password"
                            required>

                        <button
                            type="button"
                            class="eye-btn"
                            onclick="togglePassword('password_confirmation', 'eye2')">

                            <i
                                id="eye2"
                                class="bi bi-eye">
                            </i>

                        </button>

                    </div>

                </div>


                <!-- Phone -->

                <div class="mb-3">

                    <label class="form-label">

                        Phone Number
                        <span class="required">*</span>

                    </label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone') }}"
                        placeholder="Enter 11 digit Phone Number"
                        maxlength="11"
                        pattern="[0-9]{11}"
                        inputmode="numeric"
                        required>

                </div>


                <!-- Address -->

                <div class="mb-3">

                    <label class="form-label">

                        Address

                    </label>

                    <textarea
                        name="address"
                        class="form-control"
                        rows="3"
                        placeholder="Enter Address">{{ old('address') }}</textarea>

                </div>


                <!-- Terms -->

                <div class="terms">

                    <input
                        type="checkbox"
                        required>

                    <div>

                        By signing up, you agree to our

                        <a href="{{ route('terms') }}" target="_blank">
                            Terms of Use
                        </a>

                        and you have read and acknowledge our

                        <a href="{{ route('privacy') }}" target="_blank">
                            Privacy Policy
                        </a>.

                    </div>

                </div>


                <!-- Register -->

                <button
                    type="submit"
                    class="register-btn">

                    Register >>

                </button>


            </form>


            <!-- Login -->

            <div class="login-section">

                Already have an account?

                <a href="{{ route('login') }}">
                    Login
                </a>

            </div>


        </div>


    </div>

</div>


<script>

function togglePassword(inputId, eyeId) {

    const input = document.getElementById(inputId);

    const eye = document.getElementById(eyeId);

    if (input.type === "password") {

        input.type = "text";

        eye.classList.remove("bi-eye");

        eye.classList.add("bi-eye-slash");

    } else {

        input.type = "password";

        eye.classList.remove("bi-eye-slash");

        eye.classList.add("bi-eye");

    }

}

</script>


</body>

</html>