<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Requests</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            background-image: url('{{ asset('images/Background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .request-table {
            background: white;
        }

        .request-table th, .request-table td {
            font-size: 13px;
            vertical-align: middle;
        }

        .request-table th {
            white-space: nowrap;
        }

        .book-cover {
            width: 55px;
            height: 75px;
            object-fit: cover;
            border-radius: 5px;
        }

        .status-badge, .action-btn {
            white-space: nowrap;
        }

        .deadline-danger {
            color: #dc3545;
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="container-fluid mt-4 mb-5">

    {{-- ================= HEADER ================= --}}
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="fas fa-book-reader"></i> Book Request List
            </h4>
        </div>
    </div>

    {{-- ================= SUCCESS ALERT ================= --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    {{-- ================= ERROR ALERT ================= --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    {{-- ================= TABLE ================= --}}
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover request-table">
                    <thead class="bg-primary text-white">
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Student ID</th>
                        <th>Book</th>
                        <th>Cover</th>
                        <th>Author</th>
                        <th>ISBN</th>
                        <th>Edition</th>
                        <th>Genre</th>
                        <th>Available</th>
                        <th>Requested</th>
                        <th>Approval Deadline</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($requests as $index => $request)
                        @php
                            $isExpired = false;
                            if (
                                $request->status === 'Pending' &&
                                $request->request_deadline &&
                                $request->request_deadline->isPast()
                            ) {
                                $isExpired = true;
                            }
                        @endphp

                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                <strong>{{ $request->user->name ?? 'Unknown' }}</strong>
                            </td>

                            <td>
                                {{ $request->user->student_id ?? $request->user->id }}
                            </td>

                            <td>
                                <strong>{{ $request->book->title ?? 'Unknown Book' }}</strong>
                            </td>

                            <td class="text-center">
                                @if($request->book && $request->book->photo)
                                    <img src="{{ asset('storage/'.$request->book->photo) }}" class="book-cover" alt="Book">
                                @else
                                    <i class="fas fa-book fa-2x text-secondary"></i>
                                @endif
                            </td>

                            <td>{{ $request->book->author ?? 'N/A' }}</td>
                            <td>{{ $request->book->isbn ?? 'N/A' }}</td>
                            <td>{{ $request->book->edition ?? 'N/A' }}</td>
                            <td>{{ $request->book->genre ?? 'N/A' }}</td>

                            <td class="text-center">
                                <span class="badge badge-success">
                                    {{ $request->book->available_quantity ?? 0 }}
                                </span>
                            </td>

                            <td>
                                {{ $request->created_at ? $request->created_at->format('d M Y') : 'N/A' }}
                                <br>
                                <small class="text-muted">
                                    {{ $request->created_at ? $request->created_at->format('h:i A') : '' }}
                                </small>
                            </td>

                            <td>
                                @if($request->request_deadline)
                                    <span class="{{ $isExpired ? 'deadline-danger' : '' }}">
                                        {{ $request->request_deadline->format('d M Y') }}
                                    </span>
                                    <br>
                                    <small class="text-muted">
                                        {{ $request->request_deadline->format('h:i A') }}
                                    </small>
                                @else
                                    N/A
                                @endif
                            </td>

                            {{-- STATUS --}}
                            <td>
                                @if($request->status === 'Pending')
                                    @if($isExpired)
                                        <span class="badge badge-danger status-badge">Expired</span>
                                    @else
                                        <span class="badge badge-warning status-badge">Pending</span>
                                    @endif
                                @elseif($request->status === 'Approved')
                                    @if($request->handover_confirmed)
                                        <span class="badge badge-success status-badge">
                                            <i class="fas fa-check-circle"></i> Handover Confirmed
                                        </span>
                                    @else
                                        <span class="badge badge-primary status-badge">Approved</span>
                                    @endif
                                @elseif($request->status === 'Rejected')
                                    <span class="badge badge-danger status-badge">Rejected</span>
                                @endif
                            </td>

                            {{-- ACTION BUTTONS --}}
                            <td class="action-btn">
                                @if($request->status === 'Pending' && !$isExpired)
                                    {{-- Approve Form --}}
                                    <form action="{{ route('requests.approve', $request->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm mb-1" onclick="return confirm('Approve this request?');">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    </form>

                                    {{-- Reject Form --}}
                                    <form action="{{ route('requests.reject', $request->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Reject this request?');">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                    </form>

                                @elseif($request->status === 'Approved')
                                    @if(!$request->handover_confirmed)
                                        {{-- Confirm Handover Form --}}
                                        <form action="{{ route('requests.handover', $request->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Have you physically handed over this book to the student?');">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-hand-holding"></i> Confirm Handover
                                            </button>
                                        </form>
                                    @else
                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle"></i> Completed
                                        </span>
                                        @if($request->handover_confirmed_at)
                                            <br>
                                            <small class="text-muted">
                                                {{ $request->handover_confirmed_at->format('d M Y, h:i A') }}
                                            </small>
                                        @endif
                                    @endif

                                @elseif($request->status === 'Rejected' || $isExpired)
                                    <span class="text-muted">
                                        <i class="fas fa-ban"></i> No Action
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14" class="text-center py-4">
                                <i class="fas fa-inbox fa-2x text-muted"></i>
                                <br><br>
                                <span class="text-muted">No Book Requests Found</span>
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

</body>
</html>