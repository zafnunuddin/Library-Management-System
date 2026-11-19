<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Profile</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-light" style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-lg-8">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h4 class="mb-0">

<i class="fas fa-user-edit"></i>

Edit Admin Profile

</h4>

</div>

<div class="card-body">

<form action="{{ route('profile.update') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf


<div class="text-center mb-4">

@if($user->photo)

<img id="previewImage"
     src="{{ asset('storage/'.$user->photo) }}"
     width="150"
     height="150"
     class="img-thumbnail rounded-circle shadow"
     style="object-fit:cover;">

@else

<img id="previewImage"
     src="https://via.placeholder.com/150?text=No+Photo"
     width="150"
     height="150"
     class="img-thumbnail rounded-circle shadow"
     style="object-fit:cover;">

@endif

</div>
<div class="form-group">

<label>

Profile Photo

</label>

<input type="file"
       id="photo"
       name="photo"
       class="form-control"
       accept="image/*">
</div>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>

Full Name

</label>

<input
type="text"
name="name"
class="form-control"
value="{{ old('name',$user->name) }}"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>

Email

</label>

<input
type="email"
name="email"
class="form-control"
value="{{ old('email',$user->email) }}"
required>

</div>

</div>

</div>

<div class="row">

    <div class="col-md-6">

        <div class="form-group">

            <label>

                Phone Number

            </label>

            <input
                type="text"
                name="phone"
                class="form-control"
                value="{{ old('phone',$user->phone) }}">

        </div>

    </div>

    <div class="col-md-6">

        <div class="form-group">

            <label>

                Department

            </label>

            <input
                type="text"
                name="department"
                class="form-control"
                value="{{ old('department',$user->department) }}">

        </div>

    </div>

</div>


<div class="form-group">

    <label>

        Address

    </label>

    <textarea
        name="address"
        rows="4"
        class="form-control">{{ old('address',$user->address) }}</textarea>

</div>


<hr>

<div class="text-right">

    <a href="{{ route('profile') }}"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>

        Cancel

    </a>

    <button
        type="submit"
        class="btn btn-primary">

        <i class="fas fa-save"></i>

        Save Changes

    </button>

</div>

</form>
@if($user->photo)

<div class="text-center mt-3">

<form action="{{ route('profile.photo.delete') }}"
      method="POST">

    @csrf
    @method('DELETE')

    <button type="submit"
            class="btn btn-danger btn-sm"
            onclick="return confirm('Delete profile photo?')">

        <i class="fas fa-trash"></i>
        Delete Photo

    </button>

</form>

</div>

@endif

</div>

</div>

</div>

</div>

</div>

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
<script>
document.getElementById("photo").addEventListener("change", function(e){

    if(e.target.files.length){

        const reader = new FileReader();

        reader.onload = function(event){
            document.getElementById("previewImage").src = event.target.result;
        };

        reader.readAsDataURL(e.target.files[0]);

    }

});
</script>

</body>

</html>