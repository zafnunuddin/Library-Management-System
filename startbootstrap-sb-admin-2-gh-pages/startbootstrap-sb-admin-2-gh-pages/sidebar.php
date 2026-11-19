<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LMS Admin - Overdue Books & Defaulters List</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900">

    <!-- Bootstrap -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- DataTables -->
    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">

    <style>
        body {
            font-family: "Nunito", sans-serif;
            background-color: #f8f9fc;
            margin: 0;
        }

        #wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 224px;
            min-height: 100vh;
            flex-shrink: 0;
            background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
        }

        .sidebar-brand {
            height: 70px;
            text-decoration: none;
            color: #ffffff;
        }

        .sidebar-brand:hover {
            color: #ffffff;
            text-decoration: none;
        }

        .sidebar-brand-icon {
            font-size: 24px;
        }

        .sidebar-brand-text {
            font-weight: 800;
        }

        .sidebar-divider {
            margin: 0 16px 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }

        .sidebar-heading {
            padding: 0 16px;
            margin-bottom: 8px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 16px;
        }

        .sidebar .nav-link:hover {
            color: #ffffff;
        }

        .sidebar .nav-item.active .nav-link {
            color: #ffffff;
            font-weight: 700;
        }

        .sidebar .nav-link i {
            margin-right: 8px;
        }

        .collapse-inner {
            margin: 0 16px;
            border-radius: 5px;
        }

        .collapse-item {
            display: block;
            padding: 8px 16px;
            color: #3a3b45;
            text-decoration: none;
            font-size: 14px;
        }

        .collapse-item:hover {
            background-color: #eaecf4;
            text-decoration: none;
            color: #224abe;
        }

        #content-wrapper {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        #content {
            flex: 1;
        }

        .topbar {
            height: 70px;
            min-height: 70px;
        }

        .navbar-search {
            max-width: 400px;
            width: 100%;
        }

        .card {
            border: none;
        }

        .border-left-danger {
            border-left: 4px solid #e74a3b !important;
        }

        .border-left-warning {
            border-left: 4px solid #f6c23e !important;
        }

        .text-xs {
            font-size: 11px;
        }

        .table th {
            white-space: nowrap;
            vertical-align: middle;
        }

        .table td {
            vertical-align: middle;
        }

        .footer {
            padding: 24px 0;
        }

        .scroll-to-top {
            position: fixed;
            right: 16px;
            bottom: 16px;
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.25);
            color: #ffffff;
            text-decoration: none;
        }

        .scroll-to-top:hover {
            color: #ffffff;
            background-color: rgba(0, 0, 0, 0.4);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 90px;
            }

            .sidebar-brand-text,
            .sidebar .nav-link span,
            .sidebar-heading {
                display: none;
            }

            .sidebar-brand {
                justify-content: center !important;
            }

            .sidebar .nav-link {
                text-align: center;
            }

            .sidebar .nav-link i {
                margin-right: 0;
            }

            .navbar-search {
                max-width: 100%;
            }
        }

        @media print {
            .sidebar,
            .topbar,
            .breadcrumb,
            .btn,
            .scroll-to-top,
            footer {
                display: none !important;
            }

            #content-wrapper {
                width: 100%;
            }

            .card {
                box-shadow: none !important;
            }
        }
    </style>
</head>

<body id="page-top">

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center"
           href="index.html">

            <div class="sidebar-brand-icon">
                <i class="fas fa-book"></i>
            </div>

            <div class="sidebar-brand-text mx-3">
                My Project
            </div>
        </a>

        <hr class="sidebar-divider my-0">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Components -->
        <li class="nav-item">
            <a class="nav-link collapsed"
               href="#"
               data-toggle="collapse"
               data-target="#collapseComponents"
               aria-expanded="false"
               aria-controls="collapseComponents">

                <i class="fas fa-fw fa-cog"></i>
                <span>Components</span>
            </a>

            <div id="collapseComponents"
                 class="collapse"
                 data-parent="#accordionSidebar">

                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Components:</h6>

                    <a class="collapse-item" href="buttons.html">
                        Buttons
                    </a>

                    <a class="collapse-item" href="cards.html">
                        Cards
                    </a>
                </div>
            </div>
        </li>

        <!-- Utilities -->
        <li class="nav-item">
            <a class="nav-link collapsed"
               href="#"
               data-toggle="collapse"
               data-target="#collapseUtilities"
               aria-expanded="false"
               aria-controls="collapseUtilities">

                <i class="fas fa-fw fa-wrench"></i>
                <span>Utilities</span>
            </a>

            <div id="collapseUtilities"
                 class="collapse"
                 data-parent="#accordionSidebar">

                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Utilities:</h6>

                    <a class="collapse-item" href="utilities-color.html">
                        Colors
                    </a>

                    <a class="collapse-item" href="utilities-border.html">
                        Borders
                    </a>

                    <a class="collapse-item" href="utilities-animation.html">
                        Animations
                    </a>

                    <a class="collapse-item" href="utilities-other.html">
                        Other
                    </a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Addons
        </div>

        <!-- Pages -->
        <li class="nav-item">
            <a class="nav-link collapsed"
               href="#"
               data-toggle="collapse"
               data-target="#collapsePages"
               aria-expanded="false"
               aria-controls="collapsePages">

                <i class="fas fa-fw fa-folder"></i>
                <span>Pages</span>
            </a>

            <div id="collapsePages"
                 class="collapse"
                 data-parent="#accordionSidebar">

                <div class="bg-white py-2 collapse-inner rounded">

                    <h6 class="collapse-header">
                        Login Screens:
                    </h6>

                    <a class="collapse-item" href="login.html">
                        Login
                    </a>

                    <a class="collapse-item" href="register.html">
                        Register
                    </a>

                    <a class="collapse-item" href="forgot-password.html">
                        Forgot Password
                    </a>

                    <div class="collapse-divider"></div>

                    <h6 class="collapse-header">
                        Other Pages:
                    </h6>

                    <a class="collapse-item" href="404.html">
                        404 Page
                    </a>

                    <a class="collapse-item" href="blank.html">
                        Blank Page
                    </a>

                </div>
            </div>
        </li>

        <!-- Charts -->
        <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Charts</span>
            </a>
        </li>

        <!-- Tables -->
        <li class="nav-item">
            <a class="nav-link" href="tables.html">
                <i class="fas fa-fw fa-table"></i>
                <span>Tables</span>
            </a>
        </li>

        <!-- Defaulters -->
        <li class="nav-item active">
            <a class="nav-link" href="defaulters.html">
                <i class="fas fa-fw fa-exclamation-triangle"></i>
                <span>Defaulters List</span>
            </a>
        </li>

        <hr class="sidebar-divider">

        <!-- Sidebar Toggle -->
        <div class="text-center d-none d-md-inline">
            <button type="button"
                    class="rounded-circle border-0"
                    id="sidebarToggle"
                    aria-label="Toggle Sidebar">
            </button>
        </div>

    </ul>

    <!-- Content Wrapper -->
    <div id="content-wrapper">

        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">

                <!-- Mobile Sidebar Toggle -->
                <button type="button"
                        id="sidebarToggleTop"
                        class="btn btn-link d-md-none rounded-circle mr-3"
                        aria-label="Toggle Sidebar">

                    <i class="fa fa-bars"></i>
                </button>

                <!-- Search -->
                <form class="form-inline mr-auto ml-md-3 my-2 my-md-0 navbar-search"
                      onsubmit="return false;">

                    <div class="input-group w-100">

                        <input type="text"
                               id="topSearch"
                               class="form-control bg-light border-0 small"
                               placeholder="Search for..."
                               aria-label="Search">

                        <div class="input-group-append">

                            <button type="button"
                                    id="searchButton"
                                    class="btn btn-primary"
                                    aria-label="Search">

                                <i class="fas fa-search fa-sm"></i>

                            </button>

                        </div>
                    </div>
                </form>

                <!-- User -->
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item dropdown no-arrow">

                        <a class="nav-link dropdown-toggle"
                           href="#"
                           id="userDropdown"
                           role="button"
                           data-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="false">

                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                Douglas McGee
                            </span>

                            <i class="fas fa-user-circle fa-2x text-gray-500"></i>

                        </a>

                        <div class="dropdown-menu dropdown-menu-right shadow"
                             aria-labelledby="userDropdown">

                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>

                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="#">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>

                        </div>

                    </li>
                </ul>

            </nav>

            <!-- Main Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">

                    <h1 class="h3 mb-0 text-gray-800">
                        Overdue Books &amp; Defaulters List
                    </h1>

                    <button type="button"
                            id="generateReport"
                            class="btn btn-sm btn-primary shadow-sm">

                        <i class="fas fa-download fa-sm text-white-50"></i>
                        Generate Report

                    </button>

                </div>

                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">

                    <ol class="breadcrumb mb-4">

                        <li class="breadcrumb-item">
                            <a href="index.html">
                                Dashboard
                            </a>
                        </li>

                        <li class="breadcrumb-item active"
                            aria-current="page">

                            Overdue Books &amp; Defaulters List

                        </li>

                    </ol>
                </nav>

                <!-- Statistics -->
                <div class="row">

                    <!-- Total Defaulters -->
                    <div class="col-xl-3 col-md-6 mb-4">

                        <div class="card border-left-danger shadow h-100 py-2">

                            <div class="card-body">

                                <div class="row no-gutters align-items-center">

                                    <div class="col mr-2">

                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            Total Defaulters
                                        </div>

                                        <div id="totalDefaulters"
                                             class="h5 mb-0 font-weight-bold text-gray-800">
                                            0
                                        </div>

                                    </div>

                                    <div class="col-auto">
                                        <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Fine -->
                    <div class="col-xl-3 col-md-6 mb-4">

                        <div class="card border-left-warning shadow h-100 py-2">

                            <div class="card-body">

                                <div class="row no-gutters align-items-center">

                                    <div class="col mr-2">

                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Total Fine
                                        </div>

                                        <div id="totalFine"
                                             class="h5 mb-0 font-weight-bold text-gray-800">
                                            0 BDT
                                        </div>

                                    </div>

                                    <div class="col-auto">
                                        <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Data Table -->
                <div class="card shadow mb-4">

                    <div class="card-header py-3">

                        <h6 class="m-0 font-weight-bold text-primary">
                            Overdue Books Table
                        </h6>

                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-bordered table-hover"
                                   id="dataTable"
                                   width="100%"
                                   cellspacing="0">

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

                                    <tr>
                                        <td>102344</td>
                                        <td>Ayesha Begum</td>
                                        <td>Data Structures &amp; Algorithms</td>
                                        <td>2026-05-10</td>
                                        <td>15 Days</td>
                                        <td>500 BDT</td>
                                    </tr>

                                    <tr>
                                        <td>102345</td>
                                        <td>Rahim Ahmed</td>
                                        <td>Operating System Concepts</td>
                                        <td>2026-05-01</td>
                                        <td>24 Days</td>
                                        <td>500 BDT</td>
                                    </tr>

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
                </div>

            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white footer">

            <div class="container">

                <div class="text-center">

                    <span>
                        Copyright &copy; My Project 2026
                    </span>

                </div>

            </div>

        </footer>

    </div>
</div>

<!-- Scroll to Top -->
<a class="scroll-to-top rounded"
   href="#page-top"
   aria-label="Scroll to top">

    <i class="fas fa-angle-up"></i>

</a>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function () {

    var table = $("#dataTable").DataTable({
        pageLength: 10,
        ordering: true,
        searching: true,
        info: true,
        lengthChange: true
    });

    function updateStatistics() {

        var rows = table.rows({
            search: "applied"
        }).nodes();

        var totalDefaulters = rows.length;
        var totalFine = 0;

        $(rows).each(function () {

            var fineText = $(this)
                .find("td:eq(5)")
                .text()
                .replace(/[^0-9.]/g, "");

            var fine = parseFloat(fineText);

            if (!isNaN(fine)) {
                totalFine += fine;
            }
        });

        $("#totalDefaulters").text(totalDefaulters);

        $("#totalFine").text(
            totalFine.toLocaleString("en-BD") + " BDT"
        );
    }

    $("#searchButton").on("click", function () {

        table
            .search($("#topSearch").val())
            .draw();

    });

    $("#topSearch").on("keyup", function (event) {

        if (event.key === "Enter") {

            table
                .search($(this).val())
                .draw();

        }
    });

    table.on("draw", function () {
        updateStatistics();
    });

    $("#generateReport").on("click", function () {
        window.print();
    });

    $("#sidebarToggleTop").on("click", function () {

        $(".sidebar").toggleClass("toggled");

    });

    $("#sidebarToggle").on("click", function () {

        $(".sidebar").toggleClass("toggled");

    });

    $(".scroll-to-top").on("click", function (event) {

        event.preventDefault();

        $("html, body").animate({
            scrollTop: 0
        }, 500);

    });

    updateStatistics();

});
</script>

</body>
</html>