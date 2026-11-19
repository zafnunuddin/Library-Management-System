<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Library Management System - Payment History</title>

    <!-- Custom fonts & styles -->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('assets/css') }}/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: rgb(32, 92, 232);">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/Logo.jpeg') }}" alt="Logo" style="width:40px;height:40px;object-fit:contain;border-radius:6px;">
                <div class="sidebar-brand-text mx-3">LMS Admin</div>
            </a>

            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Library Management</div>

            <!-- Add New Book -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('add_book') }}">
                    <i class="fas fa-fw fa-plus"></i>
                    <span>Add New Book</span>
                </a>
            </li>

            <!-- All Books List -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('all_books') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>All Books List</span>
                </a>
            </li>

            <!-- Damaged Books -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.damaged.books') }}">
                    <i class="fas fa-fw fa-book-dead"></i>
                    <span>Damaged Books</span>
                </a>
            </li>

            <!-- Book Requests -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('requests.index') }}">
                    <i class="fas fa-clock"></i>
                    <span>Book Requests</span>
                </a>
            </li>

            <!-- Return Process -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('return_book') }}">
                    <i class="fas fa-fw fa-arrow-left"></i>
                    <span>Return Process</span>
                </a>
            </li>

            <!-- Defaulters List -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('defaulters') }}">
                    <i class="fas fa-fw fa-exclamation-triangle"></i>
                    <span>Defaulters List</span>
                </a>
            </li>

            <!-- 💳 Payment History (Active Status) -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.payments.index') }}">
                    <i class="fas fa-fw fa-credit-card"></i>
                    <span>Payment History</span>
                </a>
            </li>

            <!-- Users Dropdown -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="false">
                    <i class="fas fa-users fa-fw"></i>
                    <span>Users</span>
                </a>
                <div id="collapseUsers" class="collapse" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">User Management:</h6>
                        <a class="collapse-item" href="{{ route('users') }}"><i class="fas fa-users mr-2"></i> All Users</a>
                        <a class="collapse-item" href="{{ route('admin.issued.users') }}"><i class="fas fa-book-reader mr-2"></i> Issued Users</a>
                    </div>
                </div>
            </li>

            <hr class="sidebar-divider">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                @if(Auth::user()->photo)
                                    <img class="img-profile rounded-circle" src="{{ asset('storage/' . Auth::user()->photo) }}">
                                @else
                                    <img class="img-profile rounded-circle" src="{{ asset('assets/img/undraw_profile.svg') }}">
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Payment History & Approval</h1>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- Payment Table Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header text-white" style="background-color: rgb(32, 92, 232);">
                            <h5 class="mb-0"><i class="fas fa-credit-card mr-2"></i> All Transactions</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center" width="100%" cellspacing="0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Student / User</th>
                                            <th>Book Title</th>
                                            <th>Amount</th>
                                            <th>TrxID</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($payments as $index => $payment)
                                        <tr>
                                            <td>{{ $payments->firstItem() + $index }}</td>
                                            <td>{{ $payment->user->name ?? 'N/A' }}</td>
                                            <td>{{ $payment->issue->book->title ?? 'N/A' }}</td>
                                            <td>৳ {{ number_format($payment->amount, 2) }}</td>
                                            <td><code>{{ $payment->transaction_id ?? 'N/A' }}</code></td>
                                            <td>
                                                @if(strtolower($payment->payment_status) == 'completed' || strtolower($payment->payment_status) == 'paid')
                                                    <span class="badge badge-success p-2">Paid</span>
                                                @else
                                                    <span class="badge badge-warning text-dark p-2">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(strtolower($payment->payment_status) == 'pending')
                                                    <form action="{{ route('admin.payments.approve', $payment->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Approve this payment?')">
                                                            <i class="fas fa-check mr-1"></i> Approve
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-muted"><i class="fas fa-check-circle text-success"></i> Approved</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">No Payment History Available</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination Link -->
                            <div class="d-flex justify-content-end mt-3">
                                {{ $payments->links() }}
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Website LMS</span>
                    </div>
                </div>
            </footer>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

</body>

</html>