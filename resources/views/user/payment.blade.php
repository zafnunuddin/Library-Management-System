<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Pay Fine - Library Management System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <style>

        body {
            min-height: 100vh;
            background: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px;
        }

        .payment-card {

            width: 100%;
            max-width: 500px;

            background: white;

            border-radius: 18px;

            padding: 30px;

            box-shadow:
                0 10px 35px rgba(0,0,0,0.10);
        }


        .payment-header {

            text-align: center;

            margin-bottom: 25px;
        }


        .payment-icon {

            width: 70px;
            height: 70px;

            margin: auto;
            margin-bottom: 15px;

            border-radius: 50%;

            background: #205ce8;

            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 32px;
        }


        .payment-header h3 {

            font-weight: 700;

            margin-bottom: 5px;
        }


        .payment-header p {

            color: #6c757d;

            margin-bottom: 0;
        }


        .book-info {

            background: #f8f9fa;

            border-radius: 12px;

            padding: 18px;

            margin-bottom: 20px;
        }


        .book-info h5 {

            font-weight: 700;

            margin-bottom: 5px;
        }


        .book-info p {

            margin-bottom: 4px;

            color: #6c757d;
        }


        .fine-box {

            background: #fff3f3;

            border: 1px solid #f5c2c7;

            border-radius: 12px;

            padding: 18px;

            margin-bottom: 20px;

            text-align: center;
        }


        .fine-label {

            color: #842029;

            font-size: 14px;

            margin-bottom: 5px;
        }


        .fine-amount {

            color: #dc3545;

            font-size: 30px;

            font-weight: 700;
        }


        .form-label {

            font-weight: 600;
        }


        .form-control,
        .form-select {

            min-height: 48px;

            border-radius: 10px;
        }


        .pay-btn {

            width: 100%;

            min-height: 50px;

            border: none;

            border-radius: 10px;

            background: #205ce8;

            color: white;

            font-weight: 600;

            font-size: 16px;

            transition: 0.2s;
        }


        .pay-btn:hover {

            background: #174bc0;

            transform: translateY(-1px);
        }


        .back-btn {

            width: 100%;

            margin-top: 10px;

            min-height: 45px;

            border-radius: 10px;
        }


        .secure-text {

            text-align: center;

            color: #6c757d;

            font-size: 13px;

            margin-top: 18px;
        }

    </style>

</head>


<body>


<div class="payment-card">


    {{-- ================= HEADER ================= --}}

    <div class="payment-header">

        <div class="payment-icon">

            <i class="bi bi-credit-card"></i>

        </div>

        <h3>Pay Fine Online</h3>

        <p>
            Library Management System
        </p>

    </div>


    {{-- ================= ERROR ================= --}}

    @if(session('error'))

        <div class="alert alert-danger">

            <i class="bi bi-exclamation-circle"></i>

            {{ session('error') }}

        </div>

    @endif


    {{-- ================= VALIDATION ERRORS ================= --}}

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


    {{-- ================= BOOK INFORMATION ================= --}}

    <div class="book-info">

        <h5>

            <i class="bi bi-book text-primary"></i>

            {{ $issue->book->title ?? 'Unknown Book' }}

        </h5>

        <p>

            <strong>Author:</strong>

            {{ $issue->book->author ?? 'N/A' }}

        </p>

        <p>

            <strong>Issue Date:</strong>

            {{ \Carbon\Carbon::parse($issue->issue_date)->format('d M, Y') }}

        </p>

        <p>

            <strong>Due Date:</strong>

            {{ \Carbon\Carbon::parse($issue->return_deadline)->format('d M, Y') }}

        </p>

    </div>


    {{-- ================= FINE CALCULATION ================= --}}

    @php

        $today = \Carbon\Carbon::today();

        $returnDate = \Carbon\Carbon::parse(
            $issue->return_deadline
        )->startOfDay();

        $daysLate = $today->diffInDays(
            $returnDate,
            false
        );

        $fine = $daysLate < 0
            ? abs($daysLate) * 5
            : 0;

    @endphp


    <div class="fine-box">

        <div class="fine-label">

            Outstanding Fine

        </div>

        <div class="fine-amount">

            ৳{{ $fine }}

        </div>

        <small class="text-muted">

            {{ abs($daysLate) }} overdue day(s)
            × ৳5 per day

        </small>

    </div>


    {{-- ================= PAYMENT FORM ================= --}}

    <form
        action="{{ route('payment.pay', $issue->id) }}"
        method="POST">

        @csrf


        {{-- Payment Method --}}

        <div class="mb-3">

            <label class="form-label">

                Payment Method

            </label>

            <select
                name="payment_method"
                class="form-select"
                required>

                <option value="">
                    Select Payment Method
                </option>

                <option value="bkash">
                    bKash
                </option>

                <option value="nagad">
                    Nagad
                </option>

            </select>

        </div>


        {{-- Mobile Number --}}

        <div class="mb-3">

            <label class="form-label">

                Mobile Number

            </label>

            <input
                type="text"
                name="mobile"
                class="form-control"
                placeholder="01XXXXXXXXX"
                maxlength="11"
                pattern="01[0-9]{9}"
                required>

            <small class="text-muted">

                Enter your bKash/Nagad mobile number.

            </small>

        </div>


        {{-- Payment PIN --}}

        <div class="mb-3">

            <label class="form-label">

                PIN

            </label>

            <input
                type="password"
                name="pin"
                class="form-control"
                placeholder="Enter PIN"
                minlength="4"
                maxlength="5"
                required>

            <small class="text-muted">

                Demo payment only — no real money will be deducted.

            </small>

        </div>


        {{-- Confirm Payment --}}

        <button
            type="submit"
            class="pay-btn">

            <i class="bi bi-wallet2"></i>

            Confirm Payment ৳{{ $fine }}

        </button>


        {{-- Back --}}

        <a
            href="{{ route('user.dashboard') }}"
            class="btn btn-outline-secondary back-btn">

            <i class="bi bi-arrow-left"></i>

            Back to Dashboard

        </a>


    </form>


    <div class="secure-text">

        <i class="bi bi-shield-check"></i>

        Secure Demo Payment • bKash / Nagad

    </div>


</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>