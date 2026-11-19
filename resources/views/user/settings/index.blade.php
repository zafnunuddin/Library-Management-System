<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Settings</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body class="bg-light" style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">

<div class="container py-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h4>

<i class="bi bi-gear-fill"></i>

Account Settings

</h4>

</div>

<div class="card-body">

<form>

<div class="mb-3">

<label class="form-label">

Current Password

</label>

<input
type="password"
class="form-control">

</div>

<div class="mb-3">

<label class="form-label">

New Password

</label>

<input
type="password"
class="form-control">

</div>

<div class="mb-3">

<label class="form-label">

Confirm Password

</label>

<input
type="password"
class="form-control">

</div>

<div class="text-end">

<button class="btn btn-success">

<i class="bi bi-key-fill"></i>

Update Password

</button>

</div>

</form>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>