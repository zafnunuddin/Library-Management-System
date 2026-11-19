<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Admin - Overdue Books & Defaulters List</title>

    <!-- All external resources use CDN links, so this single HTML file can be opened directly in a browser. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        body {
            font-family: "Nunito", Arial, sans-serif;
            background: #f8f9fc;
            color: #5a5c69;
        }
        #wrapper { display: flex; min-height: 100vh; }
        .sidebar {
            width: 224px;
            min-height: 100vh;
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            flex-shrink: 0;
        }
        .sidebar-brand {
            height: 70px;
            text-decoration: none !important;
            color: white !important;
            font-weight: 800;
            font-size: 1rem;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.8);
            padding: .85rem 1rem;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-item.active .nav-link {
            color: #fff;
            background: rgba(255,255,255,.12);
        }
        .sidebar .nav-link i { width: 24px; }
        .sidebar-divider {
            border-top: 1px solid rgba(255,255,255,.15);
            margin: 0 1rem 1rem;
        }
        .sidebar-heading {
            color: rgba(255,255,255,.5);
            font-size: .72rem;
            font-weight: 800;
            text-transform: uppercase;
            padding: 0 1rem .5rem;
        }
        #content-wrapper { flex: 1; min-width: 0; display: flex; flex-direction: column; }
        #content { flex: 1; }
        .topbar {
            height: 70px;
            background: white;
            box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15);
        }
        .card {
            border: 0;
            box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.1);
        }
        .card-header {
            background: white;
            border-bottom: 1px solid #e3e6f0;
        }
        .text-primary { color: #4e73df !important; }
        .btn-primary {
            background: #4e73df;
            border-color: #4e73df;
        }
        .table th {
            white-space: nowrap;
            background: #f8f9fc;
            color: #5a5c69;
        }
        .empty-state {
            padding: 35px 10px !important;
            color: #858796;
        }
        footer { padding: 1.5rem 0; }
        @media (max-width: 768px) {
            .sidebar { width: 70px; }
            .sidebar-brand-text, .sidebar .nav-link span, .sidebar-heading { display: none; }
            .sidebar .nav-link { text-align: center; }
            .sidebar .nav-link i { margin: 0; }
        }
        @media print {
            .sidebar, .topbar, .breadcrumb, .btn, footer { display: none !important; }
            #wrapper, #content-wrapper { display: block; }
            .card { box-shadow: none; }
            .container-fluid { width: 100%; }
        }
    </style>
</head>

<body>
<div id="wrapper">

    <aside class="sidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#dashboard">
            <div class="mr-2"><i class="fas fa-book"></i></div>
            <div class="sidebar-brand-text">LMS Admin</div>
        </a>

        <hr class="sidebar-divider my-0">

        <div class="mt-3">
            <div class="nav-item">
                <a class="nav-link" href="#dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Interface</div>

            <div class="nav-item">
                <a class="nav-link" href="#tables">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span>
                </a>
            </div>

            <div class="nav-item active">
                <a class="nav-link" href="#defaulters">
                    <i class="fas fa-fw fa-exclamation-triangle"></i>
                    <span>Defaulters List</span>
                </a>
            </div>
        </div>
    </aside>

    <div id="content-wrapper">
        <div id="content">

            <nav class="navbar navbar-expand navbar-light topbar mb-4">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"
                        type="button" aria-label="Toggle sidebar">
                    <i class="fa fa-bars"></i>
                </button>
                <span class="font-weight-bold text-gray-800">Library Management System</span>
            </nav>

            <main class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Overdue Books &amp; Defaulters List</h1>
                    <button id="generateReport" class="btn btn-sm btn-primary shadow-sm" type="button">
                        <i class="fas fa-download fa-sm text-white-50"></i>
                        Generate Report
                    </button>
                </div>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="#dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Overdue Books &amp; Defaulters List
                        </li>
                    </ol>
                </nav>

                <section class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Overdue Books Table</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable" width="100%">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Book Name</th>
                                        <th>Due Date</th>
                                        <th>Overdue Days</th>
                                        <th>Fine</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Add database/PHP records here when connecting this page to Laravel/PHP. -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Book Name</th>
                                        <th>Due Date</th>
                                        <th>Overdue Days</th>
                                        <th>Fine</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </section>
            </main>
        </div>

        <footer class="bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; LMS Admin 2026</span>
                </div>
            </div>
        </footer>
    </div>
</div>

<!-- JavaScript dependencies -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function () {
    // Initialize the table without requiring any local project files.
    $('#dataTable').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        language: {
            emptyTable: "No overdue records found",
            search: "Search:"
        },
        columnDefs: [
            { targets: 4, type: "num" }
        ]
    });

    // Generate/print the current report.
    $('#generateReport').on('click', function () {
        window.print();
    });

    // Mobile sidebar toggle.
    $('#sidebarToggleTop').on('click', function () {
        $('.sidebar').toggle();
    });
});
</script>
</body>
</html>
