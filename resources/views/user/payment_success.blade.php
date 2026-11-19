<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Payment Successful</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>

        body {
            background: #f4f6f9;
        }

        .success-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .success-card {
            background: white;
            width: 100%;
            max-width: 500px;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0,0,0,0.10);
        }

        .success-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #198754;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            font-size: 40px;
        }

    </style>

</head>

<body>

<div class="success-wrapper">

    <div class="success-card">

        <div class="success-icon">

            <i class="bi bi-check-lg"></i>

        </div>

        <h2 class="fw-bold mt-4">

            Payment Successful!

        </h2>

        <p class="text-muted">

            Your library fine has been paid successfully.

        </p>


        <hr>


        <p>

            <strong>Book:</strong>

            {{ $payment->issue->book->title ?? 'Unknown Book' }}

        </p>


        <p>

            <strong>Amount:</strong>

            ৳{{ number_format($payment->amount, 2) }}

        </p>


        <p>

            <strong>Payment Method:</strong>

            {{ strtoupper($payment->payment_method) }}

        </p>


        <p>

            <strong>Transaction ID:</strong>

            {{ $payment->transaction_id }}

        </p>


        <p>

            <strong>Date:</strong>

            {{ $payment->paid_at->format('d M Y, h:i A') }}

        </p>


        <div class="d-grid gap-2 mt-4">

            <a
                href="{{ route('user.dashboard') }}"
                class="btn btn-primary">

                <i class="bi bi-speedometer2"></i>

                Back to Dashboard

            </a>

            <a
                href="{{ route('payment.history') }}"
                class="btn btn-outline-secondary">

                <i class="bi bi-clock-history"></i>

                Payment History

            </a>

        </div>

    </div>

</div>

</body>

</html>