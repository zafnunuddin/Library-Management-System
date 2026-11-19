<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-light" style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-warning text-dark">
<h5><i class="fas fa-bell"></i> Notifications</h5>
</div>

<div class="card-body">

<div class="list-group">

<a href="#" class="list-group-item list-group-item-action">
<i class="fas fa-book text-primary"></i>
New Book Added Successfully.
<small class="float-right text-muted">2 min ago</small>
</a>

<a href="#" class="list-group-item list-group-item-action">
<i class="fas fa-arrow-right text-success"></i>
Book Issued Successfully.
<small class="float-right text-muted">10 min ago</small>
</a>

<a href="#" class="list-group-item list-group-item-action">
<i class="fas fa-undo text-info"></i>
Book Returned Successfully.
<small class="float-right text-muted">25 min ago</small>
</a>

<a href="#" class="list-group-item list-group-item-action">
<i class="fas fa-exclamation-circle text-danger"></i>
Late Return Fine Generated.
<small class="float-right text-muted">Today</small>
</a>

<a href="#" class="list-group-item list-group-item-action">
<i class="fas fa-user text-secondary"></i>
New User Registered.
<small class="float-right text-muted">Yesterday</small>
</a>

</div>

</div>

</div>

</div>

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

</body>
</html>