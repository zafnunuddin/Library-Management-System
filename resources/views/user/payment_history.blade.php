<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Payment History</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body style="background:#f4f6f9;">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold">

                <i class="bi bi-clock-history text-primary"></i>

                Payment History

            </h3>

            <p class="text-muted mb-0">

                Your previous fine payments

            </p>

        </div>


        <a
            href="{{ route('user.dashboard') }}"
            class="btn btn-outline-primary">

            <i class="bi bi-arrow-left"></i>

            Dashboard

        </a>

    </div>


    <div class="card shadow-sm border-0">

        <div class="card-body">

            @forelse($payments as $payment)

                <div class="border rounded p-3 mb-3">

                    <div class="row align-items-center">

                        <div class="col-md-4">

                            <h6 class="fw-bold">

                                {{ $payment->issue->book->title ?? 'Unknown Book' }}

                            </h6>

                            <small class="text-muted">

                                Transaction:
                                {{ $payment->transaction_id }}

                            </small>

                        </div>


                        <div class="col-md-2">

                            <small class="text-muted">
                                Amount
                            </small>

                            <div class="fw-bold text-danger">

                                ৳{{ number_format($payment->amount, 2) }}

                            </div>

                        </div>


                        <div class="col-md-2">

                            <small class="text-muted">
                                Method
                            </small>

                            <div class="fw-bold">

                                {{ strtoupper($payment->payment_method) }}

                            </div>

                        </div>


                        <div class="col-md-2">

                            <small class="text-muted">
                                Date
                            </small>

                            <div>

                                {{ $payment->paid_at->format('d M Y') }}

                            </div>

                        </div>


                        <div class="col-md-2 text-md-end">

                            <span class="badge bg-success">

                                <i class="bi bi-check-circle"></i>

                                Paid

                            </span>

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center py-5">

                    <i
                        class="bi bi-wallet2"
                        style="font-size:50px;color:#aaa;">
                    </i>

                    <h5 class="mt-3">

                        No Payment History

                    </h5>

                    <p class="text-muted">

                        You have not made any fine payment yet.

                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

</body>

</html>