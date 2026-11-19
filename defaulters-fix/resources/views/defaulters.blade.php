<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Library LMS - Overdue Books & Defaulters List</title>

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

            <i class="fas fa-exclamation-triangle mr-2"></i>

            Overdue Books &amp; Defaulters List

        </h1>

        <form action="{{ route('defaulters.mail_all') }}" method="POST" onsubmit="return confirm('Send a reminder email to every defaulter listed below?');">
            @csrf
            <button type="submit" class="btn btn-primary btn-sm" @if($defaulters->isEmpty()) disabled @endif>
                <i class="fas fa-paper-plane mr-1"></i>
                Mail All Defaulters
            </button>
        </form>

    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif


    {{-- Table Card --}}
    <div class="card shadow mb-4">

        <div class="card-header py-3 text-white"
             style="background-color: rgb(32, 92, 232);">

            <h6 class="m-0 font-weight-bold">

                <i class="fas fa-list mr-2"></i>

                Overdue Books Table

            </h6>

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover"
                       id="dataTable"
                       width="100%"
                       cellspacing="0">

                    <thead class="bg-light">

                        <tr>

                            <th>#</th>

                            <th>Student ID</th>

                            <th>Student Name</th>

                            <th>Email</th>

                            <th>Book Name</th>

                            <th>Due Date</th>

                            <th>Overdue Days</th>

                            <th>Fine</th>

                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($defaulters as $row)

                        @php
                            $issue = $row['issue'];
                        @endphp

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $issue->user->student_id ?? 'N/A' }}</td>

                            <td>{{ $issue->user->name ?? 'N/A' }}</td>

                            <td>{{ $issue->user->email ?? 'N/A' }}</td>

                            <td>{{ $issue->book->title ?? 'N/A' }}</td>

                            <td>
                                {{ $issue->return_deadline
                                    ? \Carbon\Carbon::parse($issue->return_deadline)->format('d M Y')
                                    : 'N/A' }}
                            </td>

                            <td>
                                <span class="badge badge-danger">
                                    {{ $row['overdueDays'] }} Day(s)
                                </span>
                            </td>

                            <td>৳{{ number_format($row['fine'] = 205, 2) }}</td>

                            <td>
                                <form action="{{ route('defaulters.mail', $issue->id) }}" method="POST" onsubmit="return confirm('Send an overdue reminder email to {{ $issue->user->name ?? 'this student' }}?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning" @if(empty($issue->user->email)) disabled title="No email on file" @endif>
                                        <i class="fas fa-envelope mr-1"></i>
                                        Send Mail
                                    </button>
                                </form>
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="text-center py-4">

                                <i class="fas fa-check-circle fa-2x text-success mb-2"></i>

                                <br>

                                No Defaulters Found. All books are on time.

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
