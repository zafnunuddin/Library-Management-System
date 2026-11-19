<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Profile - Library Management System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>

body{
    background:#f4f6f9;
    font-family:'Segoe UI',sans-serif;
}

.navbar{
    background:#0d6efd;
}

.navbar-brand,
.nav-link{
    color:white!important;
}

.profile-card{
    border:none;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.profile-img{
    width:170px;
    height:170px;
    object-fit:cover;
    border-radius:50%;
    border:5px solid #0d6efd;
}

.info-card{
    border:none;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

[data-bs-theme="dark"] body{
    background:#121212;
}

[data-bs-theme="dark"] .profile-card,
[data-bs-theme="dark"] .info-card{
    background:#1f1f1f;
    color:white;
}

</style>

</head>

<body style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">

<nav class="navbar navbar-expand-lg shadow">

<div class="container">

<a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('user.dashboard') }}">
<img src="{{ asset('images/Logo.jpeg') }}" alt="LMS EDU Logo" style="width:32px;height:32px;object-fit:contain;border-radius:6px;margin-right:8px;">
LMS Student Panel
</a>

<div class="ms-auto d-flex">

<button id="themeToggle" class="btn btn-outline-light btn-sm me-2">
🌙 Dark
</button>

<form action="{{ route('logout') }}" method="POST">
@csrf

<button class="btn btn-danger btn-sm">

Logout

</button>

</form>

</div>

</div>

</nav>

<div class="container py-5">

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

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

<div class="row">

<div class="col-lg-4">

<div class="card profile-card">

<div class="card-body text-center">

<img
src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://via.placeholder.com/170' }}"
class="profile-img mb-3">

<h3>{{ $user->name }}</h3>

<p class="text-muted">

Library Member

</p>

<hr>

<p>

<i class="bi bi-envelope-fill text-primary"></i>

{{ $user->email }}

</p>

<p>

<i class="bi bi-telephone-fill text-success"></i>

{{ $user->phone }}

</p>

<p>

<i class="bi bi-calendar-check-fill text-warning"></i>

Member Since :

{{ \Carbon\Carbon::parse($user->member_since)->format('F Y') }}

</p>

</div>

</div>

</div>

<div class="col-lg-8">

<div class="card info-card">

<div class="card-header bg-primary text-white">

<h4>

<i class="bi bi-person-fill"></i>

My Profile

</h4>

</div>

<div class="card-body">

<form action="{{ route('user.profile.update') }}"
method="POST"
enctype="multipart/form-data">

@csrf

<div class="row">

<div class="col-md-6 mb-3">

<label>Full Name</label>

<input
type="text"
name="name"
class="form-control"
value="{{ $user->name }}">

</div>

<div class="col-md-6 mb-3">

<label>Student ID</label>

<input
type="text"
name="student_id"
class="form-control"
value="{{ $user->student_id }}">

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="{{ $user->email }}">

</div>

<div class="col-md-6 mb-3">

<label>Department</label>

<input
type="text"
name="department"
class="form-control"
value="{{ $user->department }}">

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label>Phone</label>

<input
type="text"
name="phone"
class="form-control"
value="{{ $user->phone }}">

</div>

<div class="col-md-6 mb-3">

<label>Semester</label>

<input
type="text"
name="semester"
class="form-control"
value="{{ $user->semester }}">

</div>

</div>

<div class="mb-3">

<label>Address</label>

<textarea
name="address"
class="form-control"
rows="3">{{ $user->address }}</textarea>

</div>

<div class="mb-3">

<label>Profile Photo</label>

<input
type="file"
name="photo"
class="form-control">

</div>

<div class="text-end">

<button
type="button"
class="btn btn-warning">

<i class="bi bi-key-fill"></i>

Change Password

</button>

<button
type="submit"
class="btn btn-primary">

<i class="bi bi-check-circle-fill"></i>

Update Profile

</button>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

<script>

const btn=document.getElementById("themeToggle");

btn.onclick=function(){

const html=document.documentElement;

if(html.getAttribute("data-bs-theme")=="light"){

html.setAttribute("data-bs-theme","dark");

btn.innerHTML="☀️ Light";

}else{

html.setAttribute("data-bs-theme","light");

btn.innerHTML="🌙 Dark";

}

}

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>