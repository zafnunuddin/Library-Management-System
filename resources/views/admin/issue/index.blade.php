<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library LMS - Issue Book</title>

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-light" style="background-image: url('{{ asset('images/Background.jpg') }}'); background-size: cover; background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-color: #f4f6f9;">

<div class="container mt-5">

    <div class="card shadow mb-4">

        <div class="card-header py-3 text-white"
        style="background-color: rgb(32, 92, 232);">
            <h6 class="m-0 font-weight-bold">
                <i class="fas fa-arrow-right mr-2"></i>
                Circulation System : Issue Book Form
            </h6>
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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('issue.store') }}" method="POST">

                @csrf

                <!-- Member -->
                <div class="mb-3">

                    <label class="font-weight-bold">
                        Library Member
                    </label>

                    <select name="user_id"
                            class="form-control"
                            required>

                        <option value="">Select Member</option>

                        @foreach($users as $user)

                            <option value="{{ $user->id }}">
                                {{ $user->name }} ({{ $user->student_id }})
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Book -->
                <div class="mb-3">

                    <label class="font-weight-bold">
                        Book
                    </label>

  <select name="book_id" class="form-control" required>

    <option value="">Select Book</option>

    @foreach($books as $book)

        <option value="{{ $book->id }}">
            {{ $book->title }}
            -
            {{ $book->edition }}
            -
            ISBN: {{ $book->isbn ?? 'N/A' }}
            -
            Book ID: {{ $book->id }}
        </option>

    @endforeach

</select>
                </div>

                

                <!-- Stock Info -->

                <div class="alert alert-info">

                    <i class="fas fa-info-circle"></i>

                    Only books with available stock are shown.

                </div>

                <!-- Issue Date -->

                <div class="mb-3">

                    <label class="font-weight-bold">

                        Issue Date

                    </label>

                    <input type="date"
                           name="issue_date"
                           class="form-control"
                           value="{{ date('Y-m-d') }}"
                           required>

                </div>

                <!-- Return Date -->

                <div class="mb-3">

                    <label class="font-weight-bold">

                        Return Date

                    </label>

                    <input type="date"
                           name="return_date"
                           class="form-control"
                           required>

                </div>

                <!-- Notes -->

                <div class="mb-3">

                    <label class="font-weight-bold">

                        Administrative Notes

                    </label>

                    <textarea
                        name="notes"
                        class="form-control"
                        rows="3"
                        placeholder="Optional notes..."></textarea>

                </div>

                <!-- Buttons -->

                <div class="text-right border-top pt-3">

                    <a href="{{ route('admin.dashboard') }}"
                       class="btn btn-secondary">

                        <i class="fas fa-times"></i>

                        Cancel

                    </a>

                    <button type="reset"
                            class="btn btn-warning">

                        <i class="fas fa-redo"></i>

                        Reset

                    </button>

                    <button type="submit"
                            class="btn btn-success">

                        <i class="fas fa-book"></i>

                        Issue Book

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

</body>
</html>