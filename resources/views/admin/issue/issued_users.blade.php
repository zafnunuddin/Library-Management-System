<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Library LMS - All Issued Users</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}"
          rel="stylesheet">

    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}"
          rel="stylesheet">

</head>


<body class="bg-light" style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">


<div class="container-fluid mt-5">

    {{-- Page Header --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">

            <i class="fas fa-users mr-2"></i>

            All Issued Users

        </h1>


        <a href="{{ route('issue_book') }}"
           class="btn btn-primary btn-sm">

            <i class="fas fa-book mr-1"></i>

            Issue New Book

        </a>

    </div>


    {{-- Table Card --}}
    <div class="card shadow mb-4">

        <div class="card-header py-3 text-white"
             style="background-color: rgb(32, 92, 232);">

            <h6 class="m-0 font-weight-bold">

                <i class="fas fa-list mr-2"></i>

                All Issued Users List

            </h6>

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover"
                       width="100%"
                       cellspacing="0">

                    <thead class="bg-light">

                        <tr>

                            <th>#</th>

                            <th>User ID</th>

                            <th>User Name</th>

                            <th>Department</th>

                            <th>Semester</th>

                            <th>Issue ID</th>

                            <th>Book ID</th>

                            <th>Book Name</th>

                            <th>Edition</th>

                            <th>ISBN</th>

                            <th>Issue Date</th>

                            <th>Overdue</th>

                            <th>Return Status</th>

                            <th>Fine Amount</th>

                            <th>Fine Status</th>

                            <th>Condition</th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($issuedUsers as $issue)

                        @php

                            $return = $issue->returns;

                            $overdueDays = 0;

                            if ($issue->return_deadline) {

                                $deadline = \Carbon\Carbon::parse(
                                    $issue->return_deadline
                                )->startOfDay();


                                if ($return && $return->actual_return_date) {

                                    $actualReturnDate =
                                        \Carbon\Carbon::parse(
                                            $return->actual_return_date
                                        )->startOfDay();


                                    if ($actualReturnDate->gt($deadline)) {

                                        $overdueDays =
                                            $deadline->diffInDays(
                                                $actualReturnDate
                                            );

                                    }

                                } else {

                                    $today = now()->startOfDay();


                                    if ($today->gt($deadline)) {

                                        $overdueDays =
                                            $deadline->diffInDays(
                                                $today
                                            );

                                    }

                                }

                            }

                        @endphp


                        <tr>

                            {{-- # --}}
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- User ID --}}
                            <td>
                                {{ $issue->user->id ?? 'N/A' }}
                            </td>


                            {{-- User Name --}}
                            <td>
                                {{ $issue->user->name ?? 'N/A' }}
                            </td>


                            {{-- Department --}}
                            <td>
                                {{ $issue->user->department ?? 'N/A' }}
                            </td>


                            {{-- Semester --}}
                            <td>
                                {{ $issue->user->semester ?? 'N/A' }}
                            </td>

                            <td>
                               {{ $issue->id }}
                            </td>


                            {{-- Book ID --}}
                            <td>
                                {{ $issue->book->id ?? 'N/A' }}
                            </td>


                            {{-- Book Name --}}
                            <td>
                                {{ $issue->book->title ?? 'N/A' }}
                            </td>


                            {{-- Edition --}}
                            <td>
                                {{ $issue->book->edition ?? 'N/A' }}
                            </td>


                            {{-- ISBN --}}
                            <td>
                                {{ $issue->book->isbn ?? 'N/A' }}
                            </td>


                            {{-- Issue Date --}}
                            <td>

                                {{ \Carbon\Carbon::parse(
                                    $issue->issue_date
                                )->format('d M Y') }}

                            </td>


                            {{-- Overdue --}}
                            <td>

                                @if($overdueDays > 0)

                                    <span class="badge badge-danger">

                                        {{ $overdueDays }} Day(s)

                                    </span>

                                @else

                                    <span class="badge badge-success">

                                        No

                                    </span>

                                @endif

                            </td>


                            {{-- Return Status --}}
                            <td>

                                @if($return)

                                    <span class="badge badge-success">

                                        Returned

                                    </span>

                                @else

                                    <span class="badge badge-warning">

                                        Not Returned

                                    </span>

                                @endif

                            </td>


                            {{-- Fine Amount --}}
                            <td>

                                @if($return)

                                    ৳{{ number_format(
                                        $return->fine ?? 0,
                                        2
                                    ) }}

                                @else

                                    ৳0.00

                                @endif

                            </td>


                            {{-- Fine Status --}}
                            <td>

                                @if($return)

                                    @if($return->fine_paid)

                                        <span class="badge badge-success">

                                            Paid

                                        </span>

                                    @else

                                        <span class="badge badge-danger">

                                            Not Paid

                                        </span>

                                    @endif

                                @else

                                    <span class="text-muted">

                                        —

                                    </span>

                                @endif

                            </td>


                            {{-- Condition --}}
                            <td>

                                @if(!$return)

                                    <span class="badge badge-secondary">

                                        Not Returned

                                    </span>

                                @elseif(
                                    strtolower((string) $return->condition)
                                    === 'damaged'
                                )

                                    <span class="badge badge-danger">

                                        Damaged

                                    </span>

                                @else

                                    <span class="badge badge-success">

                                        Not Damaged

                                    </span>

                                @endif

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="15"
                                class="text-center py-4">

                                <i class="fas fa-info-circle fa-2x text-muted mb-2">
                                </i>

                                <br>

                                No Issued Users Found

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>


</body>

</html>