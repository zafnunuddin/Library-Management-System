<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Messages</title>

<link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-light" style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h5>
<i class="fas fa-envelope"></i>
Messages
</h5>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>Name</th>
<th>Email</th>
<th>Subject</th>
<th>Message</th>
<th>Date</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<tr>

<td>Anika</td>

<td>243011112@eastdelta.edu.bd</td>

<td>Book Request</td>

<td>Need Laravel Programming Book.</td>

<td>07-07-2026</td>

<td>

                                <button class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <button class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
</td>

</tr>

<tr>

<td>Sohel</td>

<td>232013912@eastdelta.edu.bd</td>

<td>Fine Issue</td>

<td>Please reduce my fine amount.</td>

<td>06-07-2026</td>

<td>

                                <button class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <button class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </td>

</tr>

<tr>

<td>Nidhi</td>

<td>241002612@eastdelta.edu.bd</td>

<td>Account Problem</td>

<td>Unable to login to dashboard.</td>

<td>05-07-2026</td>

<td>

                                <button class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <button class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </td>

</tr>

</tbody>

</table>

</div>

</div>

</div>

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

</body>
</html>