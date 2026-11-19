<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - All Users List</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-light" style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">

<div class="container-fluid mt-4 mb-5">

    <div class="card shadow mb-4">

        <div class="card-header py-3 text-white" style="background-color: rgb(32, 92, 232);">
            <h5 class="m-0 font-weight-bold">
                <i class="fas fa-users mr-2"></i>
                All Registered Users
            </h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="bg-light text-dark">
                        <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>User Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Semester</th>
                            <th>Role</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Registration Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($users as $user)

                        <tr>

                            {{-- Serial --}}
                            <td>
                                {{ $loop->iteration }}
                            </td>

                            {{-- Student ID --}}
                            <td>
                                {{ $user->student_id ?? 'N/A' }}
                            </td>

                            {{-- User Photo --}}
                            <td class="text-center">
                                @php
                                    $userPhoto = $user->photo ? asset('storage/' . $user->photo) : 'https://via.placeholder.com/50x50?text=User';
                                @endphp

                                <img src="{{ $userPhoto }}"
                                     width="50"
                                     height="50"
                                     class="img-thumbnail rounded-circle shadow-sm"
                                     style="object-fit: cover;"
                                     alt="{{ $user->name }}"
                                     onerror="this.onerror=null; this.src='https://via.placeholder.com/50x50?text=User';">
                            </td>

                            {{-- Name --}}
                            <td class="font-weight-bold">
                                {{ $user->name }}
                            </td>

                            {{-- Email --}}
                            <td>
                                {{ $user->email }}
                            </td>

                            {{-- Department --}}
                            <td>
                                {{ $user->department ?? 'N/A' }}
                            </td>

                            {{-- Semester --}}
                            <td>
                                {{ $user->semester ?? 'N/A' }}
                            </td>

                            {{-- Role --}}
                            <td>
                                @if(strtolower($user->role) === 'admin')
                                    <span class="badge badge-danger px-2 py-1">
                                        Admin
                                    </span>
                                @else
                                    <span class="badge badge-primary px-2 py-1">
                                        User
                                    </span>
                                @endif
                            </td>

                            {{-- Phone --}}
                            <td>
                                {{ $user->phone ?? 'N/A' }}
                            </td>

                            {{-- Status --}}
                            <td>
                                <span class="badge badge-success px-2 py-1">
                                    {{ $user->status ?? 'Active' }}
                                </span>
                            </td>

                            {{-- Registration Date --}}
                            <td>
                                {{ optional($user->created_at)->format('d-m-Y') ?? 'N/A' }}
                            </td>

                            {{-- Action --}}
                            <td class="text-center">
                                <button class="btn btn-info btn-sm" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <button class="btn btn-warning btn-sm" title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button class="btn btn-danger btn-sm" title="Delete User">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="12" class="text-center py-4 text-muted">
                                <i class="fas fa-user-slash fa-2x mb-2 d-block"></i>
                                No Registered Users Found.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

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