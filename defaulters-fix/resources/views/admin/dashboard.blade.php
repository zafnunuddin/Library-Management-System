<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Library Management System - Dashboard</title>

    <!-- Custom fonts for this template-->
   <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css') }}/sb-admin-2.min.css" rel="stylesheet">
<style>

#content-wrapper { background-color: rgba(248, 249, 252, 0.85) !important; }

/* =========================================================
   DASHBOARD CARDS
   ========================================================= */

.dashboard-card {
    border-radius: 12px;
    border-top: none;
    border-bottom: none;
    background: #ffffff;
    transition: all 0.25s ease;
    overflow: hidden;
}


/* Card Hover */

.dashboard-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
}


/* =========================================================
   CARD BODY
   ========================================================= */

.dashboard-card .card-body {
    padding: 1.25rem;
}


/* =========================================================
   CARD TITLE
   ========================================================= */

.dashboard-card .card-title {
    font-size: 0.78rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    margin-bottom: 0.45rem;
    line-height: 1.3;
}


/* =========================================================
   CARD VALUE
   ========================================================= */

.dashboard-card .card-value {
    font-size: 1.35rem;
    font-weight: 700;
    line-height: 1.3;
    word-break: break-word;
}


/* =========================================================
   CARD ICON
   ========================================================= */

/*
   আগে opacity কম থাকার কারণে icon ঝাপসা দেখাচ্ছিল।
   এখন পরিষ্কার এবং সহজে বোঝা যাবে।
*/

.dashboard-card .card-icon {
    font-size: 2.2rem;
    opacity: 0.9;
    color: #6c757d;
    filter: none;
    text-shadow: none;
}


/* =========================================================
   INDIVIDUAL ICON COLORS
   ========================================================= */

.dashboard-card.border-left-primary .card-icon {
    color: #4e73df !important;
}

.dashboard-card.border-left-success .card-icon {
    color: #1cc88a !important;
}

.dashboard-card.border-left-info .card-icon {
    color: #36b9cc !important;
}

.dashboard-card.border-left-secondary .card-icon {
    color: #858796 !important;
}

.dashboard-card.border-left-warning .card-icon {
    color: #f6c23e !important;
}

.dashboard-card.border-left-danger .card-icon {
    color: #e74a3b !important;
}


/* =========================================================
   CARD LINK
   ========================================================= */

.dashboard-cards-row a {
    color: inherit;
}

.dashboard-cards-row a:hover {
    text-decoration: none;
}


/* =========================================================
   LARGE PC
   1200px+
   ========================================================= */

@media (min-width: 1200px) {

    .dashboard-card .card-body {
        padding: 1.25rem;
    }

    .dashboard-card .card-title {
        font-size: 0.78rem;
    }

    .dashboard-card .card-value {
        font-size: 1.35rem;
    }

    .dashboard-card .card-icon {
        font-size: 2.2rem;
    }

}


/* =========================================================
   LAPTOP / SMALL PC
   992px - 1199px
   ========================================================= */

@media (min-width: 992px) and (max-width: 1199px) {

    .dashboard-card .card-body {
        padding: 1.1rem;
    }

    .dashboard-card .card-title {
        font-size: 0.75rem;
    }

    .dashboard-card .card-value {
        font-size: 1.2rem;
    }

    .dashboard-card .card-icon {
        font-size: 2rem;
    }

}


/* =========================================================
   TABLET
   768px - 991px
   ========================================================= */

@media (min-width: 768px) and (max-width: 991px) {

    .dashboard-card .card-body {
        padding: 1rem;
    }

    .dashboard-card .card-title {
        font-size: 0.73rem;
    }

    .dashboard-card .card-value {
        font-size: 1.15rem;
    }

    .dashboard-card .card-icon {
        font-size: 1.9rem;
    }

}


/* =========================================================
   MOBILE
   576px - 767px
   ========================================================= */

@media (min-width: 576px) and (max-width: 767px) {

    .dashboard-card .card-body {
        padding: 1rem;
    }

    .dashboard-card .card-title {
        font-size: 0.72rem;
    }

    .dashboard-card .card-value {
        font-size: 1.1rem;
    }

    .dashboard-card .card-icon {
        font-size: 1.8rem;
        opacity: 0.9;
    }

}


/* =========================================================
   SMALL MOBILE
   Below 576px
   ========================================================= */

@media (max-width: 575px) {

    .dashboard-card .card-body {
        padding: 0.9rem;
    }

    .dashboard-card .card-title {
        font-size: 0.7rem;
        margin-bottom: 0.35rem;
    }

    .dashboard-card .card-value {
        font-size: 1.05rem;
    }

    .dashboard-card .card-icon {
        font-size: 1.7rem;
        opacity: 0.9;
    }

}


/* =========================================================
   VERY SMALL MOBILE
   Below 400px
   ========================================================= */

@media (max-width: 400px) {

    .dashboard-card .card-body {
        padding: 0.8rem;
    }

    .dashboard-card .card-title {
        font-size: 0.65rem;
    }

    .dashboard-card .card-value {
        font-size: 0.98rem;
    }

    .dashboard-card .card-icon {
        font-size: 1.5rem;
        opacity: 0.9;
    }

}


/* =========================================================
   PREVENT CARD CONTENT FROM OVERFLOWING
   ========================================================= */

.dashboard-card .row {
    flex-wrap: nowrap;
}

.dashboard-card .col {
    min-width: 0;
}

.dashboard-card .col-auto {
    flex-shrink: 0;
}


/* =========================================================
   CARD HEIGHT
   ========================================================= */

.dashboard-card {
    min-height: 105px;
}


/* =========================================================
   MOBILE CARD HEIGHT
   ========================================================= */

@media (max-width: 575px) {

    .dashboard-card {
        min-height: 95px;
    }

}


/* =========================================================
   SMOOTH TEXT
   ========================================================= */

.dashboard-card .card-title,
.dashboard-card .card-value,
.dashboard-card .card-icon {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}



</style>
</head>

<body style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;" id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: rgb(32, 92, 232);">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/Logo.jpeg') }}" alt="LMS EDU Logo" style="width:40px;height:40px;object-fit:contain;border-radius:6px;">
                <div class="sidebar-brand-text mx-3">LMS Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
              <!-- লাইব্রেরি ম্যানেজমেন্ট সিস্টেম মেনুবার শুরু -->
<div class="sidebar-heading">
    Library Management
</div>



<!-- ২. নতুন বই যোগ করার ফর্ম -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('add_book') }}">
        <i class="fas fa-fw fa-plus"></i>
        <span>Add New Book</span>
    </a>
</li>

<!-- ৩. সব বইয়ের তালিকা -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('all_books') }}">
        <i class="fas fa-fw fa-book"></i>
        <span>All Books List</span>
    </a>
</li>

<!-- 8. সব edit_book তালিকা -->


<!-- ৪. বই ইস্যু করার ফর্ম -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('issue_book') }}">
        <i class="fas fa-fw fa-arrow-right"></i>
        <span>Issue Book</span>
    </a>
</li>



<!-- ৫. বই ফেরত নেওয়ার ফর্ম -->
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

<!-- 6. সব users তালিকা -->
<li class="nav-item">

    <a class="nav-link collapsed"
       href="#"
       data-toggle="collapse"
       data-target="#collapseUsers"
       aria-expanded="false"
       aria-controls="collapseUsers">

        <i class="fas fa-users fa-fw"></i>

        <span>Users</span>

    </a>


    <div id="collapseUsers"
         class="collapse"
         aria-labelledby="headingUsers"
         data-parent="#accordionSidebar">

        <div class="bg-white py-2 collapse-inner rounded">

            <h6 class="collapse-header">
                User Management:
            </h6>


            {{-- All Users --}}
            <a class="collapse-item"
               href="{{ route('users') }}">

                <i class="fas fa-users mr-2"></i>

                All Users

            </a>


            {{-- Issued Users --}}
            <a class="collapse-item"
               href="{{ route('admin.issued.users') }}">

                <i class="fas fa-book-reader mr-2"></i>

                Issued Users

            </a>

        </div>

    </div>

</li>

<!-- লাইব্রেরি ম্যানেজমেন্ট সিস্টেম মেনুবার শেষ -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
            
           
            

            <!-- Sidebar Toggler (Sidebar) -->
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

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 navbar-search">

    <div class="input-group position-relative" style="width:380px;">

        <input
            type="text"
            id="searchInput"
            class="form-control bg-light border-0 small"
            placeholder="Search books..."
            autocomplete="off">

        <div class="input-group-append">

            <button
                class="btn text-white"
                type="button"
                style="background-color:rgb(32,92,232);">

                <i class="fas fa-search"></i>

            </button>

        </div>

        <div id="searchResult"
             class="list-group shadow position-absolute"
             style="
                top:100%;
                left:0;
                width:100%;
                display:none;
                z-index:9999;
                max-height:350px;
                overflow-y:auto;">
        </div>

    </div>

</form>


                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->

                    <!-- Nav Item - Alerts -->

                    
                        <!-- Nav Item - Notifications -->

  

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                @if(Auth::user()->photo)

<img class="img-profile rounded-circle"
     src="{{ asset('storage/' . Auth::user()->photo) }}">

@else

<img class="img-profile rounded-circle"
     src="{{ asset('assets/img/undraw_profile.svg') }}">

@endif
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
<div class="container-fluid">

<div id="bookCardArea" class="row">

@if(isset($books))

@foreach($books as $book)

<div class="col-xl-3 col-lg-4 col-md-6 mb-4">

    <div class="card shadow-sm h-100 border-0 book-card">

        @if($book->photo)

        <img src="{{ asset('storage/'.$book->photo) }}"
             class="card-img-top"
             style="height:180px;object-fit:cover;">

        @else

        <img src="https://via.placeholder.com/300x180?text=No+Image"
             class="card-img-top"
             style="height:180px;object-fit:cover;">

        @endif

        <div class="card-body">

            <h6 class="font-weight-bold mb-2"
                style="color:#000000d8;">

                {{ $book->title }}

            </h6>

            <p class="font-weight-bold mb-1"
               style="color:#000000d8;">

                {{ $book->author }}

            </p>

            <p class="mb-1">

                {{ $book->genre }}

            </p>

            <p class="mb-2">

                Edition :
                {{ $book->edition }}

            </p>

            <span class="badge badge-success">

                Available :
                {{ $book->available_quantity }}

            </span>

        </div>

        <div class="card-footer bg-white">

            <a href="{{ route('books.edit',$book->id) }}"
               class="btn btn-primary btn-sm">

                <i class="fas fa-edit"></i>

                Edit

            </a>

            <form
                action="{{ route('books.destroy',$book->id) }}"
                method="POST"
                style="display:inline;">

                @csrf

                @method('DELETE')

                <button
                    class="btn btn-danger btn-sm">

                    <i class="fas fa-trash"></i>

                </button>

            </form>

        </div>

    </div>

</div>

@endforeach

@endif

</div>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0" style="color: #000000d8;">Dashboard</h1>
                       <a href="{{ route('report.download') }}"
class="d-none d-sm-inline-block btn btn-sm shadow-sm text-white"
style="background-color: rgb(32, 92, 232);">

    <i class="fas fa-file-pdf fa-sm text-white-50"></i>

    Download PDF

</a>
                    </div>

                

                   <!-- Content Row -->
<!-- Content Row -->
<div class="row dashboard-cards-row">

    <!-- Total Books -->
    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
        <div class="card dashboard-card border-left-primary shadow h-100">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="card-title"
                             style="color: #0d2fefd8;">
                            Total Books Stock
                        </div>

                        <div class="card-value"
                             style="color: #000000d8;">
                            {{ $totalBooks }} Copies
                        </div>

                    </div>

                    <div class="col-auto">
                        <i class="fas fa-book card-icon text-gray-300"></i>
                    </div>

                </div>

            </div>

        </div>
    </div>


    <!-- Available Books -->
    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">

        <div class="card dashboard-card border-left-success shadow h-100">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="card-title"
                             style="color:#198754;">
                            Available Books
                        </div>

                        <div class="card-value"
                             style="color:#000000d8;">
                            {{ $availableBooks }} Copies
                        </div>

                    </div>

                    <div class="col-auto">
                        <i class="fas fa-book-open card-icon text-gray-300"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Issued Books -->
    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">

        <div class="card dashboard-card border-left-success shadow h-100">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="card-title"
                             style="color:#0dc44dd8;">
                            Issued Books
                        </div>

                        <div class="card-value"
                             style="color:#000000d8;">
                            {{ $borrowedBooks }} Books
                        </div>

                    </div>

                    <div class="col-auto">
                        <i class="fas fa-book-reader card-icon text-gray-300"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Active Members -->
    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">

        <div class="card dashboard-card border-left-info shadow h-100">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="card-title"
                             style="color:#33b0cfd8;">
                            Active Members
                        </div>

                        <div class="card-value"
                             style="color:#000000d8;">
                            {{ $activeMembers }} Registered
                        </div>

                    </div>

                    <div class="col-auto">
                        <i class="fas fa-users card-icon text-gray-300"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Returned Books -->
    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">

        <div class="card dashboard-card border-left-secondary shadow h-100">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="card-title text-secondary">
                            Returned Books
                        </div>

                        <div class="card-value"
                             style="color:#000000d8;">
                            {{ $returnedBooks }} Books
                        </div>

                    </div>

                    <div class="col-auto">
                        <i class="fas fa-undo-alt card-icon text-gray-300"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Overdue Returns -->
    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">

        <div class="card dashboard-card border-left-warning shadow h-100">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="card-title"
                             style="color:#eb710ed8;">
                            Overdue Returns
                        </div>

                        <div class="card-value"
                             style="color:#000000d8;">
                            {{ $overdueBooks }} Books
                        </div>

                    </div>

                    <div class="col-auto">
                        <i class="fas fa-exclamation-triangle card-icon text-gray-300"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Damaged Books -->
    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">

        <a href="{{ route('damaged_books') }}"
           style="text-decoration:none;">

            <div class="card dashboard-card border-left-danger shadow h-100">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="card-title text-danger">
                                Damaged Books
                            </div>

                            <div class="card-value text-gray-800">
                                {{ $damagedBooks }} Books
                            </div>

                        </div>

                        <div class="col-auto">
                            <i class="fas fa-book-dead card-icon text-danger"></i>
                        </div>

                    </div>

                </div>

            </div>

        </a>

    </div>


    <!-- Fine Collection -->
    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">

        <div class="card dashboard-card border-left-danger shadow h-100">

            <div class="card-body">

                <div class="row no-gutters align-items-center">

                    <div class="col mr-2">

                        <div class="card-title"
                             style="color:#f31212d8;">
                            Fine Collection
                        </div>

                        <div class="card-value"
                             style="color:#000000d8;">
                            ৳ {{ number_format($fineCollection, 2) }}
                        </div>

                    </div>

                    <div class="col-auto">
                        <i class="fas fa-money-bill-wave card-icon text-gray-300"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
    

    <!-- Report Table -->

    <div class="card shadow mb-4">

        <div class="card-header text-white" 
          style="background-color: rgb(32, 92, 232)!important;">
            <h5 class="mb-0">
                <i class="fas fa-table"></i>
                Monthly Report Summary
            </h5>
           
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="bg-light">

                        <tr>

                            <th>Month</th>
                            <th>Total Books</th>
                            <th>Issued</th>
                            <th>Returned</th>
                            <th>Late Return</th>
                            <th>Fine</th>
                            <th>Book Price</th>
                            <th>Late Fee</th>
                            <th>Total Payable</th>
                            
                        </tr>

                    </thead>

                    <tbody>

@forelse($monthlyReports as $report)

<tr>

    <td>{{ $report->month }}</td>

    <td>{{ $totalBooks }}</td>

    <td>{{ $report->issued }}</td>

    <td>{{ $returnedBooks }}</td>

    <td>{{ $overdueBooks }}</td>

     <td>৳ {{ number_format($fineCollection,2) }}</td>

</tr>

@empty

<tr>

    <td colspan="6" class="text-center">

        No Report Available

    </td>

</tr>

@endforelse

</tbody>

                </table>

            </div>

        </div>

    </div>

    @if(!empty($keyword))

<div class="card shadow mb-4">

    <div class="card-header d-flex justify-content-between align-items-center text-white"
        style="background-color: rgb(32,92,232);">

        <h5 class="mb-0">
            <i class="fas fa-search mr-2"></i>
            Search Result
        </h5>

        <span class="badge badge-light text-primary p-2">
            {{ $searchBooks->count() }} Book(s) Found
        </span>

    </div>

    <div class="card-body">

        <div class="alert alert-primary">

            <strong>Keyword :</strong>

            "{{ $keyword }}"

        </div>

        @if($searchBooks->count())

        <div class="row">
            @foreach($searchBooks as $book)

<div class="col-xl-4 col-lg-6 col-md-6 mb-4">

    <div class="card border-0 shadow h-100">

        @if($book->photo)

        <img src="{{ asset('storage/'.$book->photo) }}"
             style="height:250px;object-fit:cover;"
             class="card-img-top">

        @else

        <img src="https://via.placeholder.com/300x250?text=No+Image"
             style="height:250px;object-fit:cover;"
             class="card-img-top">

        @endif

        <div class="card-body">

            <h5 class="font-weight-bold">

                {{ $book->title }}

            </h5>

            <hr>

            <p>

                <i class="fas fa-user text-primary"></i>

                <strong>Author :</strong>

                {{ $book->author }}

            </p>

            <p>

                <i class="fas fa-book text-success"></i>

                <strong>Genre :</strong>

                {{ $book->genre }}

            </p>

            <p>

                <i class="fas fa-layer-group text-warning"></i>

                <strong>Edition :</strong>

                {{ $book->edition }}

            </p>

            <p>

                <i class="fas fa-box text-info"></i>

                <strong>Available :</strong>

                {{ $book->available_quantity }}

            </p>

            @if($book->available_quantity>0)

            <span class="badge badge-success p-2">

                Available

            </span>

            @else

            <span class="badge badge-danger p-2">

                Out of Stock

            </span>

            @endif

        </div>

        <div class="card-footer bg-white text-center">

            <a href="{{ route('books.edit',$book->id) }}"
               class="btn btn-primary btn-sm w-100 mb-2">

                <i class="fas fa-edit"></i>

                Edit

            </a>

            <form action="{{ route('books.destroy',$book->id) }}"
                  method="POST"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button
                    class="btn btn-danger btn-sm w-100"
                    onclick="return confirm('Delete this book?')">

                    <i class="fas fa-trash"></i>

                    Delete

                </button>

            </form>

            

        </div>

    </div>

</div>

@endforeach
        </div>

        @else

        <div class="alert alert-danger text-center">

            <h5>

                <i class="fas fa-times-circle"></i>

                No Book Found

            </h5>

            <p>

                Try another keyword.

            </p>

        </div>

        @endif

    </div>

</div>

@endif

                    <!-- Content Row -->

                    
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Website LMS </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

<script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

<script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>

<script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>

<script>
$(document).ready(function () {

    // Live Search
    $(document).on("keyup", "#searchInput", function () {

        let search = $(this).val();

        if ($.trim(search).length < 1) {
            $("#searchResult").hide();
            return;
        }

        $.ajax({

            url: "{{ route('admin.live.search') }}",

            type: "GET",

            data: {
                search: search
            },

            success: function (data) {

                let html = "";

                if (data.length > 0) {

                    data.forEach(function (book) {

                        html += `
                        <a href="#"
                           class="list-group-item list-group-item-action suggestion"
                           data-id="${book.id}">

                            <strong>${book.title}</strong><br>

                            <small>${book.author} | ${book.genre}</small>

                        </a>`;
                    });

                } else {

                    html = `
                    <div class="list-group-item">
                        No Book Found
                    </div>`;
                }

                $("#searchResult").html(html).show();

            }

        });

    });


    // Suggestion Click
    $(document).on("click", ".suggestion", function (e) {

        e.preventDefault();

        let id = $(this).data("id");

        $("#searchResult").hide();

        $.ajax({

            url: "{{ url('/admin/book') }}/" + id,

            type: "GET",

            success: function (book) {

                let photo = book.photo
                    ? "{{ asset('storage') }}/" + book.photo
                    : "https://via.placeholder.com/300x180?text=No+Image";

                let card = `

<div class="col-xl-3 col-lg-4 col-md-6 mb-4">

    <div class="card shadow-sm h-100 border-0">

        <img src="${photo}"
             class="card-img-top"
             style="height:180px;object-fit:cover;">

        <div class="card-body">

            <h6 class="font-weight-bold"
                style="color:#000000d8;">

                ${book.title}

            </h6>

            <p class="font-weight-bold mb-1"
               style="color:#000000d8;">

                ${book.author}

            </p>

            <p class="mb-1">

                ${book.genre}

            </p>

            <p class="mb-2">

                Edition : ${book.edition}

            </p>

            <span class="badge badge-success">

                Available : ${book.available_quantity}

            </span>

        </div>

        <div class="card-footer bg-white text-center">

            <a href="/books/${book.id}/edit"
               class="btn btn-primary btn-sm">

                <i class="fas fa-edit"></i>

                Edit

            </a>

            <form action="/books/${book.id}"
                  method="POST"
                  style="display:inline;">

                <input type="hidden"
                       name="_token"
                       value="{{ csrf_token() }}">

                <input type="hidden"
                       name="_method"
                       value="DELETE">

                <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete this book?')">

                    <i class="fas fa-trash"></i>

                </button>

            </form>

        </div>

    </div>

</div>
`;

                $("#bookCardArea").html(card);

            }

        });

    });

});
</script>
</body>

</html>