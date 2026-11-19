<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Profile</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;" id="page-top">

<div class="container-fluid mt-4">

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="row">

    <!-- Left Side -->

    <div class="col-lg-4">

        <div class="card shadow mb-4">

            <div class="card-body text-center">

                @if($user->photo)

                    <img src="{{ asset('storage/'.$user->photo) }}"
                         class="rounded-circle mb-3"
                         width="180"
                         height="180"
                         style="object-fit:cover;">

                @else

                    <img src="{{ asset('assets/img/undraw_profile.svg') }}"
                         class="rounded-circle mb-3"
                         width="180">

                @endif

                <h4 class="font-weight-bold">

                    {{ $user->name }}

                </h4>

                <p class="text-muted">

                    {{ ucfirst($user->role) }}

                </p>

                <hr>

                <p>

                    <i class="fas fa-envelope text-primary"></i>

                    {{ $user->email }}

                </p>

                <p>

                    <i class="fas fa-phone text-success"></i>

                    {{ $user->phone ?? 'Not Added' }}

                </p>

                <p>

                    <i class="fas fa-building text-info"></i>

                    {{ $user->department ?? 'Not Added' }}

                </p>

                <p>

                    <i class="fas fa-map-marker-alt text-danger"></i>

                    {{ $user->address ?? 'Not Added' }}

                </p>

                <p>

                    <i class="fas fa-calendar text-warning"></i>

                    Joined :

                    {{ $user->created_at->format('d M Y') }}

                </p>

                <span class="badge badge-success">

                    Active

                </span>

            </div>

        </div>

    </div>

    <!-- Right Side -->

    <div class="col-lg-8">

        <div class="card shadow mb-4">

            <div class="card-header bg-primary text-white">

                <h5 class="m-0">

                    <i class="fas fa-user mr-2"></i>

                    Profile Information

                </h5>

            </div>

            <div class="card-body">

            <div class="row">

    <div class="col-md-6 mb-3">

        <label class="font-weight-bold">

            Full Name

        </label>

        <input type="text"
               class="form-control"
               value="{{ $user->name }}"
               readonly>

    </div>

    <div class="col-md-6 mb-3">

        <label class="font-weight-bold">

            Email

        </label>

        <input type="text"
               class="form-control"
               value="{{ $user->email }}"
               readonly>

    </div>

</div>


<div class="row">

    <div class="col-md-6 mb-3">

        <label class="font-weight-bold">

            Phone

        </label>

        <input type="text"
               class="form-control"
               value="{{ $user->phone ?? 'Not Added' }}"
               readonly>

    </div>

    <div class="col-md-6 mb-3">

        <label class="font-weight-bold">

            Department

        </label>

        <input type="text"
               class="form-control"
               value="{{ $user->department ?? 'Not Added' }}"
               readonly>

    </div>

</div>


<div class="row">

    <div class="col-md-6 mb-3">

        <label class="font-weight-bold">

            Role

        </label>

        <input type="text"
               class="form-control"
               value="{{ ucfirst($user->role) }}"
               readonly>

    </div>

    <div class="col-md-6 mb-3">

        <label class="font-weight-bold">

            Joined

        </label>

        <input type="text"
               class="form-control"
               value="{{ $user->created_at->format('d M Y') }}"
               readonly>

    </div>

</div>


<div class="mb-3">

    <label class="font-weight-bold">

        Address

    </label>

    <textarea
        class="form-control"
        rows="3"
        readonly>{{ $user->address ?? 'Not Added' }}</textarea>

</div>


<div class="text-right">

    <a href="{{ route('profile.edit') }}"
       class="btn btn-primary">

        <i class="fas fa-edit"></i>

        Edit Profile

    </a>

    <a href="{{ route('password.change') }}"
       class="btn btn-warning">

        <i class="fas fa-key"></i>

        Change Password

    </a>

</div>

            </div>

        </div>

        <!-- Statistics -->

        <div class="row">

            <div class="col-md-4">

                <div class="card border-left-primary shadow mb-4">

                    <div class="card-body text-center">

                        <i class="fas fa-book fa-2x text-primary mb-2"></i>

                        <h4>{{ \App\Models\Book::count() }}</h4>

                        <small>Total Book Titles</small>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border-left-success shadow mb-4">

                    <div class="card-body text-center">

                        <i class="fas fa-book-reader fa-2x text-success mb-2"></i>

                        <h4>{{ \App\Models\BookIssue::where('status','Issued')->count() }}</h4>

                        <small>Issued Books</small>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border-left-danger shadow mb-4">

                    <div class="card-body text-center">

                        <i class="fas fa-users fa-2x text-danger mb-2"></i>

                        <h4>{{ \App\Models\User::where('role','user')->count() }}</h4>

                        <small>Total Members</small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

</body>

</html>