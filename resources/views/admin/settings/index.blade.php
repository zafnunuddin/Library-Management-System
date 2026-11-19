<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-light" style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">

<div class="container-fluid mt-4 mb-5">

    <div class="card shadow mb-4">

        <div class="card-header py-3 bg-primary text-white">
            <h5 class="m-0">
                <i class="fas fa-cogs mr-2"></i>
                System Settings
            </h5>
        </div>

        <div class="card-body">

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

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <!-- Password & Security Settings -->

                <h5 class="text-success mb-3">
                    <i class="fas fa-lock mr-1"></i>
                    Security Settings
                </h5>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Current Password</label>
                        <input type="password"
                               name="current_password"
                               class="form-control"
                               placeholder="Enter current password">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">New Password</label>
                        <input type="password"
                               name="new_password"
                               class="form-control"
                               placeholder="Enter new password">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Confirm Password</label>
                        <input type="password"
                               name="new_password_confirmation"
                               class="form-control"
                               placeholder="Confirm new password">
                    </div>

                </div>

                <hr>

                <!-- Library Settings -->

                <h5 class="text-info mb-3">
                    <i class="fas fa-book mr-1"></i>
                    Library Settings
                </h5>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">Library Name</label>
                        <input type="text"
                               name="library_name"
                               class="form-control"
                               value="{{ old('library_name', $setting->library_name ?? '') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="font-weight-bold">University Name</label>
                        <input type="text"
                               name="university_name"
                               class="form-control"
                               value="{{ old('university_name', $setting->university_name ?? '') }}">
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Fine Per Day (Tk)</label>
                        <input type="number"
                               step="0.01"
                               name="fine_per_day"
                               class="form-control"
                               value="{{ old('fine_per_day', $setting->fine_per_day ?? 0) }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Maximum Borrow Days</label>
                        <input type="number"
                               name="maximum_borrow_days"
                               class="form-control"
                               value="{{ old('maximum_borrow_days', $setting->maximum_borrow_days ?? 14) }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="font-weight-bold">Maximum Books Per User</label>
                        <input type="number"
                               name="maximum_books_per_user"
                               class="form-control"
                               value="{{ old('maximum_books_per_user', $setting->maximum_books_per_user ?? 3) }}">
                    </div>

                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-md-8">
                        <label class="font-weight-bold">Library Logo</label>
                        <input type="file"
                               name="library_logo"
                               id="libraryLogoInput"
                               class="form-control"
                               accept="image/*">
                    </div>
                    <div class="col-md-4 text-center mt-3 mt-md-0">
                        <label class="font-weight-bold d-block">Current Logo</label>
                        @php
                            $logoUrl = optional($setting)->library_logo ? asset('storage/' . $setting->library_logo) : 'https://via.placeholder.com/100x100?text=No+Logo';
                        @endphp
                        <img id="logoPreview" 
                             src="{{ $logoUrl }}" 
                             alt="Library Logo" 
                             class="img-thumbnail shadow-sm" 
                             style="max-height: 90px; object-fit: contain;"
                             onerror="this.onerror=null; this.src='https://via.placeholder.com/100x100?text=No+Logo';">
                    </div>
                </div>

                <hr>

                <!-- Notification Settings -->

                <h5 class="text-warning mb-3">
                    <i class="fas fa-bell mr-1"></i>
                    Notification Settings
                </h5>

                <div class="form-check mb-2">
                    <input class="form-check-input"
                           type="checkbox"
                           name="email_notification"
                           id="email_notification"
                           value="1"
                           {{ old('email_notification', $setting->email_notification ?? true) ? 'checked' : '' }}>

                    <label class="form-check-label" for="email_notification">
                        Enable Email Notifications
                    </label>
                </div>

                <div class="form-check mb-2">
                    <input class="form-check-input"
                           type="checkbox"
                           name="due_notification"
                           id="due_notification"
                           value="1"
                           {{ old('due_notification', $setting->due_notification ?? true) ? 'checked' : '' }}>

                    <label class="form-check-label" for="due_notification">
                        Due Date Reminder Notification
                    </label>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input"
                           type="checkbox"
                           name="registration_notification"
                           id="registration_notification"
                           value="1"
                           {{ old('registration_notification', $setting->registration_notification ?? false) ? 'checked' : '' }}>

                    <label class="form-check-label" for="registration_notification">
                        New User Registration Notification
                    </label>
                </div>

                <div class="text-right border-top pt-3">

                    <button type="submit"
                            class="btn btn-primary px-5">

                        <i class="fas fa-save mr-1"></i>
                        Save Settings

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

<script>
    document.getElementById('libraryLogoInput').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('logoPreview').src = event.target.result;
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>

</body>
</html>