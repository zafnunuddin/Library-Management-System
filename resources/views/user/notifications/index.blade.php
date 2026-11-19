<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notifications</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body class="bg-light" style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">

<div class="container py-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4>
<i class="bi bi-bell-fill"></i>
My Notifications
</h4>

</div>

<div class="card-body">

<div class="list-group">

<a href="#" class="list-group-item list-group-item-action">

<i class="bi bi-book text-primary"></i>

Your requested book has been approved.

<span class="float-end text-muted">
Today
</span>

</a>

<a href="#" class="list-group-item list-group-item-action">

<i class="bi bi-exclamation-circle text-danger"></i>

Your borrowed book is due tomorrow.

<span class="float-end text-muted">
Yesterday
</span>

</a>

<a href="#" class="list-group-item list-group-item-action">

<i class="bi bi-check-circle text-success"></i>

Book returned successfully.

<span class="float-end text-muted">
2 Days Ago
</span>

</a>

<a href="#" class="list-group-item list-group-item-action">

<i class="bi bi-cash text-warning"></i>

Fine payment received successfully.

<span class="float-end text-muted">
Last Week
</span>

</a>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>