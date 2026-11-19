@php
    $user = Auth::user();
    $issuedBookIds = $issues->pluck('book_id')->all();
    $pendingBookIds = $pendingRequests->pluck('book_id')->all();
@endphp
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; transition: background-color 0.3s ease; }
        .navbar { background-color: #0d6efd; transition: background-color 0.3s ease; }
        .navbar-brand, .navbar .nav-link { color: white !important; }
        .dashboard-header { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-top: 20px; transition: background-color 0.3s ease, color 0.3s ease; }

        .book-card { transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.3s ease; height: 100%; border: none; border-radius: 10px; overflow: hidden; background: white; }
        .book-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.12); }
        .card-img-top { height: 190px; object-fit: cover; border-bottom: 1px solid #eee; background: #e9ecef; }
        .genre-badge { position: absolute; top: 10px; right: 10px; font-size: 0.8rem; box-shadow: 0 2px 5px rgba(0,0,0,0.2); }
        .new-badge { position: absolute; top: 10px; left: 10px; font-size: 0.75rem; box-shadow: 0 2px 5px rgba(0,0,0,0.2); }

        .due-date-card { border-left: 5px solid #dc3545; background: #fff; transition: background-color 0.3s ease; }
        .due-date-safe { border-left: 5px solid #198754; background: #fff; transition: background-color 0.3s ease; }
        .due-date-overdue { border-left: 5px solid #842029; background: #fff; transition: background-color 0.3s ease; }

        .nav-pills { flex-wrap: wrap; gap: 6px; }
        .nav-pills .nav-link { color: #333; font-weight: 600; border-radius: 8px; padding: 10px 16px; }
        .nav-pills .nav-link.active { background-color: #0d6efd; color: #fff !important; }
        .nav-pills .nav-link:not(.active):hover { background-color: #f1f3f5; }
        .nav-pills .nav-link .badge { margin-left: 6px; }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 12px;
            margin-left: 5px;
            border-left: 1px solid rgba(255,255,255,.35);
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255,255,255,.18);
            border: 2px solid rgba(255,255,255,.7);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 19px;
        }

        .user-details { line-height: 1.2; }
        .user-name { color: white; font-size: 14px; font-weight: 700; white-space: nowrap; }
        .user-id { color: rgba(255,255,255,.85); font-size: 12px; margin-top: 3px; white-space: nowrap; }

        [data-bs-theme="dark"] body { background-color: #121212 !important; }
        [data-bs-theme="dark"] .dashboard-header,
        [data-bs-theme="dark"] .due-date-card,
        [data-bs-theme="dark"] .due-date-safe { background-color: #1e1e1e !important; color: #f8f9fa !important; border-color: #333 !important; }
        [data-bs-theme="dark"] .due-date-overdue { background-color: #2c0b0e !important; color: #f8f9fa !important; border-color: #ea868f !important; }
        [data-bs-theme="dark"] .book-card { background-color: #1e1e1e; color: #f8f9fa; }
        [data-bs-theme="dark"] .text-muted { color: #adb5bd !important; }
        [data-bs-theme="dark"] .navbar { background-color: #0b5ed7 !important; }
        [data-bs-theme="dark"] .card-img-top { border-bottom: 1px solid #333; }
        [data-bs-theme="dark"] .nav-pills .nav-link { color: #f8f9fa; background-color: #1e1e1e; }
        [data-bs-theme="dark"] .table { color: #f8f9fa; }
        [data-bs-theme="dark"] .modal-content { background-color: #1e1e1e; color: #f8f9fa; }
    </style>
</head>
<body style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">

    <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('user.dashboard') }}">
                <img src="{{ asset('images/Logo.jpeg') }}" alt="LMS EDU Logo" style="width:32px;height:32px;object-fit:contain;border-radius:6px;margin-right:8px;" onerror="this.src='https://via.placeholder.com/32';">
                LMS Student Panel
            </a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link active fw-bold" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.profile') }}"><i class="bi bi-person-circle"></i> Profile</a></li>
                    <li class="nav-item ms-3">
                        <div class="user-info">
                            <div class="user-avatar">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="user-details">
                                <div class="user-name">{{ $user->name }}</div>
                                <div class="user-id"><i class="bi bi-person-badge-fill"></i> ID: {{ $user->student_id ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item ms-3">
                        <button id="themeToggle" class="btn btn-outline-light btn-sm fw-bold">🌙 Dark</button>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.settings') }}"><i class="bi bi-gear"></i> Settings</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="ms-3">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mb-5">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="dashboard-header mb-4">
            <ul class="nav nav-pills mb-0" id="dashTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#catalog" type="button">
                        <i class="bi bi-grid-fill"></i> Browse Library Catalog
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#issued" type="button">
                        <i class="bi bi-journal-bookmark-fill"></i> Issued Books &amp; Pay
                        @if(isset($issues) && $issues->count())
                            <span class="badge bg-danger">{{ $issues->count() }}</span>
                        @endif
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pending" type="button">
                        <i class="bi bi-clock-history"></i> Pending Request
                        <span class="badge bg-secondary">{{ $pendingRequests->count() ?? 0 }}</span>
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#rules" type="button">
                        <i class="bi bi-shield-check"></i> Rules &amp; Guidelines
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#history" type="button">
                        <i class="bi bi-clock-history"></i> Book History
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#payment" type="button">
                        <i class="bi bi-credit-card"></i> Payment History
                    </button>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            {{-- ============ BROWSE CATALOG ============ --}}
            <div class="tab-pane fade show active" id="catalog">
                <div class="dashboard-header mb-4">
                    <h5 class="fw-bold text-primary"><i class="bi bi-search"></i> Search</h5>
                    <form action="{{ route('user.dashboard') }}" method="GET" class="d-flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by Title, Author, or Genre...">
                        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                        @if(request('search'))
                            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">Clear</a>
                        @endif
                    </form>
                </div>

                <div class="dashboard-header">
                    <h5 class="fw-bold mb-3"><i class="bi bi-collection-fill text-primary"></i> {{ request('search') ? 'Search Results' : 'Available Catalog' }}</h5>
                    <div class="row g-4">
                        @forelse($books as $book)
                            <div class="col-md-6 col-lg-4">
                                @include('user.partials.book-card', ['book' => $book, 'isNew' => false])
                            </div>
                        @empty
                            <div class="col-12"><p class="text-muted">No books found.</p></div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- ============ ISSUED BOOKS ============ --}}
            <div class="tab-pane fade" id="issued">
                <div class="dashboard-header">
                    <h5 class="fw-bold mb-3"><i class="bi bi-journal-bookmark-fill text-primary"></i> My Borrowed Books</h5>
                    <div class="row g-3">
                        @forelse($issues as $issue)
                            @php
                                $today = \Carbon\Carbon::today();
                                $returnDate = \Carbon\Carbon::parse($issue->return_deadline);
                                $daysLeft = $today->diffInDays($returnDate, false);
                                $fine = $daysLeft < 0 ? abs($daysLeft) * 5 : 0;
                            @endphp
                            <div class="col-md-6">
                                <div class="card shadow-sm p-3 {{ $daysLeft < 0 ? 'due-date-overdue' : 'due-date-safe' }}">
                                    <h6 class="fw-bold mb-1">{{ $issue->book->title ?? 'Unknown Book' }}</h6>
                                    <p class="mb-1 small">Issued: {{ \Carbon\Carbon::parse($issue->issue_date)->format('d M Y') }}</p>
                                    <p class="mb-1 small">Due: {{ $returnDate->format('d M Y') }}</p>

                                    @if($daysLeft < 0)
                                        <p class="text-danger fw-bold mb-2">Overdue Fine: ৳{{ $fine }}</p>
                                        <button onclick="openPaymentModal({{ $issue->id }}, {{ $fine }}, '{{ addslashes($issue->book->title ?? '') }}')" class="btn btn-primary btn-sm">
                                            <i class="bi bi-credit-card"></i> Pay Fine Online
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-12"><p class="text-muted">You have no books currently issued.</p></div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- ============ PENDING REQUESTS ============ --}}
            <div class="tab-pane fade" id="pending">
                <div class="dashboard-header">
                    <h5 class="fw-bold mb-3"><i class="bi bi-clock-history text-primary"></i> Pending Requests</h5>
                    @forelse($pendingRequests as $req)
                        <div class="d-flex justify-content-between align-items-center border rounded p-3 mb-2">
                            <div>
                                <h6 class="fw-bold mb-1">{{ $req->book->title ?? 'Unknown' }}</h6>
                                <p class="mb-0 text-muted small">Requested: {{ $req->created_at->format('d M Y') }}</p>
                            </div>
                            <form action="{{ route('user.requests.cancel', $req->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Cancel</button>
                            </form>
                        </div>
                    @empty
                        <p class="text-muted">No pending requests.</p>
                    @endforelse
                </div>
            </div>

            {{-- ============ RULES & GUIDELINES ============ --}}
            <div class="tab-pane fade" id="rules">
                <div class="dashboard-header">
                    <h5 class="fw-bold mb-3"><i class="bi bi-shield-check text-primary"></i> Library Rules</h5>
                    <p class="text-muted">1. Keep books in clean condition.<br>2. Return books on or before due dates to avoid fines.</p>
                </div>
            </div>

            {{-- ============ BOOK HISTORY ============ --}}
            <div class="tab-pane fade" id="history">
                <div class="dashboard-header">
                    <h5 class="fw-bold mb-3"><i class="bi bi-clock-history text-primary"></i> Borrowed Book History</h5>
                    @forelse($returnedBooks ?? [] as $history)
                        <div class="border rounded p-3 mb-2">
                            <h6 class="fw-bold mb-1">{{ $history->book->title ?? 'Book' }}</h6>
                            <small class="text-muted">Returned on: {{ \Carbon\Carbon::parse($history->actual_return_date)->format('d M Y') }}</small>
                        </div>
                    @empty
                        <p class="text-muted">No history available.</p>
                    @endforelse
                </div>
            </div>

            {{-- ============ PAYMENT HISTORY ============ --}}
            <div class="tab-pane fade" id="payment">
                <div class="dashboard-header">
                    <h5 class="fw-bold mb-3"><i class="bi bi-credit-card text-primary"></i> Payment History</h5>
                    @forelse($paymentHistory ?? [] as $payment)
                        <div class="border rounded p-3 mb-2 d-flex justify-content-between">
                            <div>
                                <h6 class="fw-bold mb-0">TrxID: {{ $payment->transaction_id ?? 'N/A' }}</h6>
                                <small class="text-muted">Method: {{ strtoupper($payment->payment_method ?? 'Mobile Banking') }}</small>
                            </div>
                            <div class="text-end">
                                <span class="fw-bold text-success">৳{{ number_format($payment->amount, 2) }}</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No payment history found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- ============ PAY FINE MODAL ============ -->
    <div class="modal fade" id="paymentModal" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" id="paymentForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-wallet2"></i> Pay Fine Online</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Book: <strong id="payBookTitle"></strong></p>
                    <p>Amount Due: <strong class="text-danger" id="payAmount"></strong> Tk</p>
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select" required>
                            <option value="bkash">bKash</option>
                            <option value="nagad">Nagad</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mobile Number</label>
                        <input type="text" name="mobile" class="form-control" placeholder="01XXXXXXXXX" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PIN</label>
                        <input type="password" name="pin" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Confirm Payment</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const themeToggle = document.getElementById('themeToggle');
        const htmlEl = document.documentElement;
        const savedTheme = localStorage.getItem('lms-theme') || 'light';
        htmlEl.setAttribute('data-bs-theme', savedTheme);
        themeToggle.innerHTML = savedTheme === 'dark' ? '☀️ Light' : '🌙 Dark';

        themeToggle.addEventListener('click', function () {
            const current = htmlEl.getAttribute('data-bs-theme');
            const next = current === 'dark' ? 'light' : 'dark';
            htmlEl.setAttribute('data-bs-theme', next);
            localStorage.setItem('lms-theme', next);
            themeToggle.innerHTML = next === 'dark' ? '☀️ Light' : '🌙 Dark';
        });

        function openPaymentModal(issueId, amount, bookTitle) {
            let url = "{{ route('user.issues.pay', ['issue' => ':id']) }}";
            document.getElementById('paymentForm').action = url.replace(':id', issueId);
            document.getElementById('payAmount').textContent = amount;
            document.getElementById('payBookTitle').textContent = bookTitle;
            new bootstrap.Modal(document.getElementById('paymentModal')).show();
        }
    </script>
</body>
</html>