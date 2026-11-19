<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Change Password</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-light" style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-lg-6">

<div class="card shadow">

<div class="card-header bg-warning text-dark">

<h4 class="mb-0">

<i class="fas fa-key"></i>

Change Password

</h4>

</div>

<div class="card-body">

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif

@if(session('error'))

<div class="alert alert-danger">

{{ session('error') }}

</div>

@endif

@if($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif

<form action="{{ route('password.update') }}" method="POST">

@csrf

<div class="form-group">

<label>

Current Password

</label>

<div class="input-group">

<input
type="password"
name="current_password"
id="current_password"
class="form-control"
required>

<div class="input-group-append">

<button
class="btn btn-outline-secondary"
type="button"
onclick="togglePassword('current_password')">

<i class="fas fa-eye"></i>

</button>

</div>

</div>

</div>

<div class="form-group">

<label>

New Password

</label>

<div class="input-group">

<input
type="password"
name="new_password"
id="new_password"
class="form-control"
required>

<div class="input-group-append">

<button
class="btn btn-outline-secondary"
type="button"
onclick="togglePassword('new_password')">

<i class="fas fa-eye"></i>

</button>

</div>

</div>

</div>

<div class="form-group">

<label>

Confirm Password

</label>

<div class="input-group">

<input
type="password"
name="new_password_confirmation"
id="confirm_password"
class="form-control"
required>

<div class="input-group-append">

<button
class="btn btn-outline-secondary"
type="button"
onclick="togglePassword('confirm_password')">

<i class="fas fa-eye"></i>

</button>

</div>

</div>

</div>

<hr>

<div class="text-right">

<a href="{{ route('profile') }}"
class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Back

</a>

<button
type="submit"
class="btn btn-warning">

<i class="fas fa-save"></i>

Update Password

</button>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

<script>

function togglePassword(id){

let input=document.getElementById(id);

if(input.type==="password"){

input.type="text";

}else{

input.type="password";

}

}

</script>

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

</body>

</html>